<?php
    include_once 'Gerente.php';
	include_once 'PDOFactory.php';

    class GerenteDAO
    {
        public function inserir(Gerente $gerente)
        {
            $qInserir = "INSERT INTO gerente(nome, cpf, dtnascimento, login, senha) VALUES (:nome, :cpf, :dtnascimento, :login, :senha)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$gerente->nome);
            $comando->bindParam(":cpf",$gerente->cpf);
            $comando->bindParam(":dtnascimento",$gerente->dtnascimento);
            $comando->bindParam(":login",$gerente->login);
            $comando->bindParam(":senha",$gerente->senha);
            $comando->execute();
            $gerente->id = $pdo->lastInsertId();
            return $gerente;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from gerente WHERE id=:id";            
            $gerente = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $gerente;
        }

        public function atualizar(Gerente $gerente)
        {
            $qAtualizar = "UPDATE gerente SET nome=:nome, cpf=:cpf, dtnascimento=:dtnascimento, login=:login, senha=:senha WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$gerente->nome);
            $comando->bindParam(":cpf",$gerente->cpf);
            $comando->bindParam(":dtnascimento",$gerente->dtnascimento);
            $comando->bindParam(":login",$gerente->login);
            $comando->bindParam(":senha",$gerente->senha);
            $comando->bindParam(":id",$gerente->id);
            $comando->execute();
            return $gerente;        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM gerente';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $gerentes=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $gerentes[] = new Gerente($row->id, $row->nome, $row->cpf, $row->dtnascimento, $row->login, $row->senha);
            }
            return $gerentes;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM gerente WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Gerente($result->id, $result->nome, $result->cpf, $result->dtnascimento, $result->login, $result->senha);           
        }

        public function buscarPorLogin($login)
        {
 		    $query = 'SELECT * FROM gerente WHERE login=:login';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('login', $login);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Gerente($result->id, $result->nome, $result->cpf, $result->dtnascimento, $result->login, $result->senha);           
        }
    }
?>