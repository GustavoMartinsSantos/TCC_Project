<?php
    define('PAGE_TITLE', 'Editar Grupo');
    define('CSS_INCLUDES', array('../includes/CSS/style_grupos.css', '../includes/CSS/principal.css'));
    define('JS_INCLUDES', array('../includes/JS/script_grupos.js', '../includes/JS/principal.js'));
    
    require_once '../includes/autoloader.php';
    require '../includes/header.php';

    if(isset($_SESSION['alert'])) {
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
    }

    if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header("Location: ../index.php");
        exit;
    }

    $WHERE = "WHERE G.ID = " . $_GET['id'];

    $db = new Database();
    $Grupo = Group::getGroup($db, $WHERE);

    if((!$_SESSION['user']['ADM'] && !$_SESSION['user']['groupPermission']) || !$Grupo instanceof Group) {
        header("Location: ../index.php");
        exit;
    }
    
    require '../includes/formGroups.php';

    if(isset($_POST['title'])) { 
        if(!isset($_POST['ids'])) {
            $message = "Nenhum aluno associado ao grupo!!";
            
            $_SESSION['alert'] = "<div class='sel alert alert-danger' "
            . "style='width: 42%; margin: auto; margin-bottom: 2%; position: static;'>{$message}</div>";

            header("location: editar.php?id=" . $_GET['id']);    
        } else {
            $name = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);;

            $Grupo->setName($name);
    
            $Grupo->UPDATE($db);
            $Grupo->deleteUsers($db);
    
            for ($i = 0; $i < count($_POST['ids']); $i++) {
                $User = new User();
                $User->setID($_POST['ids'][$i]);
                
                if($User->getID() == $_SESSION['user']['groupPermission'] && $_POST['permissao'][$i] == 0)
                    $_SESSION['user']['groupPermission'] = false;

                $UserXGroup = new UserXGroup();
                $UserXGroup->setGroup($Grupo);
                $UserXGroup->setUser($User);
                $UserXGroup->setPermissao($_POST['permissao'][$i]);
                
                $UserXGroup->INSERT($db);
            }

            $_SESSION['message'] = "<div class='sel alert alert-success' "
            . "style='margin: auto; margin-bottom: 2%; position: static;'>Edição efetuada com sucesso!</div>";

            header("Location: index.php");
        }
    }
?>