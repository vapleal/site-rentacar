<?php
include_once("../../dao/connection.php");
include_once("../../controle/corCon.php");

if($_POST)
{
    if($_POST['acao'] == "cad")
    {
        $cor = new CorCon();

        echo $cor->_Insert($_POST['desccor']);
    }

    elseif($_POST['acao'] == "alt")
    {
        $cor = new CorCon();

        echo $cor->_Update($_POST['idcor'], $_POST['desccor']);
    }

    elseif($_POST['acao'] == "del")
    {
        $cor = new CorCon();

        echo $cor->_Delete($_POST['idcor']);
    }
}
elseif($_GET)
{
    if($_GET['acao'] == "lista")
    {
        $cor = new CorCon();

        print_r($cor->ListaCor());
    }
    elseif($_GET['acao'] == "busca")
    {
        $cor = new CorCon();

        print_r($cor->BuscaCor($_GET['idcor']));
    }
}