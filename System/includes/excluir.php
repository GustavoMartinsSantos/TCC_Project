<?php    
    session_start();
    
    require_once '../includes/autoloader.php';

    $cat = isset($_POST['cat']) ? $_POST['cat'] : false;
    $cat = in_array($cat, ['g', 'e', 'u']) ? $cat : false;

    if(!$cat || !isset($_POST['id']) || !is_numeric($_POST['id'])) {
        header("Location: ../index.php");
        exit;
    }

    $db = new Database();

    switch($cat) {
        case 'g':
            $Group = new Group();
            $Group->setID($_POST['id']);

            $Group->DELETE($db);
            break;
        case 'e':
            $Event = Event::getEvents($db, "WHERE Cod = ".$_POST['id'])[0];
            $Event->DELETE($db);

            break;
        case 'u':
            $User = User::getUsers($db, "WHERE U.ID = ".$_POST['id'])[0];
            $User->setID($_POST['id']);

            $User->DELETE($db);

            unset($_SESSION['user']);

            $_SESSION['alert'] = "<div class='alert alert-success' "
            . "style='width: 35%; margin: auto; margin-bottom: 1%; top: 5%'>Conta excluída com sucesso!</div>";
            break;
    }
?>