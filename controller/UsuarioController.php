<?php
require_once './class/Usuario.php';
require_once './dao/UsuarioDAO.php';

use \Firebase\JWT\JWT;


class UsuarioController {

    // criação de chave secreta usada para encoding do token e posterior validação
    // essa chave NÃO deve ser compartilhada e pode estar persistida em banco de dados se considerar necessário
    private $secretkey = "s3n4c"; 

    public function autenticar($req, $resp, $args) {

        // busca os dados que vem no request
        $var = $req->getParsedBody();

        // busca se o login recebido existe no banco de dados
        // em caso positivo retorna um objeto com o dados daquele login
        $dao = new UsuarioDAO();
        $usuario = $dao->buscarPorLogin($var["login"]);

        // Se usuário retornar false então o login não existe no banco e retorna 401 Unauthorized
        if($usuario == false) {
            return $resp->withStatus(401);
        } else {
            // verifica se a senha enviada correspondente a senha no BD
            if($usuario->senha == $var["senha"]) {
                // criação do payload do token
                // podem ser inseridos dados interessantes para a aplicação 
                // NUNCA colocar dados sensíveis como senhas e chaves
                $tokenpayload = array(
                    "usuario_id" => $usuario->id,
                    "usuario_nome" => $usuario->nome
                );

                // cria o token passando os dados de payload e o secretkey
                $token = JWT::encode($tokenpayload, $this->secretkey);

                // retorna o token criado
                return $resp->withJson(["token" => $token], 201)
                                ->withHeader('Content-type', 'application/json');   
            } else {
                // em caso negativo retorna 401 Unauthorized
                return $resp->withStatus(401);
            }
        }
    }

    public function validarToken($req, $resp, $next)
    {   
        $token = str_replace("Bearer ", "", $req->getHeader('Authorization')[0]);

        if($token)
        {
            try {
                $decoded = JWT::decode($token, $this->secretkey, array('HS256'));

                if($decoded)
                    return($next($req, $resp));

            } catch(Exception $error) {
                return $resp->withStatus(401);
            }
        }
          
        return $resp->withStatus(401);
    }

}
?>
