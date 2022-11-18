<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');

function obterChecklist($codigo_checklist)
{
    try
    {
        $resultado = executarQuery(
            <<<EOT
                SELECT `checklist`.`codigo_checklist`, `checklist`.`codigo_autor`, `checklist`.`codigo_artefato`, `checklist`.`nome`
                FROM `checklist`
                WHERE `codigo_checklist` = ?;
            EOT, 
            'i',
            $codigo_checklist
        );
    
        if ($resultado && $resultado_sql = $resultado->get_result())
        {
            if ($linha = $resultado_sql->fetch_assoc())
                return $linha;
    
        }

        return null;
    } 
    catch (mysqli_sql_exception $e)
    {
        return null;
    }
}

function obterItens($codigo_checklist)
{
    try
    {
        $resultado = executarQuery(
            <<<EOT
                SELECT `itemchecklist`.*, `estadoitemchecklist`.`estado`
                FROM `itemchecklist`
                INNER JOIN `checklist`
                ON `checklist`.`codigo_checklist` = `itemchecklist`.`codigo_checklist`
                INNER JOIN `estadoitemchecklist`
                ON `itemchecklist`.`codigo_estado` = `estadoitemchecklist`.`codigo_estadoitemchecklist`
                WHERE `checklist`.`codigo_checklist` = ?
                ORDER BY `itemchecklist`.`codigo_itemchecklist` ASC;
            EOT, 
            'i',
            $codigo_checklist
        );
        
        if ($resultado && $resultado_sql = $resultado->get_result())
        {
            $linhas = array();
            
            while ($linha = $resultado_sql->fetch_assoc())
                $linhas[$linha['codigo_itemChecklist']] = $linha;
    
            return $linhas;
        }

        return null;
    } 
    catch (mysqli_sql_exception $e)
    {
        return null;
    }
}

/*
    USAGEM SUPER API XDDDD
    - $codigo_checklist: obrigatorio
    - $codigo_itemChecklist: null se criando um item ou codigo de um item existem para edita-lo
    - $codigo_estado: null para não alterar ou novo valor
    - $item: null para não alterar ou novo valor
    - $comentario: null para não alterar ou novo valor
*/
function criaOuEditaItem($codigo_checklist, $codigo_itemChecklist = null, $codigo_estado = null, $item = null, $comentario = null)
{
    try
    {
        $resultado = null;

        // Novo item
        if (!$codigo_itemChecklist)
        {
            $resultado = executarQuery(
                <<<EOT
                    INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`, `comentario`) 
                    VALUES (?, ?, ?, ?);
                EOT, 
                'iiss',
                $codigo_checklist,
                $codigo_estado,
                $item,
                $comentario
            );
        }
        // Editar item
        else
        {
            $campos = array();
            $vars = array();
            $tipos = "";

            if ($codigo_estado)
            {
                array_push($campos, "codigo_estado = ?");
                array_push($vars, $codigo_estado);
                $tipos .= "i";
            }
            
            if ($item)
            {
                array_push($campos, "item = ?");
                array_push($vars, $item);
                $tipos .= "s";
            }

            if ($comentario)
            {
                array_push($campos, "comentario = ?");
                array_push($vars, $comentario);
                $tipos .= "s";
            }

            array_push($vars, $codigo_itemChecklist);
            $tipos .= "i";

            $resultado = executarQuery(
                'UPDATE `itemChecklist`
                    SET '. implode(", ", $campos) .' WHERE `itemChecklist`.`codigo_itemChecklist` = ?;', 
                $tipos,
                ...$vars
            );
        }
        
        if ($resultado && $resultado->affected_rows > 0)
            return true;

        return false;
    } 
    catch (mysqli_sql_exception $e)
    {
        return false;
    }

}

function deletaItem($codigo_itemChecklist)
{
    try
    {
        $resultado_a = executarQuery(
            'DELETE FROM `itemNC` WHERE `codigo_itemChecklist` = ?;', 
            'i',
            $codigo_itemChecklist
        );

        $resultado_b = executarQuery(
            'DELETE FROM `itemchecklist` WHERE `codigo_itemChecklist` = ?;', 
            'i',
            $codigo_itemChecklist
        );

        if ($resultado_b && $resultado_b->affected_rows > 0)
            return true;

        return false;
    } 
    catch (mysqli_sql_exception $e)
    {
        return false;
    }

}
