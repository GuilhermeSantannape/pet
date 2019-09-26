<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './controller/ClienteController.php';
require './controller/RacaController.php';

require './vendor/autoload.php';


$app = new \Slim\App;



$app->group('/clientes', function(){

	// usa como endereço para chamar controler que estão em outra classe
    $this->get('','ClienteController:listar');
    $this->post('','ClienteController:inserir');

    $this->get('/{id:[0-9]+}','ClienteController:buscar');
    $this->put('/{id:[0-9]+}','ClienteController:atualizar');
    $this->delete('/{id:[0-9]+}','ClienteController:deletar');
    
});


$app->group('/raca', function(){

	// usa como endereço para chamar controler que estão em outra classe
    $this->get('','RacaController:listar');
    $this->post('','RacaController:inserir');

    $this->get('/{id:[0-9]+}','RacaController:buscar');
    $this->put('/{id:[0-9]+}','RacaController:atualizar');
    $this->delete('/{id:[0-9]+}','RacaController:deletar');
    
});







$app->run();
?>no