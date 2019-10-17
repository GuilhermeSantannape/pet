<?php
require_once './class/Cliente.php';
require_once './dao/ClienteDAO.php';

class ClienteController{
    public function listar($request, $response, $args) {

        $dao = new ClienteDAO;    
        $array_clientes = $dao->listar();        
        
        $response = $response->withJson($array_clientes);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }


    public function buscar($request, $response, $args) {

        
        $id = (int) $args['id'];
        
        $dao = new ClienteDAO;    
        $cliente = $dao->buscarPorId($id);
        $response = $response->withJson($cliente);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
    public function inserir($request, $response, $args) {
        $var = $request->getParsedBody();
        $cliente = new Cliente(0, $var['nome'],$var['status']);
    
        $dao = new ClienteDAO;    
        $cliente = $dao->inserir($cliente);
    
        $response = $response->withJson($cliente);
        $response = $response->withHeader('Content-type', 'application/json');    
        $response = $response->withStatus(201);
        return $response;
    }
    public function atualizar($request, $response, $args) {
        $id = (int) $args['id'];
        $var = $request->getParsedBody();
        $cliente = new Cliente($id, $var['nome'],$var['status']);
        $dao = new ClienteDAO;    
        $dao->atualizar($cliente);
    
        $response = $response->withJson($cliente);
        $response = $response->withHeader('Content-type', 'application/json');    
         $response = $response->withStatus(200);
        return $response;
    }
    public function deletar($request, $response, $args) {
        $id = (int) $args['id'];
    
        $dao = new ClienteDAO; 
        $cliente = $dao->buscarPorId($id);   
        $dao->deletar($id);
    
        $response = $response->withJson($cliente);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
}
?>