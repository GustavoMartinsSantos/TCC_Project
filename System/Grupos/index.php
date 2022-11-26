<?php
    define('PAGE_TITLE', 'Grupos');
    define('CSS_INCLUDES', ['../includes/CSS/excluir.css', '../includes/CSS/grupos.css']);
    define('JS_INCLUDES', '../includes/JS/principal.js');

    require_once '../includes/autoloader.php';
    require '../includes/header.php';

    if(!$_SESSION['user']['ADM'] && !$_SESSION['user']['groupPermission']) {
        header("Location: ../index.php");
        exit;
    }

    if(isset($_SESSION['alert'])) {
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
    }

    if($_SESSION['user']['ADM'])
	    $WHERE = "GROUP BY Grupo.ID";
    else
        $WHERE = "ID_Usuario = " . $_SESSION['user']['id'];

    $db = new Database();
    $Groups = Group::getGroups($db, $WHERE);

    require '../includes/groups.php';
?>