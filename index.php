<?php

require __DIR__ .'/includes/app.php';

use app\Infrastructure\Http\Router;

$obRouter = new Router(URL);
 
//INCLUI AS ROTAS DE PAGINAS
include __DIR__.'/routes/web/aluno.php';

//INCLUI AS ROTAS DE ADMIN
include __DIR__ . '/routes/web/admin.php';

//INCLUI AS ROTAS DE API
include __DIR__ . '/routes/api/api.php';


//IMPRIMI O RESPONSE DA ROTA
$obRouter->run()->sendResponse();
