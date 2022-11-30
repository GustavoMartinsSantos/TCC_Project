<?php
    define('PAGE_TITLE', 'Editar meu perfil');
    define("JS_INCLUDES", array('../includes/JS/principal.js', "../includes/JS/func_tela_cad.js"));
    define("CSS_INCLUDES", array('../includes/CSS/principal.css', '../includes/CSS/style_cad.css'));

    require_once '../includes/autoloader.php';
    require '../includes/header.php';

    $db = new Database();

    $WHERE = "WHERE U.ID = '" . $_SESSION['user']['id'] . "'";

    $User = User::getUsers(new Database(), $WHERE)[0];
    
    if(isset($_SESSION['mensagem'])) {
        echo $_SESSION['mensagem'];
        unset($_SESSION['mensagem']);
    }

    require '../includes/formUsuario.php';

    if(isset($_POST['email'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING);
        $WHERE = "WHERE Email = '{$email}'";
        
        if($email != $User->getEmail()) {
            if (count(User::getUsers($db, $WHERE)) > 0)
                $message = 'Email já cadastrado';
        }

        $Image = new File();
        $User->setEmail($email);
        $User->setPassword($password);
        
        if(!$User->setName($name))
            $message = 'Digite um nome válido!';

        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];

            if($file['error'] == 0) {
                $Image->setID($User->getImage()->getID());
                $Image->setName(md5(time()));
                $Image->setError($file['error']);
                $Image->setExtension(pathinfo($file['name'])['extension']);
                $Image->setSize($file['size']);
                $Image->setTmpName($file['tmp_name']);

                $User->setImage($Image);
            }
        }

        if(isset($message)) {
            $_SESSION['mensagem'] = "<div class='alert alert-danger' "
            . "style='width: 830px; margin: auto; top: 9%; margin-bottom: 20px'>{$message}</div>";
            header("Location: editar.php");
            exit;
        }
        
        $User->UPDATE($db);
        
        $_SESSION['mensagem'] = "<div class='alert alert-success' "
        . "style='width: 830px; margin: auto; top: 9%; margin-bottom: 20px'>Atualização realizada com sucesso</div>";
        
        $_SESSION['user'] = array(
            'id'    => $User->getID(),
            'nome'  => $User->getFirstName(),
            'imagem'=> $User->getImage()->getName(),
            'ADM'   => $User->getADM(),
            'groupPermission' => false
        );

        header("location: editar.php");
    }
?>