<?php

namespace app\Application\UseCase\Reclamacao;

use app\Domain\Exceptions\ReclamacaoExceptions\FalhaCadastroReclamacao;
use app\Domain\Service\Computador\AtualizaStatusRepository;
use app\Domain\Service\Foto\InserirFotoReclamacaoRepository;
use app\Domain\Service\Reclamacao\CadastrarReclamacaoRepository;
use app\Domain\Service\ReclamacaoComponente\InserirComponenteReclamacaoRepository;
use app\Presentation\Utilitarios\Email\CadastrarReclamacao\CadastroReclamacaoEmail;

class CadastrarReclamacaoUseCase
{
    private CadastrarReclamacaoRepository $reclamacaoRepository;
    private AtualizaStatusRepository $computadorRepository;
    private InserirComponenteReclamacaoRepository $reclamacaoComponenteRepository;
    private InserirFotoReclamacaoRepository $inserirFotoReclamacaoRepository;

    public function __construct
    (
        CadastrarReclamacaoRepository         $reclamacaoRepository,
        AtualizaStatusRepository              $computadorRepository,
        InserirComponenteReclamacaoRepository $reclamacaoComponenteRepository,
        InserirFotoReclamacaoRepository       $inserirFotoReclamacaoRepository
    )
    {
        $this->reclamacaoRepository = $reclamacaoRepository;
        $this->computadorRepository = $computadorRepository;
        $this->reclamacaoComponenteRepository = $reclamacaoComponenteRepository;
        $this->inserirFotoReclamacaoRepository = $inserirFotoReclamacaoRepository;
    }

    public function cadastrarReclamacao(array $dadosReclamacao, array $foto): void
    {
        $lastIdReclamacao = $this->reclamacaoRepository->cadastrarReclamacao($dadosReclamacao);

        $lastIdFoto = $this->inserirFotoReclamacaoRepository->cadastrarFotoReclamacao($foto,$lastIdReclamacao);

        if (!$this->computadorRepository->atualizaStatus($dadosReclamacao['codcomputador'], ['codsituacao_fk' => 2])){
            throw new FalhaCadastroReclamacao("Error ao atualizar o status do computador da reclamação.");
        }

        foreach ($dadosReclamacao['componente'] as $codComponente) {
            if(!$this->reclamacaoComponenteRepository->inserirComponente($lastIdReclamacao, $codComponente)){
               throw new FalhaCadastroReclamacao("Error ao cadastrar reclamação.");
            }
        }

        if (!empty($dadosReclamacao['email'])){
            $enviarEmail = (new CadastroReclamacaoEmail())->enviarReclamacaoRealizada($dadosReclamacao['email']);
        }
    }
}