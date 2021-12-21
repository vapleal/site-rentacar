<?php
class ReservaCon
{
    // Campos da classe
    public static $instance;
    private $con;

    private $tabela = "tb_reserva";
    private $campos = ["id_reserva", "dt_reserva", "dt_conf_reserva", "confirma_reserva", "id_veiculo", "cpf_pessoa"];


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
        Método de inserção de reserva de veículo
        Criada: 06/11/2020
        Autor: Leal
        Alterações    
    */
    public function _Insert($dt, $cli, $veic)
    {       
        $sql = 'INSERT INTO ' . $this->tabela . ' (' . $this->campos[1] . ','  . $this->campos[4] . ',' . $this->campos[5] . ') VALUES (?,?,?)';
        try
        {
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $dt);
            $stm->bindParam(2, $veic);
            $stm->bindParam(3, $cli);

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
        Método de cancelar reserva de veículo
        Criada: 06/11/2020
        Autor: Leal
        Alterações    
    */
    public function _Delete($id)
    {       
        $sql = 'DELETE FROM ' . $this->tabela . ' WHERE ' . $this->campos[0] . ' = ?';
        try
        {
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $id);

            $stm->execute();
            
            if($stm)
            {
                $msg = "Reserva cancelada com sucesso!";
            }
            else
            {
                $msg = "Erro ao cancelar reserva!";
            }

            return $msg;
        }
        catch (Exception $e)
        {
            print "Erro ao cadastrar no banco de dados: " . $e->getMessage();
        }
    }

    public function _Relatorio(Cliente $c)
    {
        try
        {        
            $sql = "SELECT * FROM vw_reserva WHERE CPF = ?";
            // Parametros de banco de dados
            $stm = Conexao::getInstance()->prepare($sql);
            $stm->bindParam(1, $c->getInt_CPF());
            
            // Executar a instrução
            $stm->execute();

            // mensagem de cadastro
            $dados = $stm->fetchAll();
            
            return $dados;
        }
        catch (Exception $e)
        {
            print "Erro ao consultar dados: " . $e->getMessage();
        }
    }

    public function _RelatorioGeral()
    {
        try
        {        
            $sql = "SELECT * FROM vw_reserva";
            // Parametros de banco de dados
            $stm = Conexao::getInstance()->prepare($sql);
            
            // Executar a instrução
            $stm->execute();

            // mensagem de cadastro
            $dados = $stm->fetchAll();
            
            return $dados;
        }
        catch (Exception $e)
        {
            print "Erro ao consultar dados: " . $e->getMessage();
        }
    }
}

?>