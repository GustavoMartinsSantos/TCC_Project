<?php
    require_once '../includes/autoloader.php';

    if(isset($_POST['favorito'])) {
        $cod_evento = $_POST['cod_evento'];
        $id_user    = $_POST['id_user'];

        $Event = new Event();
        $db = new Database();
        $Event->setCod($cod_evento);

        if($_POST['favorito'] == "false")
            $Event->INSERT_Favorito($db, $id_user);
        else
            $Event->deleteFavorito($db, $id_user);
    }
?>