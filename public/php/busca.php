<?php

    include_once('class/grupo.class.php');
    include_once('dao/grupo.dao.php');

    session_start();

    $palavra = $_POST['palavra'];
    $grupoDAO = new GrupoDAO();

    $resultadoBusca = $grupoDAO->buscarPorNome($palavra);

    $_SESSION['grupos'] = serialize($resultadoBusca);


    var_dump($grupos);

?>