<?php

namespace app\Controller\Api\Usuario;

use app\Model\Dao\Usuario\UsuarioDao;

class UsuarioApi
{
    public static function buscarUsuarioPorID($request, $codusuario): array
    {

        $result = (new UsuarioDao())->getByID($codusuario);

        if ($result === null){
            return []; // Retorna um array vazio se o usuário não for encontrado
        }

        // Extrai os dados do objeto $result e os adiciona ao array de retorno
        return [
            'codusuario' => $result->getCodusuario(),
            'nome_usuario' => $result->getNomeUsuario(),
            'email_usuario' => $result->getEmailUsuario(),
            'tipo_acesso' => $result->getNivelAcesso()->getTipoAcesso(),
            'login' => $result->getLogin(),
        ];
    }

}