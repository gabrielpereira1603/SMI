<?php

namespace app\Model\UseCase\Reclamacao;

use app\Exceptions\RegistrarReclamacao\FalhaCadastroReclamacao;
use app\Model\Entity\Reclamacao;
use app\Model\Service\Computador\AtualizaStatusRepository;
use app\Model\Service\Foto\InserirFotoReclamacaoRepository;
use app\Model\Service\Reclamacao\CadastrarReclamacaoRepository;
use app\Model\Service\ReclamacaoComponente\InserirComponenteRepository;
use app\Utils\Email\CadastrarReclamacao\CadastroReclamacaoEmail;

class CadastrarReclamacaoUseCase
{
    private CadastrarReclamacaoRepository $reclamacaoRepository;
    private AtualizaStatusRepository $computadorRepository;
    private InserirComponenteRepository $reclamacaoComponenteRepository;
    private InserirFotoReclamacaoRepository $inserirFotoReclamacaoRepository;

    public function __construct
    (
        CadastrarReclamacaoRepository $reclamacaoRepository,
        AtualizaStatusRepository $computadorRepository,
        InserirComponenteRepository $reclamacaoComponenteRepository,
        InserirFotoReclamacaoRepository $inserirFotoReclamacaoRepository
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