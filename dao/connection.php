<?php

class Conexao
{
    // Campo para requisitar conexão
    public static $instance;

    // Método de conexão
    public static function getInstance()
    {
        if(!isset(self::$instance))
        {
            // Dados para conexão
            $server = "mysql:host=localhost";
            $bd     = "dbname=db_drc";
            $user   = "root";
            $pass   = "";
            $servico = $server . ';' . $bd;

            // string de conexão
            self::$instance = new PDO(
                $servico, $user, $pass,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
/*
            if(self::$instance)
            {
                echo "Conexão";
            }
            else
            {
                echo "Não conexão";
            }
*/
        }

        return self::$instance;
    }
}