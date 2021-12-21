<?php

class TipoCon
{
    // Campos da classe
    public static $instance;
    public $con;

    private $tabela = "tb_tipo";
    private $campos = ["id_tipo","desc_tipo"];

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
        Método de inserção de tipo de veículo
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Insert($descTipo)
    {
        try
        {
            $sql = 'INSERT INTO ' . $this->tabela . ' (' . $this->campos[1] . ') VALUES (?)';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $descTipo);

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
        Método de alterar tipo de veículo
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Update($idTipo, $descTipo)
    {
        try
        {
            $sql = 'UPDATE ' . $this->tabela . ' SET ' . $this->campos[1] . ' = ? WHERE ' . $this->campos[0] . ' = ?';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $descTipo);
            $stm->bindParam(2, $idTipo);

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
        Método de excluir tipo de veículo
        Criada: 23/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Delete($idTipo)
    {
        try
        {
            $sql = 'DELETE FROM ' . $this->tabela . ' WHERE ' . $this->campos[0] . ' = ?';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $idTipo);

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
        Método para listar tipos:
        Criação: 23/10/2020
        Autor: Leal 
        Aleteração:   
    */
    public function ListaTipo()
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
        Método para procurar tipo:
        Criação: 23/10/2020
        Autor: Leal 
        Aleteração:   
    */
    public function BuscaTipo($idTipo)
    {
        try
        {
            $sql = 'SELECT * FROM ' . $this->tabela . ' WHERE ' . $this->campos[0] . ' = ?';
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $idTipo);

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