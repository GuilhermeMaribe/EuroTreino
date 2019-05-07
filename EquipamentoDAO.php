<?php
    include_once 'Equipamento.php';
	include_once 'PDOFactory.php';

    class EquipamentoDAO
    {
        public function inserir(Equipamento $equipamento)
        {
            $qInserir = "INSERT INTO equipamento(nome,descricao) VALUES (:nome,:descricao)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$equipamento->nome);
            $comando->bindParam(":descricao",$equipamento->descricao);
            $comando->execute();
            $equipamento->id = $pdo->lastInsertId();
            return $equipamento;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from equipamento WHERE id=:id";            
            $equipamento = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $equipamento;
        }

        public function atualizar(Equipamento $equipamento)
        {
            $qAtualizar = "UPDATE equipamento SET nome=:nome, descricao=:descricao WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$equipamento->nome);
            $comando->bindParam(":descricao",$equipamento->descricao);
            $comando->bindParam(":id",$equipamento->id);
            $comando->execute();
            return $equipamento;        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM equipamento';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $equipamentos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $equipamentos[] = new Equipamento($row->id,$row->nome,$row->descricao);
            }
            return $equipamentos;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM equipamento WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Equipamento($result->id,$result->nome,$result->descricao);           
        }
    }
?>