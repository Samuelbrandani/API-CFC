<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$app = new \Slim\App($config);

use App\Controllers\AlunoController;
use App\Controllers\ConfigController;
use App\Controllers\ContatoController;
use App\Controllers\InstrutorController;
use App\Controllers\LoginController;
use App\Controllers\OneSignalController;

$app->group('/api', function () use ($app) {

    $app->post("/login-aluno/{cfc}", LoginController::class . ":loginAluno");
    $app->post("/login-instrutor/{cfc}", LoginController::class . ":loginInstrutor");
    $app->get("/all-of-aluno/{cfc}/{COD_ALUNO}", AlunoController::class . ":getAll");
    $app->get("/all-of-aluno/v2/{cfc}/{COD_ALUNO}", AlunoController::class . ":getAllv2");
    $app->get("/classes-of-the-day/{cfc}/{codInstrutor}/{data1}/{data2}", InstrutorController::class . ":getClassesOfTheDay");
    $app->get("/check-classes-of-the-day/{cfc}/{codInstrutor}/{data1}/{data2}", InstrutorController::class . ":checkClassesOfTheDay");
    $app->get("/get-adm-instrutor/{cfc}", InstrutorController::class . ":getAdmInstrutor");

    $app->group('/aluno/v2/{cfc}/{COD_ALUNO}', function () use ($app) {
        $app->group('/financeiro', function () use ($app) {
            $app->get("/apagar", AlunoController::class . ":financeiroAlunoAPagar");
            $app->get("/pagos", AlunoController::class . ":financeiroAlunoPagos");
            $app->get("/todos", AlunoController::class . ":financeiroAlunoTodos");
        });
        $app->group('/aulas', function () use ($app) {
            $app->get("/direcao", AlunoController::class . ":aulasDirecao");
        });

        $app->group('/exames', function () use ($app) {
            $app->get("/direcao", AlunoController::class . ":exameDirecao");
        });
    });

    $app->post("/contato-site/{cfc}", ContatoController::class . ":sendEmail");

    $app->get("/create-notification/{cfc}", OneSignalController::class . ":createNotification");
});

$app->run();
