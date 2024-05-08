<?php

namespace app\Infrastructure\DataBase\Componente;

use app\Domain\Entity\Componente;
use app\Domain\Repository\Componente\BuscarTodosComponenteRepository;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class BuscarTodosComponentesDAO implements BuscarTodosComponenteRepository
{
    public function buscarTodos(Request $request): bool|array
    {
        $results = (new Database('componente'))->select(null, null, null, null, '*', null)->fetchAll();

        if (!$results){
            return false;
        }

        $componentes = [];

        foreach ($results as $componenteData) {
            $componentes[] = new Componente(
                $componenteData['codcomponente'],
                $componenteData['nome_componente']
            );
        }


        return $componentes;
    }
}