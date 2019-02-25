<?php

    include_once("class/conexao.class.php");
    include_once("class/comentario.class.php");
    include_once("interface/dao.interface.php");

    class ComentarioDAO implements DAO {

        public function inserir(Comentario $comentario) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            pg_query($conexao, "SET SET timezone = 'UTC';");
            $SQL = "INSERT INTO comentario (nome, data) VALUES ($1, NOW())";
            $VALORES = array($comentario->getNome());
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);
        }

        public function buscacomentarios(int $limit, int $offset) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = "SELECT * FROM comentario LIMIT $1 OFFSET $2";
            $VALORES = array($limit, $offset);
            $resultados = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);

            $comentarios = array();
            while($resultado = pg_fetch_assoc($resultados)) {
                $comentario = new comentario ($resultado["nome"], $resultado["foto"]);
                $comentario->setId($resultado["id"]);
                array_push($comentarios, $comentario);
            }
            return $comentarios;
        }

        public function buscacomentario(String $id) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = "SELECT * FROM comentario WHERE id = $1";
            $VALORES = array($id);
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);

            $resultado = pg_fetch_array($resultado);
            $comentario = new comentario ($resultado["nome"], $resultado["foto"]);
            $comentario->setId($resultado["id"]);
            return $comentario;
        }

        public function alterar(comentario $comentario) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = "UPDATE comentario SET nome = $1, foto = $2 WHERE id = $3";
            $VALORES = array($comentario->getNome(), $comentario->getFoto(), $comentario->getId());
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);
        }

        public function deletar(String $id) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = "DELETE FROM comentario WHERE id = $1";
            $VALORES = array($id);
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);
        }

    }
?>