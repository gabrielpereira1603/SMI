<?php

namespace app\Presentation\Controller\Pagination;

use app\Utils\View;
use WilliamCosta\DatabaseManager\Pagination as obPagination;

class Pagination
{
    /**
     * Metodo responsavel por renderizar o layout de paginacao
     * @param Request $request
     * @param Pagination $obPagination
     * @return string
     */
    public static function getPagination($request,obPagination $obPagination): array|bool|string
    {
        //PAGINAS
        $pages = $obPagination->getPages();

        //VERIFICA A QUANTIDADE DE PAGINAS
        if(count($pages) <= 1) return '';

        //LINKS
        $links = '';

        //URL ATUAL (SEM GETS)
        $url = $request->getRouter()->getCurrentUrl();

        //GET
        $queryParams = $request->getQueryParams();
        //RENDERIZA OS LINKS
        foreach($pages as $page) {
            //ALTERA A PAGINA
            $queryParams['page'] = $page['page'];

            //LINK
            $link = $url.'?'.http_build_query($queryParams);

            //VIEW
            $links .= View::render('pagination/link', [
                'page' => $page['page'],
                'link' => $link,
                'active' => $page['current'] ? 'active' : ''
            ]);
        }

        //RENDERIZA BOX DE PAGINACAO
        return View::render('pagination/box', [
            'links' => $links
        ]);
    }
}