<?php

    session_start();
    include_once('dao/grupo.dao.php');
    include_once('class/grupo.class.php');
    include_once('class/usuario.class.php');

    $usuario = unserialize($_SESSION['usuario']);
    $nomeGrupo = $_POST['nome-grupo'];

    $grupo = new Grupo($nomeGrupo);
    var_dump($usuario->getId());
    $grupo->setIdCriador($usuario->getId());
    $grupoDAO = new GrupoDAO();
    $grupoDAO->inserir($grupo);
    header('Location: grupo.php');
    exit();
?>