<?php    
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
            $Event = new Event();
            $Event->setCod($_POST['id']);

            $Event->DELETE($db);
            break;
        case 'u':
            $User = new User();
            $User->setID($_POST['id']);

            $User->DELETE($db);
            break;
    }
?>