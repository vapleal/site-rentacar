<?php

include_once("../../dao/connection.php");
include_once("../../model/usuario.php");
include_once("../../controle/usuarioCon.php");

if($_POST)
{
    // Instancia de modelo
    $usuario = new Usuario();

    // Instancia de controle
    $usuCon = new UsuarioCon();

    // Preenchimento de valores
    $usuario->setLogin($_POST['login']);
    $usuario->setSenha($_POST['senha']);

    // Metodo de inserção no banco
    //$cliCon->_Insert($cliente);
    $usuCon->_Login($usuario);
}

if($_GET)
{
    session_start();
    session_destroy();
    header("location: http://localhost/site-rentacar/");
}

?>