<?php

class ClienteCon
{
    // Campos da classe
    public static $instance;
    public $pessoa;
    public $con;

    private $tabela = "tb_pessoa";
    private $campos = ["cpf_pessoa","nome_pessoa","cnh_pessoa","ender_pessoa","bairro_pessoa","cidade_pessoa","uf_pessoa", "cep_pessoa"];
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


    public function _Profile(Cliente $c)
    {
        try
        {        
            $sql = "SELECT * FROM vw_pessoa WHERE CPF = ?";
            // Parametros de banco de dados
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $c->getInt_CPF());
            
            // Executar a instrução
            $stm->execute();

            // mensagem de cadastro
            $dados = $stm->fetch(PDO::FETCH_ASSOC);
            
            return $dados;
        }
        catch (Exception $e)
        {
            print "Erro ao consultar dados: " . $e->getMessage();
        }
    }

    /*
        Método de alterar dados de cliente
        Criada: 29/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Update(Pessoa $p)
    {        
        $sql = 'UPDATE ' . $this->tabela . ' SET ' . $this->campos("alt") . ' WHERE ' . $this->campos[0] . ' = ?';
        try
        {            
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $p->getStr_Nome());
            $stm->bindParam(2, $p->getInt_CNH());
            $stm->bindParam(3, $p->getStr_Endereco());
            $stm->bindParam(4, $p->getStr_Bairro());
            $stm->bindParam(5, $p->getStr_Cidade());
            $stm->bindParam(6, $p->getStr_UF());
            $stm->bindParam(7, $p->getInt_CEP());
            $stm->bindParam(8, $p->getInt_CPF());

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
        Método de excluir dados de cliente
        Criada: 29/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Delete(Pessoa $p)
    {        
        $sql = 'DELETE FROM ' . $this->tabela . ' WHERE ' . $this->campos[0] . ' = ?';
        try
        {            
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $p->getInt_CPF());

            $stm->execute();
            
            if($stm)
            {
                $msg = "Dados excluidos com sucesso!";
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
    public function _Insert(Cliente $pessoa)
    {
        // instrução sql
        $sql = "INSERT INTO tb_pessoa (cpf_pessoa, nome_pessoa, tpusu_pessoa) VALUES (?, ?, 3)";
        // Parametros de banco de dados
        $stm = Conexao::getInstance()->prepare($sql);
        $stm->bindParam(1, $pessoa->getInt_CPF());
        $stm->bindParam(2, $pessoa->getStr_Nome());
        // Executar a instrução
        $stm->execute();

        // retorna 0 ou 1
        if($stm)
        {
            //echo "Cadastro Cliente realizado. ";
        }
        else
        {
            echo "Erro ao cadastrar cliente. ";
        }
    }
*/
}