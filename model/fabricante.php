<?php

class Fabricante
{
    private $int_CodFabricante;
    private $str_NmFabricante;

    /**
     * Código Fabricante
     */ 
    public function getInt_CodFabricante()
    {
        return $this->int_CodFabricante;
    }
 
    public function setInt_CodFabricante($int_CodFabricante)
    {
        $this->int_CodFabricante = $int_CodFabricante;
    }

    /**
     * Nome Fabricante
     */ 
    public function getStr_NmFabricante()
    {
        return $this->str_NmFabricante;
    }
 
    public function setStr_NmFabricante($str_NmFabricante)
    {
        $this->str_NmFabricante = $str_NmFabricante;
    }
}
?>