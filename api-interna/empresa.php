<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');


function obterRelacionadas()
{
    try
    {
        $resultado = executarQuery(
            <<<EOT
                SELECT `empresa`.`codigo_empresa`, `empresa`.`nome`, `usuario`.`nome` AS `dono`, `usuario_empresa`.`cargo`, `usuario_empresa`.`auditor`
                FROM `usuario_empresa`
                INNER JOIN `empresa`
                ON `empresa`.`codigo_empresa` = `usuario_empresa`.`codigo_empresa`
                INNER JOIN `usuario`
                ON `empresa`.`codigo_criador` = `usuario`.`codigo_usuario`
                WHERE `usuario_empresa`.`codigo_usuario` = ?;
            EOT, 
            'i',
            $_SESSION['codigo_usuario']
        );
    
        if ($resultado && $resultado_sql = $resultado->get_result())
        {
            $linhas = array();
            
            while ($linha = $resultado_sql->fetch_assoc())
                $linhas[$linha['codigo_empresa']] = $linha;
    
            return $linhas;
        }

        return null;
    } 
    catch (mysqli_sql_exception $e)
    {
        return null;
    }
}
