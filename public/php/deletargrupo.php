<?php

    session_start();
    include_once('dao/grupo.dao.php');
    include_once('dao/post.dao.php');

    $id = $_GET['id'];

    if ($id) {
        $nomeGrupo = $_POST['nome-grupo'];
        $grupoDAO = new GrupoDAO();
        $grupoDAO->deletar($id);
    }

    header('Location: grupo.php');
    exit();

?>