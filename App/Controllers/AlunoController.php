<?php

namespace App\Controllers;

use App\DAO\MySQL\AlunoDAO;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;

final class AlunoController
{

    public function getAll(Request $request, Response $response, array $args): Response
    {
        $codAluno = $args["COD_ALUNO"];
        $aulas = $this->aulas($codAluno, $args["cfc"]);
        $exames = $this->exames($codAluno, $args["cfc"]);
        $financeiro = $this->financeiro($codAluno, $args["cfc"]);

        $returns = ["aulas" =>  $aulas, 'exames' => $exames, 'financeiro' => $financeiro];
        $response = $response->withJson($returns);
        return $response;
    }

    public function getAllv2(Request $request, Response $response, array $args): Response
    {
        $codAluno = $args["COD_ALUNO"];
        $aulas = $this->aulas($codAluno, $args["cfc"]);
        $exames = $this->exames($codAluno, $args["cfc"]);
        $financeiro = $this->financeirov2($codAluno, $args["cfc"]);

        $returns = ["aulas" =>  $aulas, 'exames' => $exames, 'financeiro' => $financeiro];
        $response = $response->withJson($returns);
        return $response;
    }

    private function aulas($COD_ALUNO, $CFC)
    {
        $aulasDAO = new AlunoDAO($CFC);
        $result = $aulasDAO->aulasAluno($COD_ALUNO);

        return $result;
    }

    private function exames($COD_ALUNO, $CFC)
    {
        $aulasDAO = new AlunoDAO($CFC);
        $result = $aulasDAO->examesAluno($COD_ALUNO);

        return $result;
    }

    private function financeirov2($COD_ALUNO, $CFC)
    {
        $aulasDAO = new AlunoDAO($CFC);
        $FPAGO = $aulasDAO->financeiroAlunoPagos($COD_ALUNO);
        $FPAGAR = $aulasDAO->financeiroAlunoAPagar($COD_ALUNO);
        $FTODOS = $aulasDAO->financeiroAlunoTodos($COD_ALUNO);

        return array("PAGOS" => $FPAGO, "A_PAGAR" => $FPAGAR, "TODOS" => $FTODOS);
    }

    private function financeiro($COD_ALUNO, $CFC)
    {
        $aulasDAO = new AlunoDAO($CFC);
        $result = $aulasDAO->financeiroAluno($COD_ALUNO);
        return $result;
    }



    //NOVA VERSÃO
    public function financeiroAlunoPagos(Request $request, Response $response, array $args)
    {
        $CFC = $args["cfc"];
        $COD_ALUNO = $args["COD_ALUNO"];
        $aulasDAO = new AlunoDAO($CFC);
        $result = $aulasDAO->financeiroAlunoPagos($COD_ALUNO);
        $response = $response->withJson($result);
        return $response;
    }

    public function financeiroAlunoAPagar(Request $request, Response $response, array $args)
    {
        $CFC = $args["cfc"];
        $COD_ALUNO = $args["COD_ALUNO"];
        $aulasDAO = new AlunoDAO($CFC);
        $result = $aulasDAO->financeiroAlunoAPagar($COD_ALUNO);
        $response = $response->withJson($result);
        return $response;
    }

    public function financeiroAlunoTodos(Request $request, Response $response, array $args)
    {
        $CFC = $args["cfc"];
        $COD_ALUNO = $args["COD_ALUNO"];
        $aulasDAO = new AlunoDAO($CFC);
        $result = $aulasDAO->financeiroAlunoTodos($COD_ALUNO);
        $response = $response->withJson($result);
        return $response;
    }

    public function aulasDirecao(Request $request, Response $response, array $args)
    {
        $CFC = $args["cfc"];
        $COD_ALUNO = $args["COD_ALUNO"];
        $aulasDAO = new AlunoDAO($CFC);
        $result = $aulasDAO->aulasAluno($COD_ALUNO);
        $response = $response->withJson($result);
        return $response;
    }

    public function exameDirecao(Request $request, Response $response, array $args)
    {
        $CFC = $args["cfc"];
        $COD_ALUNO = $args["COD_ALUNO"];
        $aulasDAO = new AlunoDAO($CFC);
        $result = $aulasDAO->exameDirecao($COD_ALUNO);
        $response = $response->withJson($result);
        return $response;
    }
}
