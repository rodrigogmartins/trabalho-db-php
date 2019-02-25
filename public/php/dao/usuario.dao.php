<?php

    include_once('class/conexao.class.php');
    include_once('class/usuario.class.php');
    include_once('interface/dao.interface.php');

    class UsuarioDAO implements DAO {

        public function inserir($usuario) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = 'INSERT INTO usuario (nome, foto, senha, email)
                VALUES ($1, $2, md5($3), $4) RETURNING id';
            $VALORES = array($usuario->getNome(), $usuario->getFoto(),
                $usuario->getSenha(), $usuario->getEmail());
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);
            $row = pg_fetch_row($resultado);
            return $row[0];
        }

        public function listar(int $limit, int $offset) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = 'SELECT * FROM usuario LIMIT $1 OFFSET $2';
            $VALORES = array($limit, $offset);
            $resultados = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);

            $usuarios = array();
            while($resultado = pg_fetch_assoc($resultados)) {
                $usuario = new Usuario($resultado['nome'], $resultado['foto'],
                    $usuario['senha'], $resultado['email']);
                $usuario->setId($resultado['id']);
                array_push($usuarios, $usuario);
            }
            return $usuarios;
        }

        public function buscar(int $id) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = 'SELECT * FROM usuario WHERE id = $1';
            $VALORES = array($id);
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);

            $resultado = pg_fetch_array($resultado);
            $usuario = new Usuario($resultado['nome'], $resultado['foto'],
                $resultado['senha'], $resultado['email']);
            $usuario->setId($resultado['id']);
            $usuario->setEmail($resultado['email']);
            return $usuario;
        }

        public function alterar($usuario) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = 'UPDATE usuario SET nome = $1, foto = $2,
                senha = $3, email = $4 WHERE id = $5';
            $VALORES = array($usuario->getNome(), $usuario->getFoto(),
                $usuario->getSenha(), $usuario->getEmail(), $usuario->getId());
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);
        }

        public function deletar(int $id) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = 'DELETE FROM usuario WHERE id = $1';
            $VALORES = array($id);
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);
        }

    }
?>