<?php

namespace App\Controllers;

use App\DAO\MySQL\ContatoDAO;
use App\Models\EmailModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;

final class ContatoController
{
    public function sendEmail(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $NOME = $data["NOME"];
        $EMAIL = $data["EMAIL"];
        $TELEFONE = $data["TELEFONE"];
        $CELULAR = $data["CELULAR"];
        $MENSAGEM = $data["MENSAGEM"];
        $EMAIL_CFC = $data["EMAIL_CFC"];

        $msg = 'NOME: ' . $NOME . '<br>';
        $msg .= 'EMAIL: ' . $EMAIL . '<br>';
        $msg .= 'CELULAR: ' . $CELULAR . '<br>';
        $msg .= 'TELEFONE: ' . $TELEFONE . '<br>';
        $msg .= 'MENSAGEM: ' . $MENSAGEM . '<br>';

        $bodyMail = wordwrap($msg, 70);

        $emailModel = new EmailModel();
        $emailModel->setNome($NOME);
        $emailModel->setEmail($EMAIL);
        $emailModel->setTelefone($TELEFONE);
        $emailModel->setTipo("Contato pelo site");
        $emailModel->setMensagem($msg);
        $emailModel->setDt(date('Y-m-d H:i:s'));

        $phpMailer = new PHPMailerController();
        $mail = $phpMailer->PHPMailer($bodyMail, "Contato pelo site", $EMAIL_CFC, $NOME);
        if ($mail) {
            $retorno = [
                'message' => 'O e-mail foi enviado com sucesso',
                'cod' => 1
            ];
            $emailModel->setRetorno($retorno['message']);
            $response = $response->withStatus(200)->withJson($retorno);
        } else {
            $retorno = [
                'message' => 'Houve um erro ao enviar o e-mail, verifique com o suporte para mais detalhes!',
                'cod' => 0
            ];
            $emailModel->setRetorno($retorno['message']);
            $response = $response->withStatus(200)->withJson($retorno);
        }
        $contatoDAO = new ContatoDAO($args['cfc']);
        $contatoDAO->insertContatoPeloSite($emailModel);
        return $response;
    }
}
