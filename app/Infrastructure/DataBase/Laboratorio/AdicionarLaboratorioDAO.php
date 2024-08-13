<?php

namespace app\Infrastructure\DataBase\Laboratorio;

use app\Domain\Exceptions\Email\ErroAoEnviarEmailException;
use app\Domain\Exceptions\Usuario\ErrorAoCriarUsuarioException;
use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;

class AdicionarLaboratorioDAO
{
    public static function adicionaLaboratorio(Request $request, $nomeLaboratorio)
    {
        try {
            $database = new Database('laboratorio');

            $lastID = $database->insert([
                'numerolaboratorio' => $nomeLaboratorio,
            ]);

            $request->getRouter()->redirect('/admin/gerenciar?success=' . urlencode("Laboratório cadastrado com sucesso!"));
        }catch (\Exception){
            $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode($e->getMessage()));
        }
    }
}