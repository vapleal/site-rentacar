<?php
include_once("../../dao/connection.php");
include_once("../../controle/fabricanteCon.php");

if($_POST)
{
    if($_POST['acao'] == "cad")
    {
        $fabricante = new FabricanteCon();

        echo $fabricante->_Insert($_POST['descfabricante']);
    }

    elseif($_POST['acao'] == "alt")
    {
        $fabricante = new FabricanteCon();

        echo $fabricante->_Update($_POST['idfabricante'], $_POST['descfabricante']);
    }

    elseif($_POST['acao'] == "del")
    {
        $fabricante = new FabricanteCon();

        echo $fabricante->_Delete($_POST['idfabricante']);
    }
}
elseif($_GET)
{
    if($_GET['acao'] == "lista")
    {
        $fabricante = new FabricanteCon();

        print_r($fabricante->ListaFabricante());
    }
    elseif($_GET['acao'] == "busca")
    {
        $fabricante = new FabricanteCon();

        print_r($fabricante->BuscaFabricante($_GET['idfabricante']));
    }
}