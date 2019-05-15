<?php
    class Gerente {
        public $id;
        public $nome;
        public $cpf;
        public $dtnascimento;
        public $login;
        public $senha;        

        function __construct($id, $nome, $cpf,$dtnascimento,$login,$senha){
            $this->id = $id;
            $this->nome = $nome;
            $this->cpf = $cpf;
            $this->dtnascimento = $dtnascimento;
            $this->login = $login;
            $this->senha = $senha;
        }
    }
?>