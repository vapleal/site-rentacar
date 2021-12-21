<?php
include_once('pessoa.php');

class Funcionario extends Pessoa
{
    // Campos da classe
    private $int_Matricula;
    private $int_Nivel;

    // Acessores da classe
        // Matrícula
    function setInt_Matricula($matricula)
    {
        $this->int_Matricula = $matricula;
    }

    function getInt_Matricula()
    {
        return $this->int_Matricula;
    }
        // Nível de usuário
    function setInt_Nivel($nivel)
    {
        $this->int_Nivel = $nivel;
    }

    function getInt_Nivel()
    {
        return $this->int_Nivel;
    }

}

?>