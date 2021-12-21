<?php
session_start();
include_once("../../dao/connection.php");
include_once("../../model/cliente.php");
include_once("../../controle/clienteCon.php");

function _rCliente($cpf)
{
    // Instancia de modelo
    $cli = new Cliente();

    // Instancia de controle
    $cliCon = new ClienteCon();

    // Preenchimento de valores
    $cli->setInt_CPF($cpf);
   
    // Metodo de busca no banco
    //print_r($cliCon->_Profile($cli)['NOME']);
    
    $cli->setStr_Nome($cliCon->_Profile($cli)['NOME']);
    $cli->setInt_CNH($cliCon->_Profile($cli)['CNH']);
    $cli->setStr_Endereco($cliCon->_Profile($cli)['LOGRADOURO']);
    $cli->setStr_Bairro($cliCon->_Profile($cli)['BAIRRO']);
    $cli->setStr_Cidade($cliCon->_Profile($cli)['CIDADE']);
    $cli->setInt_CEP($cliCon->_Profile($cli)['CEP']);
    $cli->setStr_UF($cliCon->_Profile($cli)['UF']);

    return $cli;
}


if($_POST)
{
    $cli = new Cliente();

    $cli->setStr_Nome($_POST['nome']);
    $cli->setInt_CNH($_POST['cnh']);
    $cli->setStr_Endereco($_POST['endereco']);
    $cli->setStr_Bairro($_POST['bairro']);
    $cli->setStr_Cidade($_POST['cidade']);
    $cli->setStr_UF($_POST['estado']);
    $cli->setInt_CEP($_POST['cep']);
    $cli->setInt_CPF($_POST['cpf']);

    if($_POST['acao'] == "cad")
    {
        $cliCon = new ClienteCon();    
        echo $cliCon->_Insert($cli);
    }

    elseif($_POST['acao'] == "alt")
    {
        $cliCon = new ClienteCon();  
        //$cli->setInt_CodCliente($_POST['idcliente']);
        //print_r($cli);
        echo $cliCon->_Update($cli);

        $_SESSION["nome"] = $_POST['nome'];
    }

    elseif($_POST['acao'] == "del")
    {
        $cliCon = new ClienteCon(); 
        //$cli->setInt_CodCliente($_POST['idcliente']);    
        echo $cliCon->_Delete($cli);
    }    
}




?>