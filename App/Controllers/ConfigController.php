<?php

namespace App\Controllers;

use App\DAO\MySQL\ConfigDAO;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;

final class ConfigController
{
    public function getDateLimitInstrutor(Request $request, Response $response, array $args): Response
    {
        $config = new ConfigDAO($args['cfc']);
        $detalhes = $config->getBaseConfigs();
        if (count($detalhes) != 0 || $detalhes != null) {
            $returns = $detalhes;
        } else {
            $returns = array('data' => "erro");
        }
        $response = $response->withJson($returns);
        return $response;
    }
}
