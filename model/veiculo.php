<?php

class Veiculo
{
    // Campos da classe
    private $int_CodVeiculo;
    private $int_CodFabricante;
    private $int_CodCor;
    private $int_TpVeiculo;
    private $str_ModVeiculo;
    private $str_DtModVeiculo;
    private $str_Placa;
    private $str_FotoVeic;

    /**
     * Código Veículo
     */ 
    public function getInt_CodVeiculo()
    {
        return $this->int_CodVeiculo;
    }
 
    public function setInt_CodVeiculo($int_CodVeiculo)
    {
        $this->int_CodVeiculo = $int_CodVeiculo;
    }

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
     * Código Cor
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
     * Código Tipo Veículo
     */ 
    public function getInt_TpVeiculo()
    {
        return $this->int_TpVeiculo;
    }

    public function setInt_TpVeiculo($int_TpVeiculo)
    {
        $this->int_TpVeiculo = $int_TpVeiculo;
    }

    /**
     * Modelo
     */ 
    public function getStr_ModVeiculo()
    {
        return $this->str_ModVeiculo;
    }

    public function setStr_ModVeiculo($str_ModVeiculo)
    {
        $this->str_ModVeiculo = $str_ModVeiculo;
    }

    /**
     * Data Modelo
     */ 
    public function getStr_DtModVeiculo()
    {
        return $this->str_DtModVeiculo;
    }

    public function setStr_DtModVeiculo($str_DtModVeiculo)
    {
        $this->str_DtModVeiculo = $str_DtModVeiculo;
    }

    /**
     * Placa
     */ 
    public function getStr_Placa()
    {
        return $this->str_Placa;
    }

    public function setStr_Placa($str_Placa)
    {
        $this->str_Placa = $str_Placa;
    }

    /**
     * Foto do Veículo
     */ 
    public function getStr_FotoVeic()
    {
        return $this->str_FotoVeic;
    }
 
    public function setStr_FotoVeic($str_FotoVeic)
    {
        $this->str_FotoVeic = $str_FotoVeic;
    }
}
?>