<?php

namespace app\Presentation\Controller\Admin\Dashboard;

use app\Infrastructure\Http\Request;
use app\Presentation\Controller\Admin\Page;
use app\Utils\View;

class Dashboard extends Page
{
    public static function getIndex(Request $request){

        $content = View::render('admin/modules/dashboard/index',[

        ]);

        return parent::getPanel('Dashboard', $content, 'dashboard');
    }
}