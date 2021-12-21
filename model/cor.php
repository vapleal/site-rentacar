<?php

class Cor
{
    private $int_CodCor;
    private $str_NmCor;
    
    /**
     * Código da Cor
     */ 
    public function getInt_CodCor()
    {
        return $this->int_CodCor;
    }

    public function setInt_CodCor($int_CodCor)
    {
        $this->int_CodCor = $int_CodCor;
    }

    /**
     * Nome da Cor
     */ 
    public function getStr_NmCor()
    {
        return $this->str_NmCor;
    }

    public function setStr_NmCor($str_NmCor)
    {
        $this->str_NmCor = $str_NmCor;

    }
}
?>