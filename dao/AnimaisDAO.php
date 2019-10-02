<?php
    include_once './class/Animais.php';
	include_once 'PDOFactory.php';

    class AnimaisDao
    {
        public function inserir(Animais $animais)
        {
            $qInserir = "INSERT INTO animais(desc_raca) VALUES (:desc_raca)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":desc_raca",$animais->desc_raca);
            $comando->execute();
            $animais->id_animal = $pdo->lastInsertid_animal();
            return $animais;
        }

     public function deletar($id_animal)
        {
            $qDeletar = "DELETE from animais WHERE id_animal=:id_animal";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id_animal",$id_animal);
            $comando->execute();
        }

        public function atualizar(Animais $animais)
        {
            $qAtualizar = "UPDATE animais SET desc_raca=:desc_raca WHERE id_animal=:id_animal";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":desc_raca",$animais->desc_raca);
            $comando->bindParam(":id_animal",$animais->id_animal);
            $comando->execute();        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM animais';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $animais=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			   $animais[] = new Animais(
                $row->id_animal,
                $row->desc_raca);
            }
            return $animais;
        }

        public function buscarPorid($id_animal)
        {
 		    $query = 'SELECT * FROM animais WHERE id_animal=:id_animal';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id_animal', $id_animal);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Animais(
                $result->id_animal,
                $result->desc_raca);           
        }
    }
?>