<?php

class UsuarioCon
{
    // Campos da classe
    public static $instance;
    public $usuario;
    public $con;

    // Conexão com banco de dados
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new Conexao();

            return self::$instance;
        }
    }

    public function _Insert(Usuario $usuario, Cliente $cliente)
    {
        // instrução sql
        //$sql = "INSERT INTO tb_usuario (login_usuario, pass_usuario, cpf_pessoa) VALUES (?, ?, ?)";
        //CALL pr_insert_usu(11111111116, 'Teste proc 2', 3, 'testeproc2@local.com', '1234567', @msg)
        try
        {        
            $sql = "CALL pr_insert_usu(?, ?, ?, ?, ?, @msg)";
            // Parametros de banco de dados
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $cliente->getInt_CPF());
            $stm->bindParam(2, $cliente->getStr_Nome());
            $stm->bindParam(3, $cliente->getInt_Tipousu());
            $stm->bindParam(4, $usuario->getLogin());
            $stm->bindParam(5, $usuario->getSenha());
            
            // Executar a instrução
            $stm->execute();

            // mensagem de cadastro
            $msg = $stm->fetchAll();
            foreach ($msg as $linha) 
            {
                echo $linha['msg'];
            }
        }
        catch (Exception $e)
        {
            print "Erro ao cadastrar no banco de dados: " . $e->getMessage();
        }
    }

    /*
        Método de alterar dados de login
        Criada: 29/10/2020
        Autor: Leal
        Alterações    
    */
    public function _Update(Usuario $u, Cliente $p)
    {        
        $sql = 'UPDATE tb_usuario SET login_usuario = ?, pass_usuario = ? WHERE cpf_pessoa = ?';
        try
        {            
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $u->getLogin());
            $stm->bindParam(2, $u->getSenha());
            $stm->bindParam(3, $p->getInt_CPF());

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
    public function _Delete(Cliente $p)
    {        
        $sql = 'DELETE FROM tb_usuario WHERE cpf_pessoa = ?';
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
                $msg = "Erro ao excluir!";
            }

            return $msg;
        }
        catch (Exception $e)
        {
            print "Erro ao alterar dados no banco: " . $e->getMessage();
        }
    }

    public function _Login(Usuario $usuario)
    {
        try
        {        
            $sql = "CALL pr_login(?, ?)";
            // Parametros de banco de dados
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $usuario->getLogin());
            $stm->bindParam(2, $usuario->getSenha());
            
            // Executar a instrução
            $stm->execute();

            // mensagem de cadastro
            $msg = $stm->fetchAll();
            foreach ($msg as $linha) 
            {
                $dados = [ "Nome" => $linha["nome_pessoa"], 
                            "Login" => $linha["login_usuario"], 
                            "CPF" => $linha["cpf_pessoa"], 
                            "Pass" => $linha["pass_usuario"] ];
            }
            // Carrega dados de sessão
            if(!$dados)
            {
                $dados = [ "Nome" => "" ];
            }
            else
            {
                session_start();
                $_SESSION["nome"] = $dados["Nome"];
                $_SESSION["login"] = $dados["Login"];
                $_SESSION["cpf"] = $dados["CPF"];
                $_SESSION["snh"] = $dados["Pass"];
            }
            print_r(json_encode($dados));
        }
        catch (Exception $e)
        {
            print "Erro ao consultar dados: " . $e->getMessage();
        }
    }    
}