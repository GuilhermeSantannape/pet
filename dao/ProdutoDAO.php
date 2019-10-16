<?php 

  include_once './class/Produto.php';
  include_once 'PDOFactory.php';
    class ProdutoDAO {
      
      public $pdo;

      public function  listar() {
        $pdo = PDOFactory::getConexao();
        $query = "SELECT * FROM produtos";
        $comando = $pdo->prepare($query);
        $comando->execute();
        $produtos = array();
        while ($row = $comando->fetch(PDO::FETCH_OBJ)) {
          $produtos[] = new Produto($row->id, $row->nome, $row->preco);
        }
        return $produtos;
    }

    public function buscarPorId($id) {
      $pdo = PDOFactory::getConexao();
      $query = "SELECT * FROM produtos WHERE id = :id";
      $comando = $pdo->prepare($query);
      $comando->bindParam("id", $id);
      $comando->execute();
      $resultado = $comando->fetch(PDO::FETCH_OBJ);
      return new Produto($resultado->id,$resultado->nome,$resultado->preco);
    }

    public function inserir(Produto $produto) {
      $query = "INSERT INTO produtos (nome, preco) VALUES (:nome, :preco)";
      $pdo = PDOFactory::getConexao();
      $comando = $pdo->prepare($query);
      $comando->bindParam(":nome", $produto->nome);
      $comando->bindParam(":preco", $produto->preco);
      $comando->execute();
      $produto->id = $pdo->lastInsertId();
      return $produto;
    }

    public function atualizar(Produto $produto) {
      $query = "UPDATE produtos SET nome=:nome , preco=:preco WHERE id=:id";
      $pdo = PDOFactory::getConexao();
      $comando = $pdo->prepare($query);
      $comando->bindParam(":id", $produto->id);
      $comando->bindParam(":nome", $produto->nome);
      $comando->bindParam(":preco", $produto->preco);
      $comando->execute();
      return $produto;
    }

    public function deletar($id) {
      $query = "DELETE FROM produtos WHERE id=:id";
      $pdo = PDOFactory::getConexao();
      $comando = $pdo->prepare($query);
      $comando->bindParam(":id", $id);
      $comando->execute();
      return $id;
    }
  }
?>
