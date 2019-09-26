<?php
    include_once './class/raca.php';
	include_once 'PDOFactory.php';

    class RacaDao
    {
        public function inserir(Raca $raca)
        {
            $qInserir = "INSERT INTO raca(desc_raca) VALUES (:desc_raca)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":desc_raca",$raca->desc_raca);
            $comando->execute();
            $raca->id = $pdo->lastInsertId();
            return $raca;
        }

     public function deletar($id)
        {
            $qDeletar = "DELETE from raca WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
        }

        public function atualizar(Raca $raca)
        {
            $qAtualizar = "UPDATE raca SET desc_raca=:desc_raca WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":desc_raca",$raca->desc_raca);
            $comando->bindParam(":id",$raca->id);
            $comando->execute();        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM raca';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $raca=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			   $raca[] = new Raca($row->id,$row->desc_raca);
            }
            return $raca;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM raca WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Raca($result->id,$result->desc_raca);           
        }
    }
?>