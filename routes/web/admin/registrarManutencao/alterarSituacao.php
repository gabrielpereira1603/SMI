<?php

use app\Application\UseCase\Componente\AtualizaSituacaoComputadorUseCase;
use app\Domain\Exceptions\Computador\ErrorAoAlterarSituacaoComputador;
use app\Infrastructure\DataBase\Computador\AtualizaSituacaoComputadorDAO;
use app\Infrastructure\Http\Request;
use app\Infrastructure\Http\Response;

$obRouter->post('/admin/AlterarSituacao', [
    'middlewares' => [
        'required-admin-login'
    ],

    function(Request $request) {
        $alterarSituacao = new AtualizaSituacaoComputadorUseCase(
            new AtualizaSituacaoComputadorDAO()
        );
        try {
            $codcomputador = $request->getPostVars()['codcomputador'];
            $dadosAlterar = $request->getPostVars()['novaSituacao'];
            $alterarSituacao->execute($codcomputador, ['codsituacao_fk' => $dadosAlterar]);

            $request->getRouter()->redirect('/admin/manutencao/'.$codcomputador.'?success='. urlencode('Situação alterada com sucesso.'));
        }catch (ErrorAoAlterarSituacaoComputador $e){
            $request->getRouter()->redirect('/admin/manutencao/'.$codcomputador.'?success='. urlencode($e->getMessage()));
        }
    }
]);
