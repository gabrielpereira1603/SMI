<?php

namespace app\Utils\UploadFotos;

class GerenciarArquivosFotos
{
    public static function getUploadedPhotos($files): array
    {
        $uploadedPhotos = [];

        if (!empty($files['foto-reclamacao']['tmp_name'][0])) {
            $numFiles = count($files['foto-reclamacao']['tmp_name']);

            for ($i = 0; $i < $numFiles; $i++) {
                $tmpName = $files['foto-reclamacao']['tmp_name'][$i];
                $content = file_get_contents($tmpName);
                $uploadedPhotos[] = $content;
            }
        }

        return $uploadedPhotos;
    }
}