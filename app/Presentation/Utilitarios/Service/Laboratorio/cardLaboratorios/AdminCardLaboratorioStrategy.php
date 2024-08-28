<?php

namespace app\Presentation\Utilitarios\Service\Laboratorio\cardLaboratorios;

use app\Application\UseCase\Computador\BuscarComputadoresPorLaboratorioUseCase;
use app\Application\UseCase\Laboratorio\BuscarTodosLaboratoriosUseCase;
use app\Domain\Entity\Laboratorio;
use app\Domain\Repository\Computador\BuscarComputadorPorLaboratorioRepository;
use app\Domain\Repository\Laboratorio\BuscarTodosLaboratoriosRepository;
use app\Domain\Repository\Laboratorio\CardLaboratorioStrategy;
use app\Infrastructure\Dao\Computador\ComputadorDao;
use app\Infrastructure\Dao\Laboratorio\LaboratorioDao;
use app\Infrastructure\Http\Request;
use app\Utils\View;

class AdminCardLaboratorioStrategy implements CardLaboratorioStrategy
{
    private BuscarTodosLaboratoriosUseCase $buscarTodosLaboratoriosUseCase;
    private BuscarComputadoresPorLaboratorioUseCase $buscarComputadoresPorLaboratorioUseCase;

    public function __construct(
        BuscarTodosLaboratoriosRepository $buscarTodosLaboratoriosRepository,
        BuscarComputadorPorLaboratorioRepository $buscarComputadorPorLaboratorioRepository
    )
    {
        $this->buscarTodosLaboratoriosUseCase = new BuscarTodosLaboratoriosUseCase($buscarTodosLaboratoriosRepository);
        $this->buscarComputadoresPorLaboratorioUseCase = new BuscarComputadoresPorLaboratorioUseCase($buscarComputadorPorLaboratorioRepository);
    }

    public function renderCardsLaboratorios(Request $request): string
    {
        $laboratorios = $this->buscarTodosLaboratoriosUseCase->execute($request);

        $itens = array_map(function(Laboratorio $laboratorio) use ($request) {
            $computadores = $this->buscarComputadoresPorLaboratorioUseCase->execute($request, $laboratorio->getCodLaboratorio());

            $quantidades = array_count_values(array_map(function($computador) {
                return $computador->getSituacao()->getCodSituacao();
            }, $computadores));
            var_dump($quantidades);
            return View::render('admin/laboratorio/item', [
                'codlaboratorio' => $laboratorio->getCodLaboratorio(),
                'numerolaboratorio' => $laboratorio->getNumeroLaboratorio(),
                'quantidade_disponiveis' => $quantidades[1] ?? 0,
                'quantidade_indisponiveis' => $quantidades[3] ?? 0,
                'quantidade_em_manutencao' => $quantidades[2] ?? 0,
                'quantidade_total_computadores' => count($computadores)
            ]);
        }, $laboratorios);

        return implode('', $itens);
    }

}