<?php
    session_start();

    define('PAGE_TITLE', 'Cadastrar');
    define("JS_INCLUDES", '../includes/JS/new_password.js');
    define("CSS_INCLUDES", '../includes/CSS/new_password.css');

    require_once '../includes/autoloader.php';
    require_once '../includes/newPassword.php';

    $db = new Database();
    $WHERE = "WHERE U.RecSenhaToken = '" . $_GET['code'] ."'";
    $User = User::getUsers(new Database(), $WHERE)[0];

    if($User == null) {
        $_SESSION['alert'] = "<div class='alert alert-danger' "
        . "style='width: 35%; margin: auto; margin-bottom: 1%; top: 5%'>Token incorreto!</div>";

        header("location: login.php");
    }

    if(isset($_POST['senha'])) {
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    
        $User->setPassword($senha);
        $User->setRecSenha(md5(time()));
        $User->UPDATE($db);

        $_SESSION['user'] = array(
            'id'    => $User->getID(),
            'nome'  => $User->getFirstName(),
            'imagem'=> $User->getImage()->getName(),
            'ADM'   => $User->getADM(),
            'groupPermission' => false
        );

        header("location: ../index.php");
    }
?>