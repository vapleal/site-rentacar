<?php
include_once("../../dao/connection.php");
include_once("../../controle/tipoCon.php");

if($_POST)
{
    if($_POST['acao'] == "cad")
    {
        $tp = new TipoCon();

        echo $tp->_Insert($_POST['desctipo']);
    }

    elseif($_POST['acao'] == "alt")
    {
        $tp = new TipoCon();

        echo $tp->_Update($_POST['idtipo'], $_POST['desctipo']);
    }

    elseif($_POST['acao'] == "del")
    {
        $tp = new TipoCon();

        echo $tp->_Delete($_POST['idtipo']);
    }
}
elseif($_GET)
{
    if($_GET['acao'] == "lista")
    {
        $tp = new TipoCon();

        print_r($tp->ListaTipo());
    }
    elseif($_GET['acao'] == "busca")
    {
        $tp = new TipoCon();

        print_r($tp->BuscaTipo($_GET['idtipo']));
    }
}