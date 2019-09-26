<?php
require_once './class/Raca.php';
require_once './dao/RacaDAO.php';

class RacaController{
    public function listar($request, $response, $args) {

        $dao = new RacaDAO;    
        $array_clientes = $dao->listar();        
        
        $response = $response->withJson($array_clientes);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }


    public function buscar($request, $response, $args) {

        
        $id = (int) $args['id'];
        
        $dao = new RacaDAO;    
        $raca = $dao->buscarPorId($id);  
        
        $response = $response->withJson($raca);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
    public function inserir($request, $response, $args) {
        $var = $request->getParsedBody();
        $raca = new Raca(0, $var['desc_raca']);
    
        $dao = new RacaDAO;    
        $raca = $dao->inserir($raca);
    
        $response = $response->withJson($raca);
        $response = $response->withHeader('Content-type', 'application/json');    
        $response = $response->withStatus(201);
        return $response;
    }
    public function atualizar($request, $response, $args) {
        $id = (int) $args['id'];
        $var = $request->getParsedBody();
        $raca = new Raca($id, $var['desc_raca']);
    
        $dao = new RacaDAO;    
        $dao->atualizar($raca);
    
        $response = $response->withJson($raca);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
    public function deletar($request, $response, $args) {
        $id = (int) $args['id'];
    
        $dao = new RacaDAO; 
        $raca = $dao->buscarPorId($id);   
        $dao->deletar($id);
    
        $response = $response->withJson($raca);
        $response = $response->withHeader('Content-type', 'application/json');    
        return $response;
    }
}
?>