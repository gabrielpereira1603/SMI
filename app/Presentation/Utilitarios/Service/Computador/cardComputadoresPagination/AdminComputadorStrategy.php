<?php

namespace app\Presentation\Utilitarios\Service\Computador;

use app\Application\UseCase\Computador\BuscarComputadoresPorLaboratorioUseCase;
use app\Application\UseCase\Computador\BuscarComputadorPorLaboratorioPaginationUseCase;
use app\Domain\Repository\Computador\BuscarComputadorLaboratorioPaginationRepository;
use app\Domain\Repository\Computador\BuscarComputadorPorLaboratorioRepository;
use app\Domain\Repository\Computador\CardComputadorStrategy;
use app\Infrastructure\Http\Request;
use app\Utils\View;
use WilliamCosta\DatabaseManager\Pagination;

class AdminComputadorStrategy implements CardComputadorStrategy
{
    private BuscarComputadorPorLaboratorioPaginationUseCase $buscarComputadorPorLaboratorioPaginationUseCase;
    private BuscarComputadoresPorLaboratorioUseCase $buscarComputadoresPorLaboratorioUseCase;

    public function __construct(
        BuscarComputadorLaboratorioPaginationRepository $buscarComputadorLaboratorioPaginationRepository,
        BuscarComputadorPorLaboratorioRepository $buscarComputadorPorLaboratorioRepository
    )
    {
        $this->buscarComputadorPorLaboratorioPaginationUseCase = new BuscarComputadorPorLaboratorioPaginationUseCase($buscarComputadorLaboratorioPaginationRepository);
        $this->buscarComputadoresPorLaboratorioUseCase = new BuscarComputadoresPorLaboratorioUseCase($buscarComputadorPorLaboratorioRepository);
    }

    public function renderCardComputadores(Request $request, &$obPagination, $codlaboratorio): array
    {
        $itens = '';
        $statusClasses = ['', 'btn-success', 'btn-warning', 'btn-danger'];
        $statusIcons = ['', 'bi bi-check-circle-fill', 'bi bi-tools', 'bi bi-exclamation-octagon-fill'];

        $quantidadetotal = count($this->buscarComputadoresPorLaboratorioUseCase->execute($request,$codlaboratorio));

        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantidadetotal, $paginaAtual, 5);

        $limit = $obPagination->getLimit();
        $offset = $obPagination->getOffset();
        $results = $this->buscarComputadorPorLaboratorioPaginationUseCase->execute($request, $obPagination, $codlaboratorio, $limit, $offset);

        foreach ($results as $obComputador) {
            $statusClass = $statusClasses[$obComputador->getSituacao()->getCodSituacao()] ?? '';
            $statusIcon = $statusIcons[$obComputador->getSituacao()->getCodSituacao()] ?? '';

            switch ($obComputador->getSituacao()->getCodSituacao()) {
                case 1:
                    $status = 'status-itens status-item-2 btn btn-success';
                    $icone = 'bi bi-check-circle-fill'; // Ícone de computador em Disponível
                    break;
                case 2:
                    $status = 'status-itens status-item-1 btn btn-warning';
                    $icone = 'bi bi-tools'; // Ícone de computador Em Manutenção
                    break;
                case 3:
                    $status = 'status-itens status-item-3 btn btn-danger';
                    $icone = 'bi bi-exclamation-octagon-fill'; // Ícone de computador Indisponível
                    break;
                default:
                    $icone = ''; // Ícone padrão, caso não haja correspondência
                    break;
            }

            // Renderiza o item
            $itens .= View::render('admin/computador/item', [
                'codcomputador' => $obComputador->getCodComputador(),
                'patrimonio' => $obComputador->getPatrimonio(),
                'codlaboratorio' => $obComputador->getLaboratorio()->getCodLaboratorio(),
                'laboratorio' => $obComputador->getLaboratorio()->getNumeroLaboratorio(),
                'situacao' => $obComputador->getSituacao()->getTipoSituacao(),
                'icone' => $statusIcon,
                'status' => "status-itens $statusClass btn",
            ]);
        }

        return [$itens, $obPagination];
    }

}