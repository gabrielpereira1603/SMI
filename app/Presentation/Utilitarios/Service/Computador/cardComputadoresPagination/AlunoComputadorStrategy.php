<?php

namespace app\Presentation\Utilitarios\Service\Computador\cardComputadoresPagination;

use app\Application\UseCase\Computador\BuscarComputadoresPorLaboratorioUseCase;
use app\Application\UseCase\Computador\BuscarComputadorPorLaboratorioPaginationUseCase;
use app\Domain\Repository\Computador\BuscarComputadorLaboratorioPaginationRepository;
use app\Domain\Repository\Computador\BuscarComputadorPorLaboratorioRepository;
use app\Domain\Repository\Computador\CardComputadorStrategy;
use app\Infrastructure\Dao\Computador\ComputadorDao;
use app\Infrastructure\Http\Request;
use app\Utils\View;
use WilliamCosta\DatabaseManager\Pagination;

class AlunoComputadorStrategy implements CardComputadorStrategy
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
        $statusClasses = ['', 'btn-danger','btn-success','btn-warning'];
        $statusIcons = ['', 'bi bi-exclamation-octagon-fill','bi bi-check-circle-fill', 'bi bi-tools',];

        $quantidadetotal = count($this->buscarComputadoresPorLaboratorioUseCase->execute($request, $codlaboratorio));

        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantidadetotal, $paginaAtual, 5);

        $limit = $obPagination->getLimit();
        $offset = $obPagination->getOffset();

        $results = $this->buscarComputadorPorLaboratorioPaginationUseCase->execute($request, $obPagination, $codlaboratorio, $limit, $offset);

        foreach ($results as $obComputador) {
            $statusClass = $statusClasses[$obComputador->getSituacao()->getCodSituacao()] ?? '';
            $statusIcon = $statusIcons[$obComputador->getSituacao()->getCodSituacao()] ?? '';
            $disabled = $obComputador->getSituacao()->getCodSituacao() != 2 ? 'disabled' : '';

            $itens .= View::render('aluno/computador/item', [
                'codcomputador' => $obComputador->getCodComputador(),
                'patrimonio' => $obComputador->getPatrimonio(),
                'codlaboratorio' => $obComputador->getLaboratorio()->getCodLaboratorio(),
                'laboratorio' => $obComputador->getLaboratorio()->getNumeroLaboratorio(),
                'situacao' => $obComputador->getSituacao()->getTipoSituacao(),
                'icone' => $statusIcon,
                'status' => "status-itens $statusClass btn",
                'disabled' => $disabled
            ]);
        }

        return [$itens, $obPagination];
    }

}