<?php

include_once('Equipamento.php');
include_once('EquipamentoDAO.php');


class EquipamentoController {
    public function listar($request, $response, $args) {
        $dao= new EquipamentoDAO;    
        $equipamentos =  $dao->listar();
                
        return $response->withJson($equipamentos);    
    }
    
    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new EquipamentoDAO;    
        $equipamento = $dao->buscarPorId($id);
        
        return $response->withJson($equipamento);
    }

    public function inserir( $request, $response, $args) {
        $p = $request->getParsedBody();
        $equipamento = new Equipamento(0,$p['nome'],$p['descricao']);
    
        $dao = new EquipamentoDAO;
        $equipamento = $dao->inserir($equipamento);
    
        return $response->withJson($equipamento,201);    
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $p = $request->getParsedBody();
        $equipamento = new Equipamento($id, $p['nome'], $p['descricao']);
    
        $dao = new EquipamentoDAO;
        $equipamento = $dao->atualizar($equipamento);
    
        return $response->withJson($equipamento);    
    }

    public function deletar($request, $response, $args) {
        $id = $args['id'];

        $dao = new EquipamentoDAO;
        $equipamento = $dao->deletar($id);
    
        return $response->withJson($equipamento);  
    }
}