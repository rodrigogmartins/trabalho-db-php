<?php

    class Post {

        private $id;
        private $titulo;
        private $descricao;
        private $data;
        private $idgrupo;
        private $idusuario;
        private $comentarios;

        public function __construct($titulo, $descricao, $idgrupo, $idusuario) {
            $this->titulo = $titulo;
            $this->descricao = $descricao;
            $this->idgrupo = $idgrupo;
            $this->idusuario = $idusuario;
            $this->comentarios = array();
        }

        public function getId() {
            return $this->id;
        }

        public function getTitulo() {
            return $this->titulo;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function getData() {
            return $this->data;
        }

        public function getComentarios() {
            return $this->comentarios;
        }

        public function getIdUsuario() {
            return $this->idusuario;
        }

        public function getIdGrupo() {
            return $this->idgrupo;
        }

        public function setId(int $id) {
            $this->id = $id;
        }

        public function setTitulo(String $titulo) {
            $this->titulo = $titulo;
        }

        public function setDescricao(String $descricao) {
            $this->descricao = $descricao;
        }

        public function setData(DateTime $data) {
            $this->data = $data;
        }

        public function addComentario(Comentario $comentario) {
            array_push($this->comentarios, $comentario);
        }
    }

?>