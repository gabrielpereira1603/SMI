<?php

namespace app\Presentation\Controller\Api;

class Api
{
    public static function getDetails($request): array
    {
        $obUser = $request->user;

        return [
            'nome' => $obUser->getNomeUsuario(),
            'versao' => 'v1',
            'autor' => 'Gabriel Pereira',
            'email' => 'gabrielpereira@somosdevteam.com'
        ];
    }
}