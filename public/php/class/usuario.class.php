<?php

    class Usuario {

        private $id;
        private $nome;
        private $foto;
        private $senha;
        private $email;
        private $grupos;

        public function __construct(String $nome, String $foto, $senha, String $email) {
            $this->nome = $nome;
            $this->foto = $foto;
            $this->senha = $senha;
            $this->$email = $email;
            $this->grupos = array();
        }

        public function getId() {
            return $this->id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getFoto() {
            return $this->foto;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getGrupos() {
            return $this->grupos;
        }

        public function setId(int $id) {
            $this->id = $id;
        }

        public function setNome(String $nome) {
            $this->nome = $nome;
        }

        public function setFoto(String $foto) {
            $this->foto = $foto;
        }

        public function setEmail(String $email) {
            $this->email = $email;
        }

        public function setSenha(String $senha) {
            $this->senha = $senha;
        }

        public function addGrupo(String $grupo) {
            array_push($this->grupos, $grupo);
        }
    }

?>