<?php

namespace app\Presentation\Controller\Aluno;

use app\Utils\View;

class Page {

    private static array $modules = [
        'home' =>[
            'label' => 'Home',
            'link' => URL.'/aluno/home'
        ],
        'reclamacoesAbertas' =>[
            'label' => 'Reclamações Abertas',
            'link' => URL.'/aluno/reclamacoesAbertas'
        ],
        'historicoReclamacao' =>[
            'label' => 'Histórico Reclamação',
            'link' => URL.'/aluno/historicoReclamacao'
        ],
        'termosDeUso' => [
            'label' => 'Termos De Uso',
            'link'=> URL.'/aluno/regras'
        ],
        'configuracao'=> [
            'label'=> 'Settings',
            'link'=> URL.'/settingsUser'
        ],
    ];

    public static function getPage($title, $content): array|bool|string
    {
        return View::render('aluno/page', [
            'title' => $title,
            'content' => $content,
        ]);
    }

    public static function getNav($currentModule): array|bool|string
    {
        $links = '';

        foreach(self::$modules as $hash => $module){
            // Adiciona o ícone correspondente com base no hash do módulo
            $iconClass = '';
            switch ($hash) {
                case 'home':
                    $iconClass = 'bx bx-home';
                    break;
                case 'reclamacoesAbertas':
                    $iconClass = 'bx bx-comment-edit';
                    break;
                case 'historicoReclamacao':
                    $iconClass = 'bx bx-file';
                    break;
                case 'termosDeUso':
                    $iconClass = 'bx bx-book';
                    break;
                case 'configuracao':
                    $iconClass = 'bx bx-cog';
                    break;
                // Adicione mais casos para outros módulos conforme necessário
            }

            // Renderiza o link com o ícone correspondente
            $links .= View::render('aluno/menu/link',[
                'label' => $module['label'],
                'link' =>  $module['link'],
                'iconClass' => $iconClass,
                'current' => $hash == $currentModule ? 'active' : '' /**deixa o link que voce estiver vermelho */
            ]);
        }


        //RETORNA A RENDERIZACAO DO MENU
        return View::render('aluno/menu/nav',[
            'links' => $links
        ]);
    }

    public static function getPanel($title,$content,$currentModule): bool|array|string
    {
        //RENDERIZA A VIEW DO PAINEL
        $contentPanel = View::render('aluno/panel',[
            'menu' => self::getNav($currentModule),
            'content'=> $content,
        ]);

        //RETORNA A PAGINA RENDERIZADA
        return self::getPage($title,$contentPanel);
    }

}