<?php
    class Treino {
        public $id;
        public $equipamentoid;
        public $alunoid;
        public $carga;

        function __construct($id, $alunoid, $equipamentoid,  $carga){
            $this->id = $id;
            $this->equipamentoid = $equipamentoid;
            $this->alunoid = $alunoid;
            $this->carga = $carga;

        }
    }
?>