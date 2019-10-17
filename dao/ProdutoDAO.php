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
          $produtos[] = new Produto($row->ean, $row->nome, $row->preco);
        }
        return $produtos;
    }

    public function buscarPorId($ean) {
      $pdo = PDOFactory::getConexao();
      $query = "SELECT * FROM produtos WHERE ean = :ean";
      $comando = $pdo->prepare($query);
      $comando->bindParam("ean", $ean);
      $comando->execute();
      $resultado = $comando->fetch(PDO::FETCH_OBJ);
      return new Produto($resultado->ean,$resultado->nome,$resultado->preco);
    }

    public function inserir(Produto $produto) {
      $query = "INSERT INTO produtos (nome, preco) VALUES (:nome, :preco)";
      $pdo = PDOFactory::getConexao();
      $comando = $pdo->prepare($query);
      $comando->bindParam(":nome", $produto->nome);
      $comando->bindParam(":preco", $produto->preco);
      $comando->execute();
      $produto->ean = $pdo->lastInsertId();
      return $produto;
    }

    public function atualizar(Produto $produto) {
      $query = "UPDATE produtos SET nome=:nome , preco=:preco WHERE ean=:ean";
      $pdo = PDOFactory::getConexao();
      $comando = $pdo->prepare($query);
      $comando->bindParam(":ean", $produto->ean);
      $comando->bindParam(":nome", $produto->nome);
      $comando->bindParam(":preco", $produto->preco);
      $comando->execute();
      return $produto;
    }

    public function deletar($ean) {
      $query = "DELETE FROM produtos WHERE ean=:ean";
      $pdo = PDOFactory::getConexao();
      $comando = $pdo->prepare($query);
      $comando->bindParam(":ean", $ean);
      $comando->execute();
      return $ean;
    }
  }
?>
