<?php

abstract class Pessoa
{
    // Campos da classe
    private $str_Nome;
    private $int_CPF;
    private $int_CNH;
    private $dt_Cadastro;
    private $str_Endereco;
    private $str_Bairro;
    private $str_Cidade;
    private $str_UF;
    private $int_CEP;
    private $int_TipoUsu;

    // Acessores da classe
        // Nome Pessoa
    function setStr_Nome($nome)
    {
        $this->str_Nome = $nome;
    }

    function getStr_Nome()
    {
        return $this->str_Nome;
    }
        // CPF
    function setInt_CPF($cpf)
    {
        $this->int_CPF = $cpf;
    }

    function getInt_CPF()
    {
        return $this->int_CPF;
    }
        // CNH
    function setInt_CNH($cnh)
    {
        $this->int_CNH = $cnh;
    }

    function getInt_CNH()
    {
        return $this->int_CNH;
    }
        // Data de Cadastro
    function setDt_Cadastro($dtcad)
    {
        $this->dt_Cadastro = $dtcad;
    }

    function getDt_Cadastro()
    {
        return $this->dt_Cadastro;
    }
        // Dados de endereço
    function setStr_Endereco($ender)
    {
        $this->str_Endereco = $ender;
    }

    function getStr_Endereco()
    {
        return $this->str_Endereco;
    }

    function setStr_Bairro($bairro)
    {
        $this->str_Bairro = $bairro;
    }

    function getStr_Bairro()
    {
        return $this->str_Bairro;
    }

    function setStr_Cidade($cidade)
    {
        $this->str_Cidade = $cidade;
    }

    function getStr_Cidade()
    {
        return $this->str_Cidade;
    }

    function setStr_UF($uf)
    {
        $this->str_UF = $uf;
    }

    function getStr_UF()
    {
        return $this->str_UF;
    }

    function setInt_CEP($cep)
    {
        $this->int_CEP = $cep;
    }

    function getInt_CEP()
    {
        return $this->int_CEP;
    }

        // Tipo de usuário
    function setInt_TipoUsu($tipo)
    {
        $this->int_TipoUsu = $tipo;
    }

    function getInt_TipoUsu()
    {
        return $this->int_TipoUsu;
    }
}

?>