<?php
    class Animais {

        public $id_animal;
        public $id_raca;
        public $desc_animal;
        

        function __construct($id_animal, $id_raca, $desc_animal){

            $this->id_animal = $id_animal;
            $this->id_raca = $id_raca;
            $this->desc_animal = $desc_animal;
           
        }
    }
?>