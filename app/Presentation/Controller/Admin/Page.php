<?php
namespace app\Controller\Admin;

use \app\Utils\View;

class Page {

    /**
     * Modulos disponiveis no painel
    */
    private static array $modules = [
        'home' =>[
            'label' => 'Home',
            'link' => URL.'/admin'
        ],
        'user' =>[
            'label' => 'User',
            'link' => URL.'/admin/user'
        ],
        'dashboard' =>[
            'label' => 'Dashboard',
            'link' => URL.'/admin/dashboard'
        ],
        'relatorio'=> [
            'label'=> 'Relatório',
            'link'=> URL.'/admin/relatorio'
        ],
        'termosDeUso' => [
            'label' => 'Termos De Uso',
            'link'=> URL.'/regras'
        ],
        'gerenciar'=> [
            'label'=> 'Gerenciar',
            'link'=> URL.'/admin/gerenciar'
        ],
    ];

    /**
     * Metodo responsavel por retornar o conteudo (view) da estrutura generica de pagina do painel
     * @param string
     * @param string
     * @return string
     */
    public static function getPage($title, $content): string
    {
        return View::render('admin/page', 
        [
            'title' => $title,
            'content' => $content
        ]);
    }

        /**
     * Metodo responsavel por renderizar a view do header de navegacao
     * @param string
     * return string
    */
    public static function getNav($currentModule): array|bool|string
    {
        //LIKS DO MENU
        $links = '';

        // Itera os módulos
        foreach(self::$modules as $hash => $module){
            // Adiciona o ícone correspondente com base no hash do módulo
            $iconClass = '';
            switch ($hash) {
                case 'home':
                    $iconClass = 'bx bx-home';
                    break;
                case 'user':
                    $iconClass = 'bx bx-user';
                    break;
                case 'dashboard':
                    $iconClass = 'bx bxs-dashboard';
                    break;
                case 'termosDeUso':
                    $iconClass = 'bx bx-book';
                    break;
                case 'gerenciar':
                    $iconClass = 'bx bx-cog';
                    break;
                case 'relatorio':
                    $iconClass = 'bx bx-file';
                    break;
                // Adicione mais casos para outros módulos conforme necessário
            }

            // Renderiza o link com o ícone correspondente
            $links .= View::render('admin/menu/link',[
                'label' => $module['label'],
                'link' =>  $module['link'],
                'iconClass' => $iconClass,
                'current' => $hash == $currentModule ? 'active' : '' /**deixa o link que voce estiver vermelho */
            ]);
        }

        
        //RETORNA A RENDERIZACAO DO MENU
        return View::render('admin/menu/nav',[
            'links' => $links
        ]);
    }

    /**
     * Metodo responsavel por renderizar a view do painel com conteudos dinamicos
     * @param string $titlre
     * @param string $content
     * @param string $currentModule
     * @return string
     */
    public static function getPanel($title,$content,$currentModule): string
    {
        //RENDERIZA A VIEW DO PAINEL
        $contentPanel = View::render('admin/panel',[
            'menu' => self::getNav($currentModule),
            'content'=> $content,
        ]);

        //RETORNA A PAGINA RENDERIZADA
        return self::getPage($title,$contentPanel);
    }

}