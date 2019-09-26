<?php
    include_once './class/Raca.php';
	include_once 'PDOFactory.php';

    class ClienteDAO
    {
        public function inserir(Raca $raca)
        {
            $qInserir = "INSERT INTO raca(desc_raca) VALUES (:desc_raca))";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":desc_raca)",$raca->desc_raca));
            $comando->execute();
            $raca->id_raca = $pdo->lastInsertId();
            return $raca;
        }

        public function deletar($id_raca)
        {
            $qDeletar = "DELETE from raca WHERE id_raca=:id_raca";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id_raca",$id_raca);
            $comando->execute();
        }

        public function atualizar(Raca $raca)
        {
            $qAtualizar = "UPDATE raca SET desc_raca=:desc_raca WHERE id_raca=:id_raca";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":desc_raca",$raca->desc_raca);
            $comando->bindParam(":id_raca",$raca->id_raca);
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
			    $raca[] = new Raca($row->id_raca,$row->Desc_raca);
            }
            return $raca;
        }

        public function buscarPorId($id_raca)
        {
 		    $query = 'SELECT * FROM clientes WHERE id_raca=:id_raca';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id_raca', $id_raca);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Cliente($result->id_raca,$result->desc_raca);           
        }
    }
?>