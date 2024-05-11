<?php

namespace app\Application\UseCase\NivelAcesso;

use app\Domain\Entity\NivelAcesso;
use app\Domain\Exceptions\NivelAcesso\NivelAcessoNaoEncontradoException;
use app\Domain\Repository\NivelAcesso\BuscarNivelAcessoPorTipoRepository;
use app\Infrastructure\Http\Request;

class BuscarNivelAcessoPorTipoUseCase
{
    private BuscarNivelAcessoPorTipoRepository $buscarNivelAcessoPorTipoRepository;

    public function __construct(BuscarNivelAcessoPorTipoRepository $buscarNivelAcessoPorTipoRepository)
    {
        $this->buscarNivelAcessoPorTipoRepository = $buscarNivelAcessoPorTipoRepository;
    }

    public function execute(Request $request, $tipoAcesso): ?NivelAcesso
    {
        $obNivelAcesso = $this->buscarNivelAcessoPorTipoRepository->buscarPorTipo($request,$tipoAcesso);
        if ($obNivelAcesso === null){
            throw new NivelAcessoNaoEncontradoException("Nivel de Acesso não encontrado!");
        }
        return $obNivelAcesso;
    }
}