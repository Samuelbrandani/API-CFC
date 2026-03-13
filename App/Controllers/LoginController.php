<?php

namespace App\Controllers;

use App\DAO\MySQL\LoginDAO;
use App\DAO\MySQL\OneSignalDAO;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;

final class LoginController
{
    public function loginAluno(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $COD_ALUNO = $data["cpf"];
        $SENHA = $data["senha"];
        $player_id = $data["player_id"];
        $loginDAO = new LoginDAO($args['cfc']);
        $detalhes = $loginDAO->loginAluno($COD_ALUNO, $SENHA);
        if (count($detalhes) != 0 || $detalhes != null) {
            if ($player_id != "") {
                $oneSignalDAO = new OneSignalDAO($args['cfc']);
                if ($oneSignalDAO->checkPlayerId($player_id)) {
                    if ($oneSignalDAO->insertPlayerId($player_id, $COD_ALUNO)) {
                        $response = $response->withJson(array('data' => $detalhes));
                        return $response;
                    } else {
                        $response = $response->withJson(array('data' => "erro"));
                        return $response;
                    }
                } else {
                    $response = $response->withJson(array('data' => $detalhes));
                    return $response;
                }
            } else {
                $response = $response->withJson(array('data' => $detalhes));
                return $response;
            }
        } else {
            $response = $response->withJson(array('data' => "erro"));
            return $response;
        }
        return $response;
    }
    
    public function loginInstrutor(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $cpf = $data["cpf"];
        $senha = $data["senha"];
        $loginDAO = new LoginDAO($args['cfc']);
        $detalhes = $loginDAO->loginInstrutor($cpf, $senha);
        if (count($detalhes) != 0 || $detalhes != null) {
            $returns = array('data' => $detalhes);
        } else {
            $returns = array('data' => "erro");
        }
        $response = $response->withJson($returns);
        return $response;
    }
}
