<?php

namespace app\Presentation\Utilitarios\Componentes\Select;

use app\Application\UseCase\Situacao\BuscarTodasSituacaoUseCase;
use app\Domain\Exceptions\Situacao\ErrorAoBuscarSituacaoException;
use app\Infrastructure\DataBase\Situacao\BuscarTodasSituacaoDAO;
use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class SelectSituacoesComputador extends Page
{
    private BuscarTodasSituacaoDAO $buscarTodasSituacaoDAO;

    public function __construct(BuscarTodasSituacaoDAO $buscarTodasSituacaoDAO)
    {
        $this->buscarTodasSituacaoDAO = $buscarTodasSituacaoDAO;
    }

    public function buscarSituacao(Request $request)
    {
        try {
            $obSituacao = (new BuscarTodasSituacaoUseCase($this->buscarTodasSituacaoDAO))->execute($request);
            $itens = '';
            foreach ($obSituacao as $situacao) {
                $itens .= View::render('admin/situacao/selectTodasSituacao', [
                    'codsituacao' => $situacao->getCodsituacao(),
                    'tipo_situacao' => $situacao->getTipoSituacao(),
                ]);
            }

            return parent::getPage('Select Nivel Acesso', $itens);
        }catch (ErrorAoBuscarSituacaoException $e){
            return ['situacao' => $e->getMessage()];
        }
    }

}