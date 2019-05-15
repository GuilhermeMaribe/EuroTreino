<?php

include_once('Treino.php');
include_once('TreinoDAO.php');


class TreinoController {
    /*public function listar($request, $response, $args) {
        $dao= new TreinoDAO;    
        $treinos =  $dao->listar();                
        return $response->withJson($treinos);    
    }*/
    
    public function buscarPorAluno($request, $response, $args) {
        $id = $args['id'];        
        $dao= new TreinoDAO;    
        $treinos = $dao->buscarPorAluno($id);        
        return $response->withJson($treinos);
    }

    public function inserir( $request, $response, $args) {
        $p = $request->getParsedBody();
        $treino = new Treino(0,$p['alunoid'],$p['equipamentoid'],$p['carga']);    
        $dao = new TreinoDAO;
        $treino = $dao->inserir($treino);    
        return $response->withJson($treino,201);    
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $p = $request->getParsedBody();
        $treino = new Treino($id, $p['alunoid'],$p['equipamentoid'],$p['carga']);    
        $dao = new TreinoDAO;
        $treino = $dao->atualizar($treino);    
        return $response->withJson($treino);    
    }

    public function deletar($request, $response, $args) {
        $id = $args['id'];

        $dao = new TreinoDAO;
        $treino = $dao->deletar($id);
    
        return $response->withJson($treino);  
    }
}