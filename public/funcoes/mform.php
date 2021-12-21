<?php

/*
    Função para criar campos na tela
    Cria campos com ID, NAME, LABEL, PLACEHOLDER, Observações
    Dados passados por parametro
*/
function _Campos($campos)
{
    if($campos != null)
    {
        foreach ($campos as $campo)   
        { 
            echo
            "<div class=\"form-group\">";
            echo ($campo['lbl'] != "") ? "<label for=\"$campo[id]\" class=\"col-form-label\">$campo[lbl] $campo[obs]</label>" : "";
            echo "<input type=\"$campo[tp]\" class=\"form-control\" id=\"$campo[id]\" name=\"$campo[id]\" placeholder=\"$campo[lbl]...\" value=\"$campo[vl]\" $campo[liga]>
            </div>";
        }
    }
}
/*
    Função para criar combos na tela
    Cria campos com ID, NAME, LABEL, DADOS
    Dados passados por parametro
*/
function _Combos($valor, $tit, $id)
{
    if($valor != null)
    {
        echo "<div class=\"form-group\">
                <label for=\"$id\" class=\"col-form-label\">$tit</label>
                <select id=\"$id\" name=\"$id\" >";        
        foreach ($valor as $v)   
        { 
            echo
            "<option value=\"$v[0]\"> $v[1] </option>";
        }

        echo "</select>
        </div>";
    }
}
?>