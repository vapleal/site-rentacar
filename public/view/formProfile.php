<?php
session_start();
// variavel de caminho
$path = "..\\";

require_once("header.php");

/*
    Função para criar campos na tela
    Cria campos com ID, NAME, LABEL, PLACEHOLDER, Observações
    Dados passados por parametro
*/
require_once("../funcoes/mform.php");

?>

 <!-- Conteúdo da página -->

<div class="d-flex" id="wrapper">
<!-- Sidebar -->
<div class="bg-success col-md-2" id="sidebar-wrapper">
    <div class="sidbar-heading">
        <center><img src="../image/logo.png" width="70px" ></center>
    </div>
    <div class="dropdown-divider"></div>
    <div class="list-group">
        <a href="formProfile.php?prl=0" class="list-group-item list-group-item-action"> Dados Pessoais </a>
        <a href="formProfile.php?prl=1" class="list-group-item list-group-item-action" id="dl"> Dados de Login </a>
        <div class="dropdown-divider"></div>
        <a href="formProfile.php?prl=2" class="list-group-item list-group-item-action"> Reservas </a>
    </div>
    <div class="dropdown-divider"></div>
</div>
<!-- Formulario cadastro -->
<div class="col-md-9">
    <div class="page-content-wrapper">
        <div id="conteudo">
<h3><?php if ($_GET['prl'] == 0) { ?> Dados Cadastrais <?php } elseif ($_GET['prl'] == 1) { ?> Dados de Login <?php } ?></h3>
            <form action="#" id="frmProfile">
                <?php 
                    include_once("../funcoes/cliente.php");
                    include_once("../funcoes/relReserva.php");

                    //$c = new Cliente();

                    $c = _rCliente($_SESSION['cpf']);
                    
                    //echo $c->getStr_Nome();

                    if ($_GET['prl'] == 0)
                    {
                        $campos = [ 
                                ["id"=>"acao", "lbl"=>"", "obs"=>"", "tp"=>"hidden", "vl"=>"alt", "liga"=>""],
                                ["id"=>"tpcad", "lbl"=>"", "obs"=>"", "tp"=>"hidden", "vl"=>"profile", "liga"=>""],
                                ["id"=>"cpf", "lbl"=>"CPF", "obs"=>"(Somente números)", "tp"=>"text", "vl"=>$_SESSION['cpf'], "liga"=>"readonly"],
                                ["id"=>"nome", "lbl"=>"Nome", "obs"=>"", "tp"=>"text", "vl"=>$c->getStr_Nome(), "liga"=>""],
                                ["id"=>"cnh", "lbl"=>"CNH", "obs"=>"", "tp"=>"text", "vl"=>$c->getInt_CNH(), "liga"=>""],
                                ["id"=>"cep", "lbl"=>"CEP", "obs"=>"(Somente números)", "tp"=>"text", "vl"=>$c->getInt_CEP(), "liga"=>""],
                                ["id"=>"endereco", "lbl"=>"Endereço", "obs"=>"", "tp"=>"text", "vl"=>$c->getStr_Endereco(), "liga"=>""],
                                ["id"=>"bairro", "lbl"=>"Bairro", "obs"=>"", "tp"=>"text", "vl"=>$c->getStr_Bairro(), "liga"=>""],
                                ["id"=>"cidade", "lbl"=>"Cidade", "obs"=>"", "tp"=>"text", "vl"=>$c->getStr_Cidade(), "liga"=>""],
                                ["id"=>"estado", "lbl"=>"Estado", "obs"=>"", "tp"=>"text", "vl"=>$c->getStr_UF(), "liga"=>""]
                            ];
                    }
                    elseif ($_GET['prl'] == 1)
                    {
                        $campos = [ 
                                ["id"=>"acao", "lbl"=>"", "obs"=>"", "tp"=>"hidden", "vl"=>"alt", "liga"=>""],
                                ["id"=>"tpcad", "lbl"=>"", "obs"=>"", "tp"=>"hidden", "vl"=>"usuario", "liga"=>""],
                                ["id"=>"cpf", "lbl"=>"CPF", "obs"=>"(Somente números)", "tp"=>"text", "vl"=>$_SESSION['cpf'], "liga"=>"readonly"],
                                ["id"=>"nome", "lbl"=>"Nome", "obs"=>"", "tp"=>"text", "vl"=>$c->getStr_Nome(), "liga"=>"readonly"],
                                ["id"=>"email", "lbl"=>"E-mail", "obs"=>"", "tp"=>"text", "vl"=>$_SESSION['login'], "liga"=>""],
                                ["id"=>"pass", "lbl"=>"Senha", "obs"=>"", "tp"=>"password", "vl"=>$_SESSION['snh'], "liga"=>""]
                            ];
                    }
                    elseif ($_GET['prl'] == 2)
                    {
                        
                      $dados = _rReservas($_SESSION['cpf']);
                    ?>
                      <table class="table table-striped">
                        <thead class="thead-darkgreen">
                          <tr>
                            <th scope="col">Nº Reserva</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Data da Reserva</th>
                            <th scope="col">Confirmado</th>
                            <th scope="col">Ações</th>
                          </tr>
                        </thead>
                        <tbody>
                    <?php
                        foreach ($dados as $dado)
                        {
                          echo " 
                          <tr>
                            <th scope=\"row\">$dado[RESERVA]</th>
                            <td>$dado[NOME]</td>
                            <td>$dado[MODELO]</td>
                            <td>$dado[DATA]</td>
                            <td>$dado[CONFIRMA]</td>
                            <td>
                              <button type=\"button\" class=\"btn-warning btn-lg cancelar\" value=\"$dado[RESERVA]\">Cancelar Reserva</button>
                            
                            </td>
                          </tr>";                      
                        }
                    ?>
                        </tbody>
                      </table>
                      <div class="form-group">
                          <button class="btn-primary btn-lg" id="prev" name="prev"> << Anterior  </button>

                          <button class="btn-primary btn-lg" id="next" name="nex">  Próxima >> </button>
                      </div>
                    <?php
                    }
                    else
                      {
                          $campos = null;
                      }
                    _Campos($campos); 
                    
                    if ($campos !== null)
                    {
                    ?>
                      <div class="form-group">
                          <button class="btn-primary btn-lg" id="salva" name="salva">Salvar</button>
                      </div>
                    <?php
                    }
                    ?>
                <br><br><br>
            </form>
        </div>
    </div>
</div>


<!-- Fim --> 

<!-- Fim -->

</div>


 <!-- Fim conteúdo -->  
 
<?php

require_once("footer.php");
?>