<?php


use app\Application\UseCase\Manutencao\CadastrarManutencaoUseCase;
use app\Infrastructure\DataBase\Computador\AtualizaSituacaoComputadorDAO;
use app\Infrastructure\DataBase\Manutencao\CadastrarManutencaoDAO;
use app\Infrastructure\DataBase\Reclamacao\AtualizaReclamacaoDAO;
use app\Infrastructure\Http\Request;
use app\Infrastructure\Http\Response;
use app\Presentation\Controller\Admin\RegistrarManutencao\CadastrarManutencao;

$obRouter->post('/admin/manutencao/{codcomputador}',[
    'middlewares' => [
        'required-admin-login'
    ],
    function(Request $request, $codcomputador) {
        $cadastrarManutencao = new CadastrarManutencao(
            new CadastrarManutencaoUseCase(
                new CadastrarManutencaoDAO(),
                new AtualizaSituacaoComputadorDAO(),
                new AtualizaReclamacaoDAO()
            )
        );
        return new Response(200, $cadastrarManutencao->cadastrarManutencao($request,$codcomputador));
    }
]);

