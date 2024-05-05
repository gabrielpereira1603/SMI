<?php

namespace app\Application\UseCase\Reclamacao;


use app\Domain\Exceptions\ReclamacaoExceptions\ErrorAoExcluirReclamacaoException;
use app\Domain\Service\Computador\AtualizaStatusRepository;
use app\Domain\Service\Foto\ExcluirFotoRepository;
use app\Domain\Service\Reclamacao\ExcluirReclamacaoRepository;
use app\Domain\Service\ReclamacaoComponente\ExcluirComponenteReclamacaoRepository;

class ExcluirReclamacaoUseCase
{
    private ExcluirReclamacaoRepository $excluirReclamacaoRepository;
    private ExcluirComponenteReclamacaoRepository $excluirComponenteReclamacaoRepository;
    private AtualizaStatusRepository $atualizaStatusRepository;
    private ExcluirFotoRepository $excluirFotoRepository;

    public function __construct
    (
        ExcluirReclamacaoRepository $excluirReclamacaoRepository,
        ExcluirComponenteReclamacaoRepository $excluirComponenteReclamacaoRepository,
        AtualizaStatusRepository $atualizaStatusRepository,
        ExcluirFotoRepository $excluirFotoRepository,
    )
    {
        $this->excluirReclamacaoRepository = $excluirReclamacaoRepository;
        $this->excluirComponenteReclamacaoRepository = $excluirComponenteReclamacaoRepository;
        $this->atualizaStatusRepository = $atualizaStatusRepository;
        $this->excluirFotoRepository = $excluirFotoRepository;
    }

    public function excluirReclamacao(array $dadosReclamacao): void
    {

        $codReclamacao = $dadosReclamacao['codreclamacao'];
        $codComputador = $dadosReclamacao['codcomputador'];

        if(!$this->excluirComponenteReclamacaoRepository->excluirComponenteReclamacao($codReclamacao)){
            throw new ErrorAoExcluirReclamacaoException("Error ao excluir os componentes relacionados à reclamação");
        }

        if ($this->excluirFotoRepository->fotoExiste((int)$codReclamacao)) {
            if (!$this->excluirFotoRepository->exlcuirFoto((int)$codReclamacao)) {
                throw new ErrorAoExcluirReclamacaoException("Erro ao excluir a foto da reclamação");
            }
        }

        if(!$this->excluirReclamacaoRepository->excluirReclamacao($codReclamacao)){
            throw new ErrorAoExcluirReclamacaoException("Error ao excluir a reclamação");
        }

        if(!$this->atualizaStatusRepository->atualizaStatus($codComputador, ['codsituacao_fk' => '1'])){
            throw new ErrorAoExcluirReclamacaoException("Error ao atualizar situação do computador.");
        }
    }
}