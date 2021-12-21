<?php
require_once('pessoa.php');

class Cliente extends Pessoa
{
    // Campos da Classe
    private $dt_Nascimento;
    private $str_Email;
    private $str_Foto;

    // Acessores da Classe
        // Data de nascimento
    function setDt_Nascimento($dtnasc)
    {
        $this->dt_Nascimento = $dtnasc;
    }

    function getDt_Nascimento()
    {
        return $this->dt_Nascimento;
    }
        // E-mail do cliente
    function setStr_Email($email)
    {
        $this->str_Email = $email;
    }

    function getStr_Email()
    {
        return $this->str_Email;
    }
       // Foto do cliente
    function setStr_Foto($foto)
    {
        $this->str_Foto = $foto;
    }

    function getStr_Foto()
    {
        return $this->str_Foto;
    }

}


?>