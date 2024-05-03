<?php

namespace app\Model\Service\ReclamacaoComponente;

interface InserirComponenteRepository
{
    //preciso passar o codigo componente para ser inserido,
    // e passar o array de componentes que vao ser amarrados a o codigo da reclamacao passado
    public function inserirComponente(int $codreclamacao, int $componente): bool;
}