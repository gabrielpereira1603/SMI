<?php

namespace app\Application\UseCase\Reclamacao;

use app\Domain\Exceptions\ReclamacaoExceptions\FalhaCadastroReclamacao;
use app\Domain\Repository\Computador\AtualizaStatusRepository;
use app\Domain\Repository\Foto\InserirFotoReclamacaoRepository;
use app\Domain\Repository\Reclamacao\CadastrarReclamacaoRepository;
use app\Domain\Repository\ReclamacaoComponente\InserirComponenteReclamacaoRepository;
use app\Presentation\Utilitarios\Email\CadastrarReclamacao\CadastroReclamacaoEmail;

class CadastrarReclamacaoUseCase
{
    private CadastrarReclamacaoRepository $reclamacaoRepository;
    private AtualizaStatusRepository $computadorRepository;
    private InserirComponenteReclamacaoRepository $reclamacaoComponenteRepository;

    public function __construct
    (
        CadastrarReclamacaoRepository         $reclamacaoRepository,
        AtualizaStatusRepository              $computadorRepository,
        InserirComponenteReclamacaoRepository $reclamacaoComponenteRepository,
    )
    {
        $this->reclamacaoRepository = $reclamacaoRepository;
        $this->computadorRepository = $computadorRepository;
        $this->reclamacaoComponenteRepository = $reclamacaoComponenteRepository;
    }

    public function cadastrarReclamacao(array $dadosReclamacao, $foto): void
    {
        $lastIdReclamacao = $this->reclamacaoRepository->cadastrarReclamacao($dadosReclamacao,$foto);

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