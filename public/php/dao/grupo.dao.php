<?php

    include_once("class/conexao.class.php");
    include_once("class/grupo.class.php");
    include_once("interface/dao.interface.php");

    class GrupoDAO implements DAO {

        public function inserir($grupo) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = "INSERT INTO grupo (nome, criador) VALUES ($1, $2) RETURNING id";
            $VALORES = array($grupo->getNome(), $grupo->getIdCriador());
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            $row = pg_fetch_row($resultado);
            $idgrupo = $row[0];
            $SQL = "INSERT INTO usuariogrupo (idusuario, idgrupo) VALUES ($1, $2)";
            $VALORES = array($grupo->getIdCriador(), $idgrupo);
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);
        }

        public function listar(int $limit, int $offset) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = "SELECT * FROM grupo LIMIT $1 OFFSET $2";
            $VALORES = array($limit, $offset);
            $resultados = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);

            $grupos = array();
            while($resultado = pg_fetch_assoc($resultados)) {
                $grupo = new Grupo ($resultado["nome"]);
                $grupo->setId($resultado["id"]);
                $grupo->setIdCriador($resultado['criador']);
                array_push($grupos, $grupo);
            }
            return $grupos;
        }

        public function buscar(int $id) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = "SELECT * FROM grupo WHERE id = $1";
            $VALORES = array($id);
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);

            $resultado = pg_fetch_array($resultado);
            $grupo = new Grupo ($resultado["nome"]);
            $grupo->setId($resultado["id"]);
            $grupo->setIdCriador($resultado['criador']);
            return $grupo;
        }

        public function alterar($grupo) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = "UPDATE grupo SET nome = $1 WHERE id = $2";
            $VALORES = array($grupo->getNome(), $grupo->getId());
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);
        }

        public function deletar(int $id) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = "DELETE FROM grupo WHERE id = $1";
            $VALORES = array($id);
            $resultado = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);
        }

        public function buscarGruposUsuario(int $limit, int $offset, int $id) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = "SELECT G.NOME,
                            G.ID,
                            CRIADOR
                        FROM GRUPO AS G
                            JOIN USUARIOGRUPO AS UG ON G.id = UG.IDGRUPO
                            WHERE UG.IDUSUARIO = $3
                            LIMIT $1 OFFSET $2";
            $VALORES = array($limit, $offset, $id);
            $resultados = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);

            $grupos = array();
            while($resultado = pg_fetch_assoc($resultados)) {
                $grupo = new Grupo ($resultado['nome']);
                $grupo->setId($resultado['id']);
                $grupo->setIdCriador($resultado['criador']);
                array_push($grupos, $grupo);
            }
            return $grupos;
        }

        public function buscarPorNome(String $nome) {
            $conexao = new Conexao();
            $conexao = $conexao->conectaBD();
            $SQL = "SELECT * FROM grupo WHERE UPPER(nome) LIKE UPPER($1)";
            $VALORES = array('%'.$nome.'%');
            $resultados = pg_query_params($conexao, $SQL, $VALORES);
            pg_close($conexao);

            $grupos = array();
            while($resultado = pg_fetch_assoc($resultados)) {
                $grupo = new Grupo ($resultado['nome']);
                $grupo->setId($resultado['id']);
                $grupo->setIdCriador($resultado['criador']);

                array_push($grupos, $grupo);
            }
            return $grupos;
        }

    }

?>