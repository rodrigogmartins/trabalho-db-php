<?php

    session_start();
    include_once('dao/post.dao.php');
    include_once('class/post.class.php');
    include_once('class/usuario.class.php');

    $titulo = $_POST['titulo'];
    $descricao = $_POST['postagem'];
    $grupo = $_POST['grupo'];
    $idUsuario = (int) $_SESSION['id-usuario'];

    $postagem = new Post($titulo, $descricao, $grupo, $idUsuario);
    $postDao = new PostDAO();
    $postDao->inserir($postagem);
    header('Location: feed.php');
    exit();

?>