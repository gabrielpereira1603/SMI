<?php

//INCLUI AS ROTAS DE login
include __DIR__ . '/admin/login.php';

//INCLUI AS ROTAS DA home
include __DIR__ . '/admin/home.php';

//INCLUI AS ROTAS DE manutencao dos computadores
include __DIR__ . '/admin/menuComputadores.php';

//INCLUI AS ROTAS DE dados reclamacao ADMIN
include __DIR__ . '/admin/registrarManutencao/viewRegistrarManutencao.php';

//INCLUI AS ROTAS DE gerenciamento de usuario
include __DIR__ . '/admin/gerenciarUsuarioRoutes/gerenciarUsuarios.php';

//INCLUI AS ROTAS DE gerenciamento de gerar relatorio
include __DIR__ . '/admin/gerarRelatorio/gerarRelatorio.php';

include __DIR__ . '/admin/dashboard.php';

include __DIR__ . '/admin/configuracoes/configuracoes.php';
