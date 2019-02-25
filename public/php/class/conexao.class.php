<?php

    class Conexao {

        private $STR_CONEXAO;
        private $HOST = 'localhost';
        private $PORT = '5432';
        private $DBNAME = 'tuitcher';
        private $USER = 'postgres';
        private $PASSWORD = 'postgres';

        public function conectaBD() {
            $STR_CONEXAO = "host={$this->HOST} port={$this->PORT}
                dbname={$this->DBNAME} user={$this->USER} password={$this->PASSWORD}";
            $conexao = pg_connect($STR_CONEXAO);
            if(!$conexao) {
                throw new Exception("Erro ao tentar conectar com banco de dados", 1);
            }
            return $conexao;
        }
    }

?>