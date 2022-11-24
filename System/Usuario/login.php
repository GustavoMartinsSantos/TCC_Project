<?php
    session_start();

    require_once '../includes/autoloader.php';

    if(isset($_SESSION['alert'])) {
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
    }

    require_once '../includes/formLogin.php';

    $db = new Database();

    if(isset($_POST['email'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        
        $WHERE = "WHERE Email = '$email' AND Senha = '$senha'";

        $User = User::getUsers($db, $WHERE);

        if(count($User) == 0) {
            $message = "Email ou Senha incorretos!!";
            
            $_SESSION['alert'] = "<div class='alert alert-danger' "
            . "style='width: 35%; margin: auto; top: 7%'>{$message}</div>";

            header("location: login.php");
        } else {
            $groupPermission = false;

            if($User[0]->getADM())
                $groupPermission = true;

            $_SESSION['user'] = array(
                'id'    => $User[0]->getID(),
                'nome'  => $User[0]->getFirstName(),
                'imagem'=> $User[0]->getImage()->getName(),
                'ADM'   => $User[0]->getADM(),
                'groupPermission' => $groupPermission
            );

            header("location: ../index.php");
        }
    }
?>