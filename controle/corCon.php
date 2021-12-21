<?php

class CorCon
{
    // Campos da classe
    public static $instance;
    public $con;

    private $tabela = "tb_cor";
    private $campos = ["id_cor","desc_cor"];

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
        Método de inserção de cor de veículo
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Insert($descCor)
    {
        try
        {
            $sql = 'INSERT INTO ' . $this->tabela . ' (' . $this->campos[1] . ') VALUES (?)';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $descCor);

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
        Método de alterar cor de veículo
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Update($idCor, $descCor)
    {
        try
        {
            $sql = 'UPDATE ' . $this->tabela . ' SET ' . $this->campos[1] . ' = ? WHERE ' . $this->campos[0] . ' = ?';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $descCor);
            $stm->bindParam(2, $idCor);

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
        Método de excluir cor de veículo
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Delete($idCor)
    {
        try
        {
            $sql = 'DELETE FROM ' . $this->tabela . ' WHERE ' . $this->campos[0] . ' = ?';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $idCor);

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
        Método para listar cores:
        Criação: 23/10/2020
        Autor: Leal 
        Aleteração:   
    */
    public function ListaCor()
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
        Método para procurar cor:
        Criação: 23/10/2020
        Autor: Leal 
        Aleteração:   
    */
    public function BuscaCor($idCor)
    {
        try
        {
            $sql = 'SELECT * FROM ' . $this->tabela . ' WHERE ' . $this->campos[0] . ' = ?';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $idCor);

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