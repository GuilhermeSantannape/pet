<?php
   
    


         function Ativastatus($id){

            $qAtiva = "UPDATE clientes set status='A' WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtiva);
            $comando->bindParam(":id",$id);
            $comando->execute();   
        
    }
?>