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
        $ean = (int) $args["ean"];
        $dao = new ProdutoDao();
        $produto = $dao->buscarPorId($ean);
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
        $ean = (int) $args["ean"];
        $var = $req->getParsedBody();
        $produto = new Produto($ean, $var["nome"], $var["preco"]);
        $dao = new ProdutoDAO();
        $dao->atualizar($produto);
        $resp = $resp->withJson($produto);
        $resp = $resp->withHeader("Content-type", "application/json");
         $response = $response->withStatus(200);
        return $resp;
    }

    public function deletar($req, $resp, $args) {
        $ean = (int) $args["ean"];
        $dao = new ProdutoDAO();
        $produto = $dao->buscarPorId($ean);
        $dao->deletar($ean);
        $resp = $resp->withJson($produto);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }
}
?>