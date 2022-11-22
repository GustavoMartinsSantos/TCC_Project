<?php
    ob_start();
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    
    if(!isset($_SESSION['user']))
        header("location: Usuario/login.php");
    
    require_once 'includes/autoloader.php';

    $db = new Database();
    $Classificacoes = Classification::getClassificacoes($db);
    $Grupos = Group::getGroups($db, "WHERE ID_Usuario = " . $_SESSION['user']['id']);

    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
    $typeFilter = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_STRING);
    $groupFilter = filter_input(INPUT_GET, 'grupo', FILTER_SANITIZE_STRING);
    $dataFilter  = filter_input(INPUT_GET, 'data', FILTER_SANITIZE_STRING);
    $dataFilter = in_array($dataFilter, [0, 1, 2, 3, 4]) ? $dataFilter : 0;
    $favFilter = filter_input(INPUT_GET, 'fav', FILTER_SANITIZE_STRING);
    $favFilter = in_array($favFilter, [true, false]) ? $favFilter : false;

    $WHERE = ["Titulo LIKE '%".str_replace(' ', '%', $search)."%'"];

    if(!$_SESSION['user']['ADM'])
        $WHERE[] = "UG.ID_Usuario = " . $_SESSION['user']['id'];

    if($favFilter == "true")
        $WHERE[] = "F.ID_Usuario = UG.ID_Usuario";

    switch($dataFilter) {
        case 1: 
            $dataFilter_Begin = date('Y-m-d', strtotime("sunday -1 week"));
            $dataFilter_End = date('Y-m-d', strtotime("next sunday"));
            break;
        case 2: 
            $dataFilter_Begin = date('Y-m-01');
            $dataFilter_End = date('Y-m-t');
            break;
        case 3:
            $LastMonthQuarter = date('Y-' . (ceil(date('m')/3) * 3) . '-d');

            $dataFilter_Begin = date('Y-m-01', strtotime('-2 month'));
            $dataFilter_End = date('Y-m-t', strtotime($LastMonthQuarter));
            break;
        case 4:
            $dataFilter_End = date('Y-m-d');
            break;
    }

    $dataWHEREclause = "";
    if($dataFilter != 0) {
        if($dataFilter != 4)
            $dataWHEREclause = "DataHora_Inicio >= '" . $dataFilter_Begin . "' AND ";
        
        $dataWHEREclause .= "DataHora_Inicio < '" . $dataFilter_End . "'";
        $WHERE[] = $dataWHEREclause;
    }

    $exists = false;

    foreach($Classificacoes as $Classificacao) {
        if($Classificacao->getName() == $typeFilter) {
            $exists = true;
            break;
        }
    }

    if($exists)
        $WHERE[] = "Cat.Nome = '$typeFilter'";
        
    $exists = false;

    foreach($Grupos as $Grupo) {
        if($Grupo->getGroupXUsers()[0]->getPermissao())
            $_SESSION['user']['groupPermission'] = true;

        if($Grupo->getName() == $groupFilter)
            $exists = true;
    }

    if($exists)
        $WHERE[] = "G.Nome = '$groupFilter'";

    $WHERE = "WHERE " . implode(' AND ', $WHERE);

    $Events = Event::getEvents($db, $WHERE);

    $months = [
        'Jan',
        'Fev',
        'Mar',
        'Abr',
        'Maio',
        'Jun',
        'Jul',
        'Ago',
        'Set',
        'Out',
        'Nov',
        'Dez'
    ];

    define('PAGE_TITLE', 'SETEC');
    define('CSS_INCLUDES', ['includes/CSS/principal.css', 'includes/CSS/excluir.css']);
    define('JS_INCLUDES', 'includes/JS/principal.js');

    require_once 'includes/header.php';
    require_once 'includes/principal.php';

    /*$email = new Email($_SESSION['user'], 'teste', file_get_contents('Email_Pages/forgotPasswd.html'));
    $email->send();*/
?>