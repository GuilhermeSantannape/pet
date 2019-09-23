<?php
    class Cliente {
        public $id;
        public $nome;
        

        function __construct($id, $nome){
            $this->id = $id;
            $this->nome = $nome;
           
        }
    }
?>