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
        <link rel="stylesheet" href="../css/grupo.css">
    </head>
    <body class="container">
        <div class="row justify-content-center">
            <div id="conteudo" class="col-12 col-lg-7 col-xl-7">
                <div id="tamanho-tela"></div>
                <div id="informacoes" class="row justify-content-end">
                    <div class="col-4 col-lg-4 col-xl-4">
                    <div class="dropdown">
                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="btn btn-warning btn-block" href="feed.php">FEED</a>
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
                    <div id="usuario-foto" class="col-4 col-lg-4 col-xl-4">
                        <a href="perfil.php">
                            <?php
                                include_once('class/usuario.class.php');
                                include_once('dao/usuario.dao.php');

                                $usuarioDAO = new UsuarioDAO();
                                $usuario = $usuarioDAO->buscar((int) $_SESSION['id-usuario']);
                                echo '<img class="foto-perfil" src="../foto-perfil/'.$usuario->getFoto().'">';
                            ?>
                        </a>
                    </div>
                </div>
                <div id="procurar">
                    <form action="#">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Buscar" aria-label="Buscar" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-warning" type="button" id="button-addon2">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div>
                    <form action="criargrupo.php" method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="nome-grupo" class="form-control" placeholder="Inserir nome do grupo" aria-label="Recipient's username" aria-describedby="button-addon2" require>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-warning"> Criar Grupo </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div>
                    <h1 id="titulo" class="text-center">
                        Meus Grupos
                    </h1>

                    <div id="tabela">
                        <table class="table table-striped table-dark" name="table">
                            <thead>
                                <tr>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Nome</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include_once('class/usuario.class.php');
                                    include_once('dao/grupo.dao.php');

                                    $usuario = unserialize($_SESSION['usuario']);
                                    $grupoDAO = new GrupoDAO();
                                    $grupos = $grupoDAO->buscarGruposUsuario(10, 0, $usuario->getId());

                                    foreach ($grupos as $grupo) {
                                        if ($grupo->getIdCriador() === $usuario->getId()) {
                                            echo '<tr>
                                                    <td>'.$grupo->getId().'</td>
                                                    <td>'.$grupo->getNome().'</td>
                                                    <td>
                                                        <a class="btn btn-warning" href="editargrupo.php?id='.$grupo->getId().'">
                                                            EDITAR
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-danger" href="deletargrupo.php?id='.$grupo->getId().'">
                                                            Deletar
                                                        </a>
                                                    </td>
                                                </tr>';
                                        } else {
                                            echo '<tr>
                                                    <td>'.$grupo->getId().'</td>
                                                    <td>'.$grupo->getNome().'</td>
                                                    <td>
                                                        <button class="btn btn-danger">
                                                            Sair
                                                        </button>
                                                    </td>
                                                </tr>';
                                        }
                                    }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>
