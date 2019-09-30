<?php
    class Cliente {
        public $id;
		public $nome;
       	public $id_animal;
       	public $status;
       
        

        function __construct($id,$nome,$id_animal,$status ){
            $this->id = $id;
            $this->nome = $nome;
            $this->id_animal = $id_animal;
            $this->status =$status;
         
           
        }
    }
?>