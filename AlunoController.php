<?php

include_once('Aluno.php');
include_once('AlunoDAO.php');


class AlunoController {
    public function listar($request, $response, $args) {
        $dao= new AlunoDAO;    
        $alunos =  $dao->listar();
                
        return $response->withJson($alunos);    
    }
    
    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new AlunoDAO;    
        $aluno = $dao->buscarPorId($id);
        
        return $response->withJson($aluno);
    }

    public function inserir( $request, $response, $args) {
        $p = $request->getParsedBody();
        $aluno = new Aluno(0,$p['nome'],$p['cpf'],$p['dtNascimento']);
    
        $dao = new AlunoDAO;
        $aluno = $dao->inserir($aluno);
    
        return $response->withJson($aluno,201);    
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $p = $request->getParsedBody();
        $aluno = new Aluno($id, $p['nome'],$p['cpf'],$p['dtNascimento']);
    
        $dao = new AlunoDAO;
        $aluno = $dao->atualizar($aluno);
    
        return $response->withJson($aluno);    
    }

    public function deletar($request, $response, $args) {
        $id = $args['id'];

        $dao = new AlunoDAO;
        $aluno = $dao->deletar($id);
    
        return $response->withJson($aluno);  
    }
}