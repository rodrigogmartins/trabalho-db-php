<?php

    interface DAO {

        public function inserir($obj);
        public function listar(int $limit, int $offset);
        public function buscar(Int $primaryKey);
        public function alterar($obj);
        public function deletar(Int $primaryKey);

    }

?>