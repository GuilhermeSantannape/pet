<?php

require_once './class/Animais.php';
require_once './dao/AnimaisDAO.php';

class AnimaisController{
    public function listar($request, $response, $args) {
        $dao = new AnimaisDAO;    
        $array_clientes = $dao->listar();        
        
        $response = $response->withJson($array_clientes);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
    public function buscar($request, $response, $args) {
        
        $id = (int) $args['id'];
        
        $dao = new AnimaisDAO;    
        $animais = $dao->buscarPorId($id);  
        
        $response = $response->withJson($animais);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
    public function inserir($request, $response, $args) {
        $var = $request->getParsedBody();
        $animais = new Animais(0, $var['desc_raca']);
    
        $dao = new AnimaisDAO;    
        $animais = $dao->inserir($animais);
    
        $response = $response->withJson($animais);
        $response = $response->withHeader('Content-type', 'application/json');    
        $response = $response->withStatus(201);
        return $response;
    }
    public function atualizar($request, $response, $args) {
        $id = (int) $args['id'];
        $var = $request->getParsedBody();
        $animais = new Animais($id, $var['desc_raca']);
    
        $dao = new AnimaisDAO;    
        $dao->atualizar($animais);
    
        $response = $response->withJson($animais);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
    public function deletar($request, $response, $args) {
        $id = (int) $args['id'];
    
        $dao = new AnimaisDAO; 
        $animais = $dao->buscarPorId($id);   
        $dao->deletar($id);
    
        $response = $response->withJson($animais);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
}
?>