<?php

    include_once('class/conexao.class.php');
    include_once('class/post.class.php');
    include_once('interface/dao.interface.php');

    class PostDAO implements DAO {

        public function inserir($post) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            pg_query($conexao, 'SET timezone = "UTC"');
            $SQL = 'INSERT INTO post (titulo, descricao, data, idusuario, idgrupo)
                VALUES ($1, $2, NOW(), $3, $4)';
            $VALORES = array($post->getTitulo(), $post->getDescricao(),
                $post->getIdusuario(), $post->getIdgrupo());
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);
        }

        public function listar(int $limit, int $offset) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = 'SELECT * FROM post ORDER BY data DESC LIMIT $1 OFFSET $2';
            $VALORES = array($limit, $offset);
            $resultados = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);

            $feed = array();
            while($resultado = pg_fetch_assoc($resultados)) {
                $post = new Post($resultado['titulo'], $resultado['descricao'],
                    $resultado['idgrupo'], $resultado['idusuario']);
                $post->setId($resultado['id']);
                $post->setData(new DateTime($resultado['data']));
                array_push($feed, $post);
            }
            return $feed;
        }

        public function buscar(int $id) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = 'SELECT * FROM post WHERE id = $1';
            $VALORES = array($id);
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);

            $resultado = pg_fetch_array($resultado);
            $post = new Post($resultado['titulo'], $resultado['descricao'],
                $resultado['idgrupo'], $resultado['idusuario']);
            $post->setId($resultado['id']);
            $post->setData(new DateTime($resultado['data']));
            return $post;
        }

        public function alterar($post) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = 'UPDATE post SET titulo = $1, descricao = $2,
                foto = $3 WHERE id = $5';
            $VALORES = array($post->getTitulo(), $post->getDescricao(),
                $post->getFoto(), $post->getId());
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);
        }

        public function deletar(int $id) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = 'DELETE FROM post WHERE id = $1';
            $VALORES = array($id);
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);
        }

        public function buscarPostsUsuario(int $limit, int $offset, int $id) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = "SELECT P.ID,
                            P.TITULO,
                            P.DESCRICAO,
                            P.DATA,
                            P.IDUSUARIO,
                            UG.IDGRUPO AS IDGRUPO
                        FROM POST AS P
                            JOIN USUARIOGRUPO AS UG ON P.IDGRUPO = UG.IDGRUPO
                            WHERE UG.IDUSUARIO = $3
                            LIMIT $1 OFFSET $2";
            $VALORES = array($limit, $offset, $id);
            $resultados = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);

            $feed = array();
            while($resultado = pg_fetch_assoc($resultados)) {
                $post = new Post($resultado['titulo'], $resultado['descricao'],
                    $resultado['idgrupo'], $resultado['idusuario']);
                $post->setId($resultado['id']);
                $post->setData(new DateTime($resultado['data']));
                array_push($feed, $post);
            }
            return $feed;
        }
    }
?>