<?php
    define('PAGE_TITLE', 'Editar Evento');
    define('CSS_INCLUDES', array('../includes/CSS/principal.css', '../includes/CSS/style_event.css'));
    define('JS_INCLUDES', array('../includes/JS/principal.js', '../includes/JS/script_event.js'));
    
    require_once '../includes/autoloader.php';
    require '../includes/header.php';

    if(isset($_SESSION['alert'])) {
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
    }

    if(!isset($_GET['cod']) || !is_numeric($_GET['cod'])) {
        header("Location: ../index.php");
        exit;
    }

    $WHERE = "WHERE Cod = " . $_GET['cod'];
    
    if(!$_SESSION['user']['ADM'])
        $WHERE .= " AND UG.ID_Usuario = " . $_SESSION['user']['id'];

    $db = new Database();
    $Event = Event::getEvents($db, $WHERE)[0];

    if(!$Event instanceof Event || (!$_SESSION['user']['ADM'] && !$Event->getPermission())) {
        header("Location: ../index.php");
        exit;
    }

    require '../includes/formEvent.php';

    if(isset($_POST['title'])) {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $title = trim(preg_replace('/\s+/', " ", $title));
        $desc  = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);

        if($title == null)
            $mensagem = 'Digite um título válido!';
        if(!isset($_POST['Grupos']))
            $mensagem = "O evento não faz parte de nenhum grupo!";

        if(isset($mensagem)) {
            $_SESSION['alert'] = "<div class='sel alert alert-danger' "
            . "style='margin: auto; margin-bottom: 2%; position: static;'>{$mensagem}</div>";

            header("Location: editar.php?cod=" . $_GET['cod']);
            exit;
        }

        $Image = new File();

        if ($_FILES['imagem']['error'] != 4) {
            $file = $_FILES['imagem'];
            $Image->setID($Event->getImage()->getID());
            $Image->setName(md5(time()));
            $Image->setError($file['error']);
            $Image->setExtension(pathinfo($file['name'])['extension']);
            $Image->setSize($file['size']);
            $Image->setTmpName($file['tmp_name']);

            if($_FILES['imagem']['error'] != 0)
                $mensagem = 'Erro no arquivo enviado';

            $Event->setImage($Image);
        }

        $Event->setTitulo($title);
        $Event->setDataHora_Inicio(str_replace('T', ' ', $_POST['dataHoraInicio']));
        $Event->setDataHora_Venc(str_replace('T', ' ', $_POST['dataHoraVenc']));
        $Event->setDescricao($desc);

        $Event->UPDATE($db);
        $Event->deleteClassification($db);
        $Event->deleteGroups($db);
        
        for ($i = 0; $i < count($_POST['Classificacoes']); $i++) {
            $Classificacao = new Classification();
            $Classificacao->setID($_POST['Classificacoes'][$i]);
            
            $EventXGroup = new Classifica($Classificacao, $Event);
            
            $EventXGroup->INSERT($db);
        }
        
        for ($i = 0; $i < count($_POST['Grupos']); $i++) {
            $Group = new Group();
            $Group->setID($_POST['Grupos'][$i]);

            $EventXGroup = new EventoXGrupo($Group, $Event);
            
            $EventXGroup->INSERT($db);
        }

        $_SESSION['message'] = "<div class='sel alert alert-success' "
        . "style='margin: auto; margin-bottom: 2%; position: static;'>Edição efetuada com sucesso!</div>";

        header("Location: ../index.php");
    }
?>