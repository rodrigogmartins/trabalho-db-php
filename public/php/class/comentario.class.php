<?php

    class Comentario {

        private $id;
        private $comentario;
        private $data;

        public function __constructor(String $comentario, Date $data) {
            $this->comentario = $comentario;
            $this->data = $data;
        }

        public function getId() {
            return $this->id;
        }

        public function getComentario() {
            return $this->comentario;
        }

        public function getData() {
            return $this->data;
        }

        public function setId(int $id) {
            $this->id = $id;
        }

        public function setComentario(String $comentario) {
            $this->comentario = $comentario;
        }

        public function setData(Date $data) {
            $this->data = $data;
        }
    }

?>