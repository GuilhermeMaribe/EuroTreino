<?php
    use \Firebase\JWT\JWT;
    
    include_once 'Gerente.php';
    include_once 'GerenteDAO.php';

    class GerenteController{
        private $secretKey = "sen@c";

        public function inserir($request, $response, $args)
        {

            $var = $request->getParsedBody();
            $gerente = new Gerente(0, $var['nome'], $var['cpf'], $var['dtnascimento'], $var['login'], $var['senha']);
            // var_dump($gerente);
            $dao = new GerenteDAO;    
            $gerente = $dao->inserir($gerente);
        
            return $response->withJson($gerente,201);
        }
        public function autenticar($request, $response, $args)
        {
            $user = $request->getParsedBody();
            
            $dao= new GerenteDAO;    
            $gerente = $dao->buscarPorLogin($user['login']);
            if($gerente->senha == $user['senha'])
            {
                $token = array(
                    'user' => strval($gerente->id),
                    'nome' => $gerente->nome
                );
                $jwt = JWT::encode($token, $this->secretKey);
                return $response->withJson(["token" => $jwt], 201)
                    ->withHeader('Content-type', 'application/json');   
            }
            else
                return $response->withStatus(401);
        }
        public function validarToken($request, $response, $next)
        {
            $token = $request->getHeader('Authorization')[0];
            
            if($token)
            {
                try {
                    $decoded = JWT::decode($token, $this->secretKey, array('HS256'));

                    if($decoded)
                        return($next($request, $response));
                } catch(Exception $error) {

                    return $response->withStatus(401);
                }
            }            
            return $response->withStatus(401);
        }
    }

?>