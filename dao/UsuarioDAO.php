<?php
include_once './class/Usuario.php';
	include_once 'PDOFactory.php';

class UsuarioDAO {

	public function buscarPorId($id) {
		$query   = 'SELECT * FROM usuarios WHERE id=:id';
		$pdo     = PDOFactory::getConexao();
		$comando = $pdo->prepare($query);
		$comando->bindParam('id', $id);
		$comando->execute();
		$result = $comando->fetch(PDO::FETCH_OBJ);
		return new Usuario($result->id, $result->nome, $result->login, $result->senha);
	}

	public function buscarPorLogin($login) {
		$query   = "SELECT * FROM usuarios WHERE login = :login";
		$pdo     = PDOFactory::getConexao();
		$comando = $pdo->prepare($query);
		$comando->bindParam('login', $login);
		$comando->execute();
		$result = $comando->fetch(PDO::FETCH_OBJ);
		
		if(empty($result))
			return false;
		else
			return new Usuario($result->id, $result->nome, $result->login, $result->senha);
	}
}
?>