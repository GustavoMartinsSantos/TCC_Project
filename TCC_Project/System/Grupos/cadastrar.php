<?php
    $hasTitle = "Cadastro de Grupos";
    
    define('PAGE_TITLE', 'Cadastrar Grupo');
    define('CSS_INCLUDES', array('../includes/CSS/style_grupos.css', '../includes/CSS/principal.css'));
    define('JS_INCLUDES', array('../includes/JS/script_grupos.js', '../includes/JS/principal.js'));
    
    require_once '../includes/autoloader.php';
    require '../includes/header.php';

    if(!$_SESSION['user']['ADM']) {
        header("Location: ../index.php");
        exit;
    }

    if(isset($_SESSION['alert'])) {
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
    }
    
    require '../includes/formGroups.php';

    $db = new Database();

    if(isset($_POST['title'])) { 
        if(!isset($_POST['ids'])) { ?>
            <script>
                alert('Nenhum aluno associado ao grupo!!');
            </script>
<?php   } else {
            $name = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);

            if($name == null) {
                $_SESSION['alert'] = "<div class='sel alert alert-danger' "
                . "style='margin: auto; margin-bottom: 2%; position: static;'>Digite um nome válido!!</div>";

                header('Location: cadastrar.php');
                exit;
            }

            $Group = new Group();
            $Group->setName($name);
    
            $Group->INSERT($db);

            for ($i = 0; $i < count($_POST['ids']); $i++) {
                $User = new User();
                $User->setID($_POST['ids'][$i]);

                $UserXGroup = new UserXGroup();
                $UserXGroup->setGroup($Group);
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