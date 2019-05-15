<?php
    include_once 'Aluno.php';
	include_once 'PDOFactory.php';

    class AlunoDAO
    {
        public function inserir(Aluno $aluno)
        {
            $qInserir = "INSERT INTO aluno(nome, cpf, dtNascimento) VALUES (:nome, :cpf, :dtNascimento)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$aluno->nome);
            $comando->bindParam(":cpf",$aluno->cpf);
            $comando->bindParam(":dtNascimento",$aluno->dtNascimento);
            $comando->execute();
            $aluno->id = $pdo->lastInsertId();
            return $aluno;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from aluno WHERE id=:id";            
            $aluno = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $aluno;
        }

        public function atualizar(Aluno $aluno)
        {
            $qAtualizar = "UPDATE aluno SET nome=:nome, cpf=:cpf, dtNascimento=:dtNascimento WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$aluno->nome);
            $comando->bindParam(":cpf",$aluno->cpf);
            $comando->bindParam(":dtNascimento",$aluno->dtnascimento);
            $comando->bindParam(":id",$aluno->id);
            $comando->execute();
            return $aluno;        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM aluno';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $alunos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $alunos[] = new Aluno($row->id, $row->nome, $row->cpf, $row->dtnascimento);
            }
            return $alunos;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM aluno WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Aluno($result->id, $result->nome, $result->cpf, $result->dtnascimento);           
        }

        public function buscarPorNome($nome)
        {
 		    $query = 'SELECT * FROM aluno WHERE nome=:nome';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('login', $nome);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Aluno($result->id, $result->nome, $result->cpf, $result->dtNascimento);           
        }
    }
?>