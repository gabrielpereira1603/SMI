<?php

namespace app\Presentation\Utilitarios\Service\Computador;

use app\Infrastructure\Dao\Computador\ComputadorDao;
use app\Utils\View;
use WilliamCosta\DatabaseManager\Pagination;

class AlunoComputadorStrategy implements ComputadorStrategy
{
    public static function getComputadorItems($request,$codlaboratorio,&$obPagination): string
    {
        $itens = '';
        $icones = '';
        $status = '';
        $disabled = '';

        $computadores = (new ComputadorDao())->getComputadoresLaboratorio($codlaboratorio);

        $quantidadetotal = count($computadores);

        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantidadetotal, $paginaAtual, 5);

        $limit = $obPagination->getLimit();
        $offset = $obPagination->getOffset();
        $results = ComputadorDao::getComputadoresLaboratorioPagination($codlaboratorio,$obPagination,$limit,$offset);
        foreach ($results as $obComputador) {

            switch ($obComputador->getSituacao()->getCodSituacao()) {
                case 1:
                    $status = 'status-itens status-item-2 btn btn-success';
                    $icone = 'bi bi-check-circle-fill'; // Ícone de computador em Disponível
                    $disabled = '';
                    break;
                case 2:
                    $status = 'status-itens status-item-1 btn btn-warning';
                    $icone = 'bi bi-tools'; // Ícone de computador Em Manutenção
                    $disabled = 'disabled';
                    break;
                case 3:
                    $status = 'status-itens status-item-3 btn btn-danger';
                    $icone = 'bi bi-exclamation-octagon-fill'; // Ícone de computador indisponível
                    $disabled = 'disabled';
                    break;
                default:
                    $icone = ''; // Ícone padrão, caso não haja correspondência
                    break;
            }

            // Renderiza o item
            $itens .= View::render('aluno/computador/item', [
                'codcomputador' => $obComputador->getCodComputador(),
                'patrimonio' => $obComputador->getPatrimonio(),
                'codlaboratorio' => $obComputador->getLaboratorio()->getCodLaboratorio(),
                'laboratorio' => $obComputador->getLaboratorio()->getNumeroLaboratorio(),
                'situacao' => $obComputador->getSituacao()->getTipoSituacao(),
                'icone' => $icone,
                'status' => $status,
                'disabled' => $disabled
            ]);
        }

        return $itens;
    }

}