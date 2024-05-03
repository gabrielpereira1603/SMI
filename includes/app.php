<?php

require __DIR__ ."/../vendor/autoload.php";

//DEPENDENCIA DO DOMPDF
use Dompdf\Dompdf;
use app\Http\Middleware\adminLogin\RequireAdminLogin;
use app\Http\Middleware\adminLogin\RequireAdminLogout;
use app\Http\Middleware\alunoLogin\RequireAlunoLogin;
use app\Http\Middleware\alunoLogin\RequireAlunoLogout;
use app\Http\Middleware\Manutencao;
use app\Http\Middleware\Queue as MiddlewareQueue;
use app\Utils\View;
use WilliamCosta\DatabaseManager\Database;
use WilliamCosta\DotEnv\Environment;

//CARREGA VARIAVEIS DE AMBIENTE 
Environment::load(__DIR__.'/../');

//DEFINE AS CONFIGURACOES DE BANCO DE DADOS
Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

//DEFINE A CONSTANTE DE URL DO PROJETO
define('URL', getenv('URL'));

//DEFINE O VALOR PADRAO DAS VARIAVEIS
View::init([
    'URL' => URL
]);

//DEFINE O MAPEAMENTO DE MIDDLWARES
MiddlewareQueue::setMap([
    'manutencao' => Manutencao::class,
    'required-admin-logout' => RequireAdminLogout::class,
    'required-admin-login' => RequireAdminLogin::class,
    'required-aluno-login' => RequireAlunoLogin::class,
    'required-aluno-logout' => RequireAlunoLogout::class,
    'api' => \app\Http\Middleware\ApiMiddleware\Api::class,
    'basic-auth' => \app\Http\Middleware\Autenticacao\BasicAuth::class,
    'jwt-auth' => \app\Http\Middleware\Autenticacao\JWTAuth::class,
]);

//DEFINE O MAPEAMENTO DE MIDDLWARES PADROES (EXECUTADOS EM TODAS AS ROTAS)
MiddlewareQueue::setDefault([
    'manutencao'
]);