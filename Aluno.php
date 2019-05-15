<?php
    class Aluno {
        public $id;
        public $nome;
        public $cpf;
        public $dtNascimento;      

        function __construct($id, $nome, $cpf,$dtNascimento){
            $this->id = $id;
            $this->nome = $nome;
            $this->cpf = $cpf;
            $this->dtNascimento = $dtNascimento;
        }
    }
?>