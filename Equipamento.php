<?php
    class Equipamento {
        public $id;
        public $nome;
        public $descricao;

        function __construct($id, $nome, $descricao){
            $this->id = $id;
            $this->nome = $nome;
            $this->descricao = $descricao;
        }
    }
?>