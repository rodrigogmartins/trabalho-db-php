<?php

    session_start();
    include_once('class/usuario.class.php');
    include_once('dao/usuario.dao.php');

    define ('SITE_ROOT', str_replace('/php', '/foto-perfil/', realpath(dirname(__FILE__))));
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmar-senha'];
    $email = $_POST['email'];

    if ($_FILES['imagem']['name'] != '') {
        $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
        $novoNome = md5(time()).$extensao;
        $diretorio = 'foto-perfil/';
        
        move_uploaded_file($_FILES['imagem']['tmp_name'], SITE_ROOT.$novoNome);
    } else {
        $novoNome = 'foto-default.jpg';
    }

    if ($senha == $confirmarSenha) {
        $usuario = new Usuario($nome, $novoNome, $senha, $email);
        $usuario->setEmail($email);
        $usuarioDAO = new UsuarioDAO();
        $id = $usuarioDAO->inserir($usuario);
        $usuario->setId($id);
        $_SESSION['usuario'] = $usuario;
        header('Location: feed.php');
        exit();
    } else {
        $_SESSION['erroNoCadastro'] = true;
        header('Location: feed.php');
        exit();
    }

?>