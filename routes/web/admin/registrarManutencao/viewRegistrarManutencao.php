<?php

include __DIR__."/cadastrarManutencao.php";
include __DIR__."/alterarSituacao.php";

use app\Application\UseCase\Computador\BuscarComputadorPorIdUseCase;
use app\Application\UseCase\Reclamacao\BuscarReclamacaoPorComputadorUseCase;
use app\Infrastructure\DataBase\Computador\ComputadorPorIdDAO;
use app\Infrastructure\DataBase\Reclamacao\BuscarReclamacaoPorComputadorEStatusDao;
use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Admin\RegistrarManutencao\ViewRegistrarManutencao;


//ROTA MANUTENCAO
$obRouter->get('/admin/manutencao/{codcomputador}', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $codcomputador) {
        $registrarManutencao = new ViewRegistrarManutencao(
            new BuscarReclamacaoPorComputadorUseCase(new BuscarReclamacaoPorComputadorEStatusDao()),
            new BuscarComputadorPorIdUseCase(new ComputadorPorIdDAO())
        );
        return new Response(200,$registrarManutencao->buscarDadosReclamacao($request,$codcomputador));
    }
]);
