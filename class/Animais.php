<?php
    class Animais {

        public $id_animal;
        public $id_raca;
        public $desc_raca;
        

        function __construct($id_animal, $id_raca, $desc_raca){

            $this->id_animal = $id_animal;
            $this->id_raca = $id_raca;
            $this->desc_raca = $desc_raca;
           
        }
    }
?>