<?php

    session_start();
    include_once('./class/conexao.class.php');
    include_once('./class/usuario.class.php');

    $email = $_POST['email-login'];
    $senha = $_POST['senha-login'];

    if(empty($email) || empty($senha)) {
        header('Location: index.php');
        exit();
    }

    $conexao = new Conexao();
    $conexao = $conexao->conectaBD();
    $SQL = 'SELECT * FROM usuario WHERE email = $1 AND senha = md5($2)';
    $VALORES = array($email, $senha);
    $resultado = pg_query_params($conexao, $SQL, $VALORES);
    $linhas = pg_num_rows($resultado);
    pg_close($conexao);

    $resultado = pg_fetch_array($resultado);

    if ($linhas === 1) {
        $usuario = new Usuario($resultado['nome'], $resultado['foto'],
            $resultado['senha'], $resultado['email']);
        $_SESSION['usuario'] = serialize($usuario);
        $_SESSION['id-usuario'] = $resultado['id'];
        header('Location: feed.php');
        exit();
    } else {
        $_SESSION['naoAutenticado'] = true;
        header('Location: index.php');
        exit();
    }

?>