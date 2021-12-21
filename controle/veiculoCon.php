<?php

class VeiculoCon
{
    // Campos da classe
    public static $instance;
    public $con;

    private $tabela = "tb_veiculo";
    private $campos = ["id_veiculo","modelo_veiculo","placa_veiculo","dt_mod_veiculo","id_tipo","id_fabricante","id_cor", "foto_veiculo"];

    // Conexão com banco de dados
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new Conexao();

            return self::$instance;
        }
    }
    /*
        Função que retorna os campos da tabela
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    private function campos($t)
    {
        foreach ($this->campos as $key=>$value)
        {
            if($key > 0)
            {
                if($key ==  (sizeof($this->campos) -1))
                {
                    if($t == "cad")
                    {
                        $campo .= $value;
                    }
                    elseif($t == "alt")
                    {
                        $campo .= $value . " = ?";
                    }
                }
                else
                { 
                    if($t == "cad")
                    {
                        $campo .= $value . ", ";
                    }
                    elseif($t == "alt")
                    {
                        $campo .= $value . " = ?, ";
                    }
                }                    
            }
        }
        return $campo;
    }

    /*
        Método de inserção de veiculo de veículo
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Insert(Veiculo $veiculo)
    {       
        $sql = 'INSERT INTO ' . $this->tabela . ' (' . $this->campos("cad") . ') VALUES (?,?,?,?,?,?,?)';
        try
        {
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $veiculo->getStr_ModVeiculo());
            $stm->bindParam(2, $veiculo->getStr_Placa());
            $stm->bindParam(3, $veiculo->getStr_DtModVeiculo());
            $stm->bindParam(4, $veiculo->getInt_TpVeiculo());
            $stm->bindParam(5, $veiculo->getInt_CodFabricante());
            $stm->bindParam(6, $veiculo->getInt_CodCor());
            $stm->bindParam(7, $veiculo->getStr_FotoVeic());

            $stm->execute();
            
            if($stm)
            {
                $msg = "Dados salvos com sucesso!";
            }
            else
            {
                $msg = "Erro ao salvar!";
            }

            return $msg;
        }
        catch (Exception $e)
        {
            print "Erro ao cadastrar no banco de dados: " . $e->getMessage();
        }
    }

    /*
        Método de alterar veiculo de veículo
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Update(Veiculo $veiculo)
    {        
        $sql = 'UPDATE ' . $this->tabela . ' SET ' . $this->campos("alt") . ' WHERE id_veiculo = ?';
        try
        {            
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $veiculo->getStr_ModVeiculo());
            $stm->bindParam(2, $veiculo->getStr_Placa());
            $stm->bindParam(3, $veiculo->getStr_DtModVeiculo());
            $stm->bindParam(4, $veiculo->getInt_TpVeiculo());
            $stm->bindParam(5, $veiculo->getInt_CodFabricante());
            $stm->bindParam(6, $veiculo->getInt_CodCor());
            $stm->bindParam(7, $veiculo->getInt_CodVeiculo());

            $stm->execute();
            
            if($stm)
            {
                $msg = "Dados alterados com sucesso!";
            }
            else
            {
                $msg = "Erro ao alterar!";
            }

            return $msg;
        }
        catch (Exception $e)
        {
            print "Erro ao alterar dados no banco: " . $e->getMessage();
        }
    }

    /*
        Método de excluir veiculo de veículo
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Delete(Veiculo $veiculo)
    {
        try
        {
            $sql = 'DELETE FROM ' . $this->tabela . ' WHERE ' . $this->campos[0] . ' = ?';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $veiculo->getInt_CodVeiculo());

            $stm->execute();
            
            if($stm)
            {
                $msg = "Dados excluidos com sucesso!";
            }
            else
            {
                $msg = "Erro ao excluir dados!";
            }

            return $msg;
        }
        catch (Exception $e)
        {
            print "Erro ao excluir no banco de dados: " . $e->getMessage();
        }
    }
    /*
        Método para listar veiculoes:
        Criação: 23/10/2020
        Autor: Leal 
        Aleteração:   
    */
    public function ListaVeiculo()
    {
        try
        {
            //$sql = 'SELECT * FROM ' . $this->tabela;
            $sql = 'SELECT * FROM vw_veiculo';
            $stm = Conexao::getInstance()->prepare($sql);

            $stm->execute();
            // Tranferir para variavel
            $dados = $stm->fetchAll();

            return $dados;
        }
        catch (Exception $e)
        {
            print "Erro ao listar no banco de dados: " . $e->getMessage();
        }
    }
    /*
        Método para procurar veiculo:
        Criação: 23/10/2020
        Autor: Leal 
        Aleteração:   
    */
    public function BuscaVeiculo(Veiculo $veiculo)
    {
        try
        {
            //$sql = 'SELECT * FROM ' . $this->tabela . ' WHERE ' . $this->campos[0] . ' = ?';
            $sql = 'SELECT * FROM vw_veiculo WHERE CODIGO = ?';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $veiculo->getInt_CodVeiculo());

            $stm->execute();
            // Tranferir para variavel
            $dados = $stm->fetchAll();

            return $dados;
        }
        catch (Exception $e)
        {
            print "Erro ao listar no banco de dados: " . $e->getMessage();
        }
    }
}
?>