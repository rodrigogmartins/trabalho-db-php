<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tuitcher</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body class="container">
        <div class="row justify-content-center">
            <div id="conteudo" class="col-12 col-lg-7 col-xl-7">
                <div id="tamanho-tela"></div>
                <div id="informacoes">
                    <h1 id="titulo" class="text-center">
                        <img src="../img/logo.png" alt="">
                    </h1>
                    <p id="resumo" class="text-center">
                        Mas bah, Tchê te aprochega nessa rede social
                    </p>
                </div>

                <?php
                    if(isset($_SESSION['naoAutenticado'])):
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> ERRO AO EFETURAR LOGIN!</strong> Usuário ou senha inválidos.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    endif;
                    unset($_SESSION['naoAutenticado']);
                ?>

                <?php
                    if(isset($_SESSION['erroNoCadastro'])):
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> ERRO AO EFETUAR CADASTRO!</strong> Verifique se os campos foram preenchidos corretamente e tente novamente.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    endif;
                    unset($_SESSION['erroNoCadastro']);
                ?>

                <div id="botoes">
                    <button class="btn btn-lg btn-block btn-warning" data-toggle="modal" data-target="#modalLogin">
                        Entrar
                    </button>

                    <button class="btn btn-lg btn-block btn-warning" data-toggle="modal" data-target="#modalCadastro">
                        Cadastrar
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade modal-color" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Entrar </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="login.php" method="POST" id="login">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> Email </span>
                                </div>
                                <input type="email" name="email-login" id="email-login" aria-label="Email" class="form-control" required>
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> Senha </span>
                                </div>
                                <input type="password" name="senha-login" id="senha-login" aria-label="Senha" class="form-control" required>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Sair </button>
                                    <button type="submit" class="btn btn-warning" id="entrar"> Entrar </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Cadastrar </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <hr>
                    <form action="cadastro.php" method="POST" enctype="multipart/form-data" id="cadastro">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> Nome </span>
                            </div>
                            <input type="text" name="nome" id="nome" aria-label="Nome" class="form-control" required>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> Email </span>
                            </div>
                            <input type="email" name="email" id="email" aria-label="Email" class="form-control" required pattern="^[\w_.-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$">
                        </div>
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
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Foto de Perfil</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="imagem" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept="image/*">
                                <label class="custom-file-label" for="inputGroupFile01">Inserir Foto</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Sair </button>
                            <button type="submit" class="btn btn-warning" id="cadastrar"> Cadastrar </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>
