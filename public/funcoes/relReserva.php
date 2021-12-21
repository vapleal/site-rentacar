<?php
session_start();
include_once("../../dao/connection.php");
include_once("../../model/cliente.php");
include_once("../../controle/reservaCon.php");

function _rReservas($cpf)
{   
    // Instancia de controle
    $resCon = new ReservaCon();

    // Instancia de cliente
    $cli = new Cliente();
    
    // Preenchimento de valores
    $cli->setInt_CPF($cpf);
   
    // Metodo de busca no banco
   return $resCon->_Relatorio($cli);

}

function _sReservas()
{
    // Instancia de controle
    $resCon = new ReservaCon();
   
    // Metodo de busca no banco
   return $resCon->_RelatorioGeral();

}

if($_POST)
{
    if($_POST['acao'] == "cad")
    {
        // Instancia de controle
        $resCon = new ReservaCon();
        
        // Metodo de salvar reserva
        echo $resCon->_Insert($_POST['dtreserva'], $_SESSION['cpf'], $_POST['idveic']);

        //echo $_POST['dtreserva'] . ", " . $_SESSION['cpf']. ", " . $_POST['idveic'];
    }

    elseif($_POST['idreserva'] != "")
    {
        // Instancia de controle
        $resCon = new ReservaCon();
        
        // Metodo de salvar reserva
        echo $resCon->_Delete($_POST['idreserva']);
    }
}