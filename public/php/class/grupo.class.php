<?php

    class Grupo {

        private $id;
        private $nome;
        private $idcriador;
        private $usuarios;

        public function __construct(String $nome) {
            $this->nome = $nome;
            $this->usuarios = array();
        }

        public function getId() {
            return $this->id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getUsuarios() {
            return $this->usuarios;
        }

        public function getIdCriador() {
            return $this->idcriador;
        }

        public function setId(int $id) {
            $this->id = $id;
        }

        public function setNome(String $nome) {
            $this->nome = $nome;
        }

        public function setIdCriador(int $id) {
            $this->idcriador = $id;
        }

        public function addUsuario(Usuario $usuario) {
            array_push($this->usuarios, $usuario);
        }
    }

?>