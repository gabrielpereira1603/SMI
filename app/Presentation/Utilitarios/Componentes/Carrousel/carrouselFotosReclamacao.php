<?php

namespace app\Presentation\Utilitarios\Componentes\Carrousel;

use app\Application\UseCase\Foto\BuscarFotoPorReclamacaoUseCase;
use app\Domain\Exceptions\ReclamacaoExceptions\ReclamacoesNaoEncontradasExceptions;
use app\Domain\Repository\Foto\BuscarFotoPorReclamacaoRepository;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class carrouselFotosReclamacao extends Page
{
    private BuscarFotoPorReclamacaoRepository $buscarFotoPorReclamacaoRepository;

    public function __construct(BuscarFotoPorReclamacaoRepository $buscarFotoPorReclamacaoRepository)
    {
        $this->buscarFotoPorReclamacaoRepository = $buscarFotoPorReclamacaoRepository;
    }


}