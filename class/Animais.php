<?php
    class Animais {

        public $id_animal;
        public $id_raca;
        public $nome_animal;
        

        function __construct($id_animal, $id_raca, $nome_animal){

            $this->id_animal = $id_animal;
            $this->id_raca = $id_raca;
            $this->nome_animal = $nome_animal;
           
        }
    }
?>