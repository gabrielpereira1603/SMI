<?php

namespace app\Presentation\Utilitarios\Componentes\CheckBox;

use app\Application\UseCase\Componente\BuscarTodosComponenteUseCase;
use app\Infrastructure\DataBase\Componente\BuscarTodosComponentesDAO;
use app\Utils\View;

class allCheckBoxComponentes
{
    public static function getComponenteCheckBox($request): string
    {
        $useCase = new BuscarTodosComponenteUseCase(
            new BuscarTodosComponentesDAO()
        );

        $componentes = $useCase->execute($request);
        $itens = '';

        foreach ($componentes as $componente) {
            $itens .= View::render('aluno/componente/item', [
                'nome_componente' => $componente->getNomeComponente(),
                'codcomponente' => $componente->getCodComponente(),
            ]);
        }

        return $itens;
    }
}