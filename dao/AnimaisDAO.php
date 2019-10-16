<?php
    include_once './class/Animais.php';
    include_once './validar/valida.php';
	include_once 'PDOFactory.php';

    class AnimaisDao
    {
        public function inserir(Animais $animais)
        {
            $qInserir = "INSERT INTO animais(nome_animal, id_raca) VALUES (:nome_animal, :id_raca)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome_animal",$animais->nome_animal);
            $comando->bindParam(":id_raca",$animais->id_raca);
            echo($animais->id_raca);
            $comando->execute();
            $animais->id_animal = $pdo->lastInsertid();
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
            $qAtualizar = "UPDATE animais SET nome_animal=:nome_animal WHERE id_animal=:id_animal";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome_animal",$animais->nome_animal);
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
                $row->id_raca,
             $row->nome_animal);
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
                $result->id_raca,
                    $result->nome_animal,);           
        }
    }
?>