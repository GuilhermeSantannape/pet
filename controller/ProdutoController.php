<?php

class ProdutoController {

    public function listar($req, $resp, $args) {
        $dao = new ProdutoDAO();
        $lista = $dao->listar();
        $resp = $resp->withJson($lista);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function buscarPorId($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new ProdutoDao();
        $produto = $dao->buscarPorId($id);
        $resp = $resp->withJson($produto);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function inserir($req, $resp, $args) {
        $var = $req->getParsedBody();
        $produto = new Produto(0, $var["nome"], $var["preco"]);
        $dao = new ProdutoDao();
        $dao->inserir($produto);
        $resp = $resp->withJson($produto);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

    public function atualizar($req, $resp, $args) {
        $id = (int) $args["id"];
        $var = $req->getParsedBody();
        $produto = new Produto($id, $var["nome"], $var["preco"]);
        $dao = new ProdutoDAO();
        $dao->atualizar($produto);
        $resp = $resp->withJson($produto);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function deletar($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new ProdutoDAO();
        $produto = $dao->buscarPorId($id);
        $dao->deletar($id);
        $resp = $resp->withJson($produto);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }
}
?>