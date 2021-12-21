<?php
include_once("../../dao/connection.php");
include_once("../../controle/veiculoCon.php");
include_once("../../model/veiculo.php");
if($_POST)
{
    $veic = new Veiculo();

    $veic->setStr_ModVeiculo($_POST['modveiculo']);
    $veic->setStr_Placa($_POST['placaveiculo']);
    $veic->setStr_DtModVeiculo($_POST['anoveiculo']);
    $veic->setInt_TpVeiculo($_POST['tipoveiculo']);
    $veic->setInt_CodFabricante($_POST['fabveiculo']);
    $veic->setInt_CodCor($_POST['corveiculo']);
    

    if($_POST['acao'] == "cad")
    {
        $veicCon = new VeiculoCon();
        // Recebendo a imagem do formulário
        $foto = $_FILES["foto"]["name"]; // nome original

        $foto_tmp = $_FILES["foto"]["tmp_name"]; // nome temporário

        $veic->setStr_FotoVeic($foto);

        // salvar a imagem no servidor
        move_uploaded_file($foto_tmp, '../foto/'.$foto); //Fazer upload do arquivo

        //print_r($veic);
         
        echo $veicCon->_Insert($veic);
    }

    elseif($_POST['acao'] == "alt")
    {
        $veicCon = new VeiculoCon();  
        $veic->setInt_CodVeiculo($_POST['idveiculo']);  
        echo $veicCon->_Update($veic);
    }

    elseif($_POST['acao'] == "del")
    {
        $veicCon = new VeiculoCon(); 
        $veic->setInt_CodVeiculo($_POST['idveiculo']);   
        echo $veicCon->_Delete($veic);
    }
    
}
elseif($_GET)
{
    if($_GET['acao'] == "lista")
    {
        $veiculo = new VeiculoCon();

        print_r($veiculo->ListaVeiculo());
    }
    elseif($_GET['acao'] == "busca")
    {
        $veiculo = new VeiculoCon();
        $veic = new Veiculo();
        $veic->setInt_CodVeiculo($_GET['idveiculo']);
        print_r($veiculo->BuscaVeiculo($veic));
    }
    /*
    elseif($_GET['acao'] == "teste")
    {
        $veiculo = new VeiculoCon();

        echo $veiculo->campos();
    }
    */
}
