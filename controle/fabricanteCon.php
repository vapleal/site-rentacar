<?php

class FabricanteCon
{
    // Campos da classe
    public static $instance;
    public $con;

    private $tabela = "tb_fabricante";
    private $campos = ["id_fabricante","desc_fabricante"];

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
        Método de inserção de fabricante de veículo
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Insert($descFabricante)
    {
        try
        {
            $sql = 'INSERT INTO ' . $this->tabela . ' (' . $this->campos[1] . ') VALUES (?)';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $descFabricante);

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
        Método de alterar fabricante de veículo
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Update($idFabricante, $descFabricante)
    {
        try
        {
            $sql = 'UPDATE ' . $this->tabela . ' SET ' . $this->campos[1] . ' = ? WHERE ' . $this->campos[0] . ' = ?';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $descFabricante);
            $stm->bindParam(2, $idFabricante);

            $stm->execute();
            
            if($stm)
            {
                $msg = "Dados alterados com sucesso!";
            }
            else
            {
                $msg = "Erro ao alterar dados!";
            }

            return $msg;
        }
        catch (Exception $e)
        {
            print "Erro ao alterar no banco de dados: " . $e->getMessage();
        }
    }

    /*
        Método de excluir fabricante de veículo
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Delete($idFabricante)
    {
        try
        {
            $sql = 'DELETE FROM ' . $this->tabela . ' WHERE ' . $this->campos[0] . ' = ?';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $idFabricante);

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
        Método para listar fabricantees:
        Criação: 23/10/2020
        Autor: Leal 
        Aleteração:   
    */
    public function ListaFabricante()
    {
        try
        {
            $sql = 'SELECT * FROM ' . $this->tabela;
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
        Método para procurar fabricante:
        Criação: 23/10/2020
        Autor: Leal 
        Aleteração:   
    */
    public function BuscaFabricante($idFabricante)
    {
        try
        {
            $sql = 'SELECT * FROM ' . $this->tabela . ' WHERE ' . $this->campos[0] . ' = ?';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $idFabricante);

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