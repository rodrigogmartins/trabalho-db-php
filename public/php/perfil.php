<?php
    include_once('verifica_login.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tuitcher</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/feed.css">
        <link rel="stylesheet" type="text/css" href="../css/perfil.css">
    </head>
    <body class="container">
        <div class="row justify-content-center">
            <div id="conteudo" class="col-12 col-lg-12 col-xl-7">
                <div id="tamanho-tela"></div>
                <div id="informacoes">
                    <div class="col-4 col-lg-4 col-xl-4">
                        <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="btn btn-warning btn-block" href="feed.php">FEED</a>
                                <hr>
                                <a class="btn btn-warning btn-block" href="grupo.php">GRUPO</a>
                                <hr>
                                <a class="btn btn-danger btn-block" href="logout.php">SAIR</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-lg-4 col-xl-4">
                        <h1 id="titulo" class="text-center">
                            <img src="../img/logo.png" alt="">
                        </h1>
                    </div>

                </div>
                <div id="infoUsuario">
                    <?php

                        include_once('class/usuario.class.php');
                        include_once('dao/usuario.dao.php');

                        $usuarioDAO = new UsuarioDAO();
                        $usuario = $usuarioDAO->buscar((int) $_SESSION['id-usuario']);

                        echo '<div id="usuario-foto" class="col-12 col-lg-12 col-xl-6">
                                <img src="../foto-perfil/'.$usuario->getFoto().'" alt="">
                            </div>';
                        echo '<div id="usuario-info" class="col-12 col-lg-12 col-xl-6">';
                            echo '<div class="input-group mb-3">
                                    <input placeholder="'.$usuario->getNome().'">
                                </div>';
                                echo '<div class="input-group mb-3">
                                        <input placeholder="'.$usuario->getEmail().'">
                                    </div>';
                            echo '<button class="btn btn-lg btn-block btn-warning" data-toggle="modal" data-target="#modalAlterarSenha">
                                    Alterar senha
                                </button>';
                        echo '</div>';

                    ?>

                </div>
                <div id="feed">
                    <?php

                        include_once('class/usuario.class.php');
                        include_once('dao/post.dao.php');
                        include_once('dao/usuario.dao.php');
                        include_once('dao/grupo.dao.php');

                        $usuarioDAO = new UsuarioDAO();
                        $usuario = $usuarioDAO->buscar((int) $_SESSION['id-usuario']);
                        $postDAO = new PostDAO();
                        $feed = $postDAO->listar(10, 0, $usuario->getId());

                        foreach ($feed as $post) {
                            $usuarioDAO = new UsuarioDAO();
                            $idAutor = $post->getIdUsuario();
                            $autor = $usuarioDAO->buscar($idAutor);
                            $grupoDAO = new GrupoDAO();
                            $grupo = $grupoDAO->buscar($post->getIdGrupo());
                            echo '<div class="post">
                                    <div class="cabecalho-post">
                                        <img class="foto-autor" src="../foto-perfil/'.$autor->getFoto().'">
                                        <div class="titulo-post"> <h3> '.$post->getTitulo().'[ '.$grupo->getNome().' ] </h3> </div>
                                        <div class="data-post"> '.$post->getData()->format('Y-m-d H:i:s').' </div>
                                    </div>
                                    <div class="conteudo-post">
                                        <p>'.$post->getDescricao().'</p>
                                    </div>
                                </div>';
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalAlterarSenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Alterar Senha </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <hr>
                    <form action="#" id="alterar">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> Senha </span>
                            </div>
                            <input type="password" name="senha" id="senha" aria-label="Senha" class="form-control" required pattern="(\w|[!@#-_$%^*()+=\|/]){6,20}">
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> Confirmar Senha </span>
                            </div>
                            <input type="password" name="confirmar-senha" id="confirmar-senha" aria-label="Confirmar Senha" class="form-control" required pattern="(\w|[!@#-_$%^\*()+=\|/]){6,20}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Sair </button>
                    <button type="submit" class="btn btn-primary" id="cadastrar"> Confirmar </button>
                </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>
