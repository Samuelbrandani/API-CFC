<?php

namespace App\Controllers;

use App\DAO\DAOFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;

final class OneSignalController
{

    public function createNotification(Request $request, Response $response, array $args): void
    {
        // if ($_SERVER["HTTP_X_CRON_AUTH"] != "b4eef3bdc520a4b4e85b28aba25fa445") {
        //     die("Acesso nao Autorizado");
        // }
        $oneSignalDAO = DAOFactory::createOneSignalDAO($args['cfc']);
        $tokens = $this->getTokensOneSignal($args['cfc']);
        $app_id = $tokens["app_id"];
        $authorization = $tokens["authorization"];
        $data = date("Y-m-d");
        $dataFormatada = date("d/m/Y");
        $result = $oneSignalDAO->getNotification($data);
        for ($i = 0; $i < count($result); $i++) {
            $this->senddingNotification(
                $result[$i]["PLAYER_ID"],
                $result[$i]["HORA"],
                $result[$i]["INSTRUTOR"],
                $result[$i]["DATA"],
                $dataFormatada,
                $app_id,
                $authorization
            );
        }
    }

    public function senddingNotification($PLAYER_ID, $horas, $instrutor, $DT_AGENDADA, $dataFormatada, $app_id, $authorization)
    {
        $HORA_AGENDADA = (int) substr($horas, 0, 2) - 1;
        $aux = substr($horas, -3);
        $content = array(
            "en" => "Olá, aqui é da Auto Escola! Estamos te lembrando que você tem uma aula hoje ($dataFormatada) às $horas com $instrutor! Uma ótima aula"
        );
        $fields = array(
            'app_id' => "$app_id",
            'include_player_ids' => [$PLAYER_ID],
            'contents' => $content,
            'send_after' => "$DT_AGENDADA $HORA_AGENDADA $aux UTC-0300",
        );
        $fields = json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            "Authorization: Basic $authorization"
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $data = curl_exec($ch);
        print_r($data);
        curl_close($ch);
    }

    public function getTokensOneSignal($cfc)
    {
        switch ($cfc) {
            case '954d52561cc1a99969e9bddd4b505500':
                // carlinhos
                return array(
                    'app_id' => '240cfe9e-5329-4265-832f-68221f93156f',
                    'authorization' => "YzRkOWZhZDAtMjZkMS00YmUyLWIzOTYtOTRhZDI1ODlkNGU5",
                );
                break;
            case 'fb71dd3b1c44868670030e74423f00e9':
                // são josé
                return array(
                    'app_id' => '2263c835-e0fe-40ea-860c-b9c1d44f3882',
                    'authorization' => "YTVkZjFkNGItZTI3NS00YzI3LTg2OTAtY2E0MjdlMzI5YmQw",
                );
                break;
        }
    }
}
