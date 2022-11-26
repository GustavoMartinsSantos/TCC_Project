<?php
    session_start();

    define('PAGE_TITLE', 'Cadastrar');
    define("JS_INCLUDES", array('../includes/JS/principal.js', "../includes/JS/func_tela_cad.js"));
    define("CSS_INCLUDES", array('../includes/CSS/principal.css', '../includes/CSS/style_cad.css'));
    
    require_once '../includes/autoloader.php';

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
        $WHERE = "WHERE Email = '{$email}'";
        
        $Image = new File();
        $User = new User();

        $User->setEmail($email);
        $User->setPassword($password);
        
        if(!$User->setName($name))
            $message = 'Digite um nome válido!';

        if (count(User::getUsers($db, $WHERE)) > 0)
            $message = 'Email já cadastrado!';

        if ($_FILES['image']['error'] != 4) {
            $file = $_FILES['image'];
            $Image->setName(md5(time()));
            $Image->setError($file['error']);
            $Image->setExtension(pathinfo($file['name'])['extension']);
            $Image->setSize($file['size']);
            $Image->setTmpName($file['tmp_name']);
        }
        
        $User->setImage($Image);

        if(isset($message)) {
            $_SESSION['alert'] = "<div class='alert alert-danger' "
            . "style='width: 830px; margin: auto; top: 7%; margin-bottom: 20px'>{$message}</div>";
            header("Location: cadastrar.php");
            exit;
        }

        if(isset($_SESSION['user']['ADM']) && $_SESSION['user']['ADM'])
            $User->setADM(1);
    
        $User->INSERT($db);

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