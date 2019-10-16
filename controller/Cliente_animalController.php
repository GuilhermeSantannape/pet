<?php

require_once './class/Cliente_animal.php';
require_once './dao/Cliente_animalDAO.php';

class Cliente_animalController{
    public function listar($request, $response, $args) {
        $dao = new Cliente_animalDAO;    
        $array_clientes = $dao->listar();        
        
        $response = $response->withJson($array_clientes);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
    public function buscar($request, $response, $args) {
        
        $id = (int) $args['id'];
        
        $dao = new Cliente_animalDAO;    
        $cliente_animais = $dao->buscarPorId($id);   
        $response = $response->withJson($cliente_animais);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
    public function inserir($request, $response, $args) {
        $var = $request->getParsedBody();
        $cliente_animais = new Cleinte_animais(0, $var['desc_animal'], $var['$id_raca']);
    
        $dao = new Cliente_animalDAO;    
        $cliente_animais = $dao->inserir($cliente_animais);
    
        $response = $response->withJson($cliente_animais);
        $response = $response->withHeader('Content-type', 'application/json');    
        $response = $response->withStatus(201);
        return $response;
    }
    public function atualizar($request, $response, $args) {
        $id = (int) $args['id'];
        $var = $request->getParsedBody();
        $cliente_animais = new Cleinte_animais($id, $var['desc_animal']);
    
        $dao = new Cliente_animalDAO;    
        $dao->atualizar($cliente_animais);
    
        $response = $response->withJson($cliente_animais);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
    public function deletar($request, $response, $args) {
        $id = (int) $args['id'];
    
        $dao = new Cliente_animalDAO; 
        $cliente_animais = $dao->buscarPorId($id);   
        $dao->deletar($id);
    
        $response = $response->withJson($cliente_animais);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
}
?>