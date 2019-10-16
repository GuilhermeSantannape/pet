<?php
    include_once './class/Cliente_animal.php';
	include_once 'PDOFactory.php';

    class Cliente_animalDAO
    {
        public function inserir(Cliente_animal $cliente_animais)
        {
            $qInserir = "INSERT INTO cliente_animal(id, id) VALUES (:id, :id)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":id",$cliente_animais->id);
            $comando->bindParam(":id_raca",$cliente_animais->id_raca);
            $comando->execute();
            $cliente_animais->id = $pdo->lastInsertid();
            return $cliente_animais;
        }

     public function deletar($id)
        {
            $qDeletar = "DELETE from cliente_animal WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
        }

        public function atualizar(Cliente_animal $cliente_animais)
        {
            $qAtualizar = "UPDATE cliente_animal SET id_animal=:id_animal WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":id_animal",$cliente_animais->id_animal);
            $comando->bindParam(":id",$cliente_animais->id);
            $comando->execute();        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM cliente_animal';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $cliente_animais=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			   $cliente_animais[] = new Cleinte_animal(
                $row->id,
                $row->id_animal,
                $row->id_raca);
            }
            return $cliente_animais;
        }

        public function buscarPorid($id)
        {
 		    $query = 'SELECT * FROM cliente_animal WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Cleinte_animal(
                $result->id,
                $result->id_animal,
                );           
        }
    }
?>