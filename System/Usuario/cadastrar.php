<?php
    ob_start();
    session_start();

    require_once '../includes/autoloader.php';

    require '../includes/header.php';

    if(isset($_SESSION['alert'])) {
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
    }
    
    require '../includes/formUsuario.php';

    $db = new Database();

    if(isset($_POST['email'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING);

        $Image = new File();
        $User = new User($email, $password);
        $WHERE = "WHERE Email = '{$email}'";
        
        if(!$User->setName($name))
            $message = 'Digite um nome válido!';

        if (count(User::getUsers($db, $WHERE)) > 0)
            $message = 'Email já cadastrado!';

        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $Image->setName(md5(time()));
            $Image->setError($file['error']);
            $Image->setExtension(pathinfo($file['name'])['extension']);
            $Image->setSize($file['size']);
            $Image->setTmpName($file['tmp_name']);
            
            $User->setImage($Image);
        }

        if(isset($message)) {
            $_SESSION['alert'] = "<div class='alert alert-danger' "
            . "style='width: 830px; margin: auto; top: 7%; margin-bottom: 20px'>{$message}</div>";
            header("Location: cadastrar.php");
            exit;
        }
    
        $User->INSERT($db);

        $message = "Cadastro realizado com sucesso!";
        $_SESSION['alert'] = "<div class='alert alert-success' "
        . "style='width: 830px; margin: auto; top: 7%; margin-bottom: 20px'>{$message}</div>";

        header("location: cadastrar.php");
    }
?>