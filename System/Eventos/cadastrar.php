<?php
    define('PAGE_TITLE', 'Cadastrar Evento');
    define('CSS_INCLUDES', array('../includes/CSS/principal.css', '../includes/CSS/style_event.css'));
    define('JS_INCLUDES', array('../includes/JS/principal.js', '../includes/JS/script_event.js'));
    
    require_once '../includes/autoloader.php';
    require '../includes/header.php';

    $db = new Database();
    
    require '../includes/formEvent.php';

    if(isset($_POST['title'])) {
        if(isset($_POST['groupIds'])) {
            $message = "O evento deve fazer parte de um grupo";
            
            $_SESSION['alert'] = "<div class='sel alert alert-danger' "
            . "style='margin: auto; margin-bottom: 2%; position: static;'>{$message}</div>";

            header("location: cadastrar.php");
        } else {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $title = trim(preg_replace('/\s+/', " ", $title));
            $desc  = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);

            if($title == null)
                $mensagem = 'Digite um título válido!';
            if(!isset($_POST['Grupos']))
                $mensagem = "O evento não faz parte de nenhum grupo!";

            $Event = new Event();
            $Image = new File();

            if ($_FILES['imagem']['error'] != 4) {
                $file = $_FILES['imagem'];
                $Image->setName(md5(time()));
                $Image->setError($file['error']);
                $Image->setExtension(pathinfo($file['name'])['extension']);
                $Image->setSize($file['size']);
                $Image->setTmpName($file['tmp_name']);

                if($_FILES['imagem']['error'] != 0)
                    $mensagem = 'Erro no arquivo enviado';
                
                $Event->setImage($Image);
            }

            if(isset($mensagem)) {
                $_SESSION['alert'] = "<div class='sel alert alert-danger' "
                . "style='margin: auto; margin-bottom: 2%; position: static;'>{$mensagem}</div>";

                header("Location: cadastrar.php");
                exit;
            }

            $Event->setTitulo($title);
            $Event->setDataHora_Inicio(str_replace('T', ' ', $_POST['dataHoraInicio']));
            $Event->setDataHora_Venc(str_replace('T', ' ', $_POST['dataHoraVenc']));
            $Event->setDescricao($desc);

            $Event->INSERT($db);
            
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
            . "style='margin: auto; margin-bottom: 2%; position: static;'>Cadastro efetuada com sucesso!</div>";

            header("Location: ../index.php");
        }
    }
?>