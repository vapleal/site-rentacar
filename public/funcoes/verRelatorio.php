<?php
include_once("../../dao/connection.php");
include_once("../../controle/reservaCon.php");
include_once("../../model/cliente.php");

function VerReserva($cpf)
{
    $cli = new Cliente();

    $reserva = new ReservaCon();

    $cli->setInt_CPF($cpf);

    return $reserva->_Relatorio($cli);
}

