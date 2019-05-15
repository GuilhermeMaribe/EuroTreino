<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once('GerenteController.php');
include_once('AlunoController.php');
include_once('EquipamentoController.php');
include_once('TreinoController.php');
require './vendor/autoload.php';

$app = new \Slim\App;
	
$app->group('/equipamentos', function() use ($app) {
    $app->get('','EquipamentoController:listar');
    $app->post('','EquipamentoController:inserir');
    $app->get('/{id}','EquipamentoController:buscarPorId');    
    $app->put('/{id}','EquipamentoController:atualizar');
    $app->delete('/{id}', 'EquipamentoController:deletar');
})->add('GerenteController:validarToken');

$app->group('/alunos', function() use ($app) {
    $app->get('','AlunoController:listar');
    $app->post('','AlunoController:inserir');
    $app->get('/{id}','AlunoController:buscarPorId');    
    $app->put('/{id}','AlunoController:atualizar');
    $app->delete('/{id}', 'AlunoController:deletar');
})->add('GerenteController:validarToken');

$app->group('/treinos/aluno', function() use ($app) {
    $app->get('/{id}','TreinoController:buscarPorAluno');    
});

$app->group('/treinos', function() use ($app) {
   // $app->get('','TreinoController:listar');
    $app->post('','TreinoController:inserir'); 
    $app->put('/{id}','TreinoController:atualizar');
    $app->delete('/{id}', 'TreinoController:deletar');
})->add('GerenteController:validarToken');

$app->post('/gerentes','GerenteController:inserir');
$app->post('/auth','GerenteController:autenticar');

$app->run();
?>