<?php

class Usuario
{
    private $login;
    private $senha;

    /**
     * Get e Set of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * Get e Set of senha
     */ 
    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
}

?>