<?php
    include_once './class/Cliente.php';
	include_once 'PDOFactory.php';

    class ClienteDAO
    {
        public function inserir(Cliente $cliente)
        {
            $qInserir = "INSERT INTO clientes(nome) VALUES (:nome)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$cliente->nome);
            $comando->execute();
            $cliente->id = $pdo->lastInsertId();
            return $cliente;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from clientes WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
        }

        public function atualizar(Cliente $cliente)
        {
            $qAtualizar = "UPDATE clientes SET nome=:nome WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$cliente->nome);
            $comando->bindParam(":id",$cliente->id);
            $comando->execute();        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM clientes';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $clientes=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $clientes[] = new Cliente(
                    $row->id,
                    $row->nome,
                    $row->id_animal,
                    $row->status

                    );
            }
            return $clientes;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM clientes WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Cliente($result->id,
                 $result->nome,
                $result->id_animal,
                $result->status );           
        }
    }
?>