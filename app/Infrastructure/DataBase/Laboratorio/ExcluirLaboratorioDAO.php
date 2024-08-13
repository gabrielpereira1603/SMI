<?php

namespace app\Infrastructure\DataBase\Laboratorio;

use app\Infrastructure\Http\Request;
use WilliamCosta\DatabaseManager\Database;
use PDOException;

class ExcluirLaboratorioDAO
{
    public static function excluiLaboratorio(Request $request, $idLaboratorio)
    {
        try {
            $database = new Database('laboratorio');
            $where = "codlaboratorio = $idLaboratorio";

            // Tenta excluir o laboratório
            $database->delete($where);

            // Se a exclusão for bem-sucedida, redireciona com uma mensagem de sucesso
            $request->getRouter()->redirect('/admin/gerenciar?success=' . urlencode("Laboratório excluído com sucesso!"));
        } catch (PDOException $e) {
            error_log($e->getMessage());

            // Verifica se o erro é uma violação de chave estrangeira
            if ($e->getCode() == '23000') {
                // Redireciona com uma mensagem específica para violação de chave estrangeira
                $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro: O laboratório não pode ser excluído porque outros dados dependem dele."));
            } else {
                // Redireciona com uma mensagem genérica de erro
                $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro ao excluir o laboratório: " . $e->getMessage()));
            }
        } catch (\Exception $e) {
            // Captura qualquer outra exceção e redireciona com uma mensagem de erro
            $request->getRouter()->redirect('/admin/gerenciar?error=' . urlencode("Erro inesperado: " . $e->getMessage()));
        }
    }
}
