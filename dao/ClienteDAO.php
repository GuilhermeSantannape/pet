<?php
    include_once './class/Cliente.php';
    include_once './validar/valida.php';
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
            $cliente->id = $pdo->lastInsertid();
            Ativastatus($cliente->id);
            return $cliente;
        }

        public function deletar($id)
        {
            $qDeletar = "UPDATE clientes set status='I' WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
        }

        public function atualizar(Cliente $cliente)
        {
            $qAtualizar = "UPDATE clientes SET nome=:nome,status=:status WHERE id=:id";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":id",$cliente->id);
            $comando->bindParam(":nome",$cliente->nome);
            $comando->bindParam(":status",$cliente->status);
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
                    $row->status);
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
                $result->status );           
        }



       
    }
?>