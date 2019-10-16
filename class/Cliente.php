<?php
    class Cliente {
        public $id;
		public $nome;
       	public $status;
       
        

        function __construct($id,$nome,$status ){
            $this->id = $id;
            $this->nome = $nome;
            $this->status =$status;
         
           
        }
    }
?>