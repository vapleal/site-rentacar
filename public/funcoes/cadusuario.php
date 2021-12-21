<?php
session_start();
include_once("../../dao/connection.php");
include_once("../../model/usuario.php");
include_once("../../controle/usuarioCon.php");
include_once("../../model/cliente.php");
include_once("../../controle/clienteCon.php");

if($_POST)
{
    if($_POST["acao"] == "cad")
    {
        // Instancia de modelo
        $cliente = new Cliente();
        $usuario = new Usuario();

        // Instancia de controle
        $cliCon = new ClienteCon();
        $usuCon = new UsuarioCon();

        // Preenchimento de valores
        $cliente->setInt_CPF($_POST['cpf']);
        $cliente->setStr_Nome($_POST['nome']);
        $cliente->setInt_TipoUsu(3);
        $usuario->setLogin($_POST['email']);
        $usuario->setSenha($_POST['senhac']);

        // Metodo de inserção no banco
        //$cliCon->_Insert($cliente);
        $usuCon->_Insert($usuario, $cliente);
    }
    elseif ($_POST["f"] == "fto")
    {
        fotoCli();
    }
    elseif($_POST['acao'] == "alt")
    {
        // Instancia de modelo
        $cliente = new Cliente();
        $usuario = new Usuario();

        // Instancia de controle
        $cliCon = new ClienteCon();
        $usuCon = new UsuarioCon();

        // Preenchimento de valores
        $cliente->setInt_CPF($_POST['cpf']);
        $usuario->setLogin($_POST['email']);
        $usuario->setSenha($_POST['pass']);

        // Metodo de inserção no banco
        //$cliCon->_Insert($cliente);
        echo $usuCon->_Update($usuario, $cliente);

        $_SESSION['login'] = $_POST['email'];
        $_SESSION['snh'] = $_POST['pass'];
    }

}

function fotoCli(){      
    // Recebendo a imagem do formulário
    if($_FILES["foto"]["name"] != ""){
        $imgUp = $_FILES["foto"]["name"]; // nome original
        $imgUp_tmp = $_FILES["foto"]["tmp_name"]; // nome temporário
        // salvar a imagem no servidor
        $imgEx = explode(".", $imgUp);
        $imgSv = date("dmYHis").".".end($imgEx);
        move_uploaded_file($imgUp_tmp, '../foto/'.$imgSv); //Fazer upload do arquivo
        if( $_POST['ftold'] != "" ){
            unlink('../foto/'.$_POST['ftold']);
        }
        echo $imgUp . "<br>" . $imgSv;
    } 
    else if ($_POST['ftold'] != ""){
        $imgSv = $_POST['ftold'];
    }
    else {
        $imgSv = NULL;
    }
}

?>