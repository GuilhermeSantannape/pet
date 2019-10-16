<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './controller/ClienteController.php';
require './controller/RacaController.php';
require './controller/AnimaisController.php';
require './controller/Cliente_animalController.php';

require './vendor/autoload.php';


//$app = new \Slim\App;
$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);



$app->group('/clientes', function(){

	// usa como endereço para chamar controler que estão em outra classe
    $this->get('','ClienteController:listar');
    $this->post('','ClienteController:inserir');

    $this->get('/{id:[0-9]+}','ClienteController:buscar');
    $this->put('/{id:[0-9]+}','ClienteController:atualizar');
    $this->delete('/{id:[0-9]+}','ClienteController:deletar');
    
});

$app->group('/cliente_animal', function(){

    // usa como endereço para chamar controler que estão em outra classe
    $this->get('','Cliente_animalController:listar');
    $this->post('','Cliente_animalController:inserir');

    $this->get('/{id:[0-9]+}','Cliente_animalController:buscar');
    $this->put('/{id:[0-9]+}','Cliente_animalController:atualizar');
    $this->delete('/{id:[0-9]+}','Cliente_animalController:deletar');
    
});

$app->group('/raca', function(){

	// usa como endereço para chamar controler que estão em outra classe
    $this->get('','RacaController:listar');
    $this->post('','RacaController:inserir');

    $this->get('/{id:[0-9]+}','RacaController:buscar');
    $this->put('/{id:[0-9]+}','RacaController:atualizar');
    $this->delete('/{id:[0-9]+}','RacaController:deletar');
    
});

$app->group('/animais', function(){

    // usa como endereço para chamar controler que estão em outra classe
    $this->get('','AnimaisController:listar');
    $this->post('','AnimaisController:inserir');

    $this->get('/{id:[0-9]+}','AnimaisController:buscar');
    $this->put('/{id:[0-9]+}','AnimaisController:atualizar');
    $this->delete('/{id:[0-9]+}','AnimaisController:deletar');
    
});


$app->post("/auth", "UsuarioController:autenticar");

// agrupamento para organizar o web service chamando os métodos do controller
$app->group("/produtos",
    function () {
        $this->get("", "ProdutoController:listar");
        $this->get("/{id:[0-9]+}", "ProdutoController:buscarPorId");
        $this->post("", "ProdutoController:inserir");
        $this->put("/{id:[0-9]+}", "ProdutoController:atualizar");
        $this->delete("/{id:[0-9]+}", "ProdutoController:deletar");
    })
->add('UsuarioController:validarToken');







$app->run();
?> 