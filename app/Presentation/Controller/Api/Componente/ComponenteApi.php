<?php

namespace app\Presentation\Controller\Api\Componente;

use app\Application\UseCase\Componente\BuscarTodosComponenteUseCase;
use app\Infrastructure\DataBase\Componente\BuscarTodosComponentesDAO;

class ComponenteApi
{
    private BuscarTodosComponentesDAO $buscarTodosComponentesDAO;

    public function __construct(BuscarTodosComponentesDAO $buscarTodosComponentesDAO)
    {
        $this->buscarTodosComponentesDAO = $buscarTodosComponentesDAO;
    }


    public function getAllComponentes($request): array
    {
        return (new BuscarTodosComponenteUseCase($this->buscarTodosComponentesDAO))->execute($request);
    }

}