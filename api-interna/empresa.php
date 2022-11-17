<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');

function obterRelacionadas()
{
    try
    {
        $resultado = executarQuery(
            <<<EOT
                SELECT `empresa`.`codigo_empresa`, `empresa`.`nome`, `usuario`.`nome` AS `dono`, `usuario`.`codigo_usuario` AS `codigo_dono`, `usuario_empresa`.`cargo`, `usuario_empresa`.`auditor`
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

function obterFuncionarios($codigo_empresa)
{
    try
    {
        $resultado = executarQuery(
            <<<EOT
                SELECT `usuario`.`codigo_usuario`, `usuario`.`nome`, `usuario_empresa`.`cargo`, `usuario_empresa`.`auditor`
                FROM `usuario_empresa`
                INNER JOIN `usuario`
                ON `usuario_empresa`.`codigo_usuario` = `usuario`.`codigo_usuario`
                WHERE `codigo_empresa` = ?;
            EOT, 
            'i',
            $codigo_empresa
        );
    
        if ($resultado && $resultado_sql = $resultado->get_result())
        {
            $linhas = array();
            
            while ($linha = $resultado_sql->fetch_assoc())
                $linhas[$linha['codigo_usuario']] = $linha;
    
            return $linhas;
        }

        return null;
    } 
    catch (mysqli_sql_exception $e)
    {
        return null;
    }
}

function obterNaoFuncionarios($codigo_empresa)
{
    try
    {
        $resultado = executarQuery(
            <<<EOT
                SELECT `usuario`.`codigo_usuario`, `usuario`.`nome`
                FROM `usuario` WHERE
                `usuario`.`codigo_usuario` NOT IN 
                (
                    SELECT `usuario_empresa`.`codigo_usuario`
                    FROM `usuario_empresa`
                    WHERE `usuario_empresa`.`codigo_empresa` = ?
                );       
            EOT, 
            'i',
            $codigo_empresa
        );
    
        if ($resultado && $resultado_sql = $resultado->get_result())
        {
            $linhas = array();
            
            while ($linha = $resultado_sql->fetch_assoc())
                $linhas[$linha['codigo_usuario']] = $linha;
    
            return $linhas;
        }

        return null;
    } 
    catch (mysqli_sql_exception $e)
    {
        return null;
    }
}

function eFuncionario($codigo_usuario, $codigo_empresa, $eAuditor = false)
{
    try
    {
        $resultado = executarQuery(
            'SELECT 1
                FROM `usuario_empresa`
                WHERE `usuario_empresa`.`codigo_usuario` = ? AND `usuario_empresa`.`codigo_empresa` = ? ' . ($eAuditor ? 'AND `usuario_empresa`.`auditor` = 1;' : ';'),
            'ii',
            $codigo_usuario,
            $codigo_empresa
        );
    
        if ($resultado && $resultado_sql = $resultado->get_result())
            return $resultado_sql->num_rows > 0;

        return false;
    } 
    catch (mysqli_sql_exception $e)
    {
        return false;
    }

}

function obterArtefatos($codigo_empresa)
{
    try
    {
        $resultado = executarQuery(
            <<<EOT
                SELECT *
                FROM `artefato`
                WHERE `codigo_empresa` = ?;
            EOT, 
            'i',
            $codigo_empresa
        );
    
        if ($resultado && $resultado_sql = $resultado->get_result())
        {
            $linhas = array();
            
            while ($linha = $resultado_sql->fetch_assoc())
                $linhas[$linha['codigo_artefato']] = $linha;
    
            return $linhas;
        }

        return null;
    } 
    catch (mysqli_sql_exception $e)
    {
        return null;
    }

}
