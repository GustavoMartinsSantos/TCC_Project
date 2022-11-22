<?php
    require_once '../includes/autoloader.php';

    $db = new Database();

    $search = filter_input(INPUT_POST, 's', FILTER_SANITIZE_STRING);

    if(isset($_POST['id']))
        $where = "WHERE U.id = '" . $_POST['id'] . "'";
    else
        $where = "WHERE CONCAT(U.Nome, U.Sobrenome) LIKE '%".str_replace(' ', '%', $search)."%'";

    $Users = User::getUsers($db, $where);
    $results = array();

    foreach($Users as $User) {
        $name = $User->getFirstName() . " " . $User->getLastName();

        $results[] = array(
            'id'     => $User->getID(),
            'nome'   => $name,
            'email'  => $User->getEmail(),
            'imagem' => $User->getImage()->getName()
        );
    }

    if(isset($_POST['id']))
        $results = $results[0];
            
    echo json_encode($results);
?>