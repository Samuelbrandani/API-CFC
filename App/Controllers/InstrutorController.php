<?php

namespace App\Controllers;

use App\DAO\DAOFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;

final class InstrutorController
{
    public function getClassesOfTheDay(Request $request, Response $response, array $args): Response
    {
        $codInstrutor = $args["codInstrutor"];
        $data1 = $args["data1"];
        $data2 = $args["data2"];

        $instrutorDAO = DAOFactory::createInstrutorDAO($args['cfc']);
        if ($data2 == "nop")
            $detalhes = $instrutorDAO->getClassesOfTheDay($codInstrutor, $data1);
        else
            $detalhes = $instrutorDAO->getClassesPeriod($codInstrutor, $data1, $data2);

        if (count($detalhes) != 0 || $detalhes != null) {
            $returns = $detalhes;
        } else {
            $returns = array('data' => "erro");
        }
        $response = $response->withJson($returns);
        return $response;
    }



    public function getAdmInstrutor(Request $request, Response $response, array $args): Response
    {
        $instrutorDAO = DAOFactory::createInstrutorDAO($args['cfc']);
        $returns = $instrutorDAO->getAdmInstrutor();
        $response = $response->withJson($returns);

        return $response;
    }

    public function checkClassesOfTheDay(Request $request, Response $response, array $args): Response
    {
        $codInstrutor = $args["codInstrutor"];

        $data1 = $args["data1"];
        $data2 = $args["data2"];
        $instrutorDAO = DAOFactory::createInstrutorDAO($args['cfc']);
        if ($data2 == "nop")
            $detalhes = $instrutorDAO->getClassesOfTheDay($codInstrutor, $data1);
        else
            $detalhes = $instrutorDAO->getClassesPeriod($codInstrutor, $data1, $data2);


        if (count($detalhes) != 0 || $detalhes != null) {
            $returns = array('data' => "ok");
        } else {
            $returns = array('data' => "erro");
        }
        $response = $response->withJson($returns);
        return $response;
    }
}
