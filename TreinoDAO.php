<?php
    include_once 'Treino.php';
	include_once 'PDOFactory.php';

    class TreinoDAO
    {
        public function inserir(Treino $treino)
        {
            $qInserir = "INSERT INTO treino(alunoid,equipamentoid,carga) VALUES (:alunoid,:equipamentoid, :carga)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":alunoid",$treino->alunoid);
            $comando->bindParam(":equipamentoid",$treino->equipamentoid);
            $comando->bindParam(":carga",$treino->carga);
            $comando->execute();
            $treino->id = $pdo->lastInsertId();
            return $treino;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from treino WHERE id=:id";            
            $treino = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $treino;
        }

        public function atualizar(Treino $treino)
        {
            $qAtualizar = "UPDATE treino SET alunoid=:alunoid, equipamentoid=:equipamentoid, carga=:carga WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":alunoid",$treino->alunoid);
            $comando->bindParam(":equipamentoid",$treino->equipamentoid);
            $comando->bindParam(":carga",$treino->carga);
            $comando->bindParam(":id",$treino->id);
            $comando->execute();
            return $treino;        
        }

       /* public function listar()
        {
		    $query = 'SELECT * FROM treino';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $treinos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $treinos[] = new treino($row->id,$row->alunoid,$row->equipamentoid,$row->carga);
            }
            return $treinos;
        }*/

        public function buscarPorAluno($id)
        {
 		    $query = 'SELECT * FROM treino WHERE alunoid = :alunoid';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':alunoid', $id);
		    $comando->execute();
		    $treinos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $treinos[] = new treino($row->id,$row->alunoid,$row->equipamentoid,$row->carga);
            }
            return $treinos;         
        }
    }
?>