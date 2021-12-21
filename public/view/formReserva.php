<?php
session_start();
// variavel de caminho
$path = "..\\";

require_once("header.php");

require_once("../funcoes/mform.php");

/*
    Função para criar campos na tela
    Cria campos com ID, NAME, LABEL, PLACEHOLDER, Observações
    Dados passados por parametro
*/
// 

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
        <h3>Efetuar reserva</h3>
            <form method="post" id="frmReserva">
                <?php 
                    include_once("../funcoes/cliente.php");
                    include_once("../../dao/connection.php");
                    include_once("../../controle/veiculoCon.php");
                    include_once("../../model/veiculo.php");
                    include_once("../funcoes/relReserva.php");


                    if ($_GET['prl'] == 0)
                    {

                    }
                    if ($_GET['prl'] == 3)
                    {
                      $v = new Veiculo();
                      $vc = new VeiculoCon();

                      $v->setInt_CodVeiculo($_GET['idveic']);

                      $dados = $vc->BuscaVeiculo($v);
                      $campos = [ 
                        ["id"=>"dtreserva", "lbl"=>"", "obs"=>"", "tp"=>"date", "vl"=>date("Y-m-d"), "liga"=>"required"],
                        ["id"=>"idveic", "lbl"=>"", "obs"=>"", "tp"=>"hidden", "vl"=> $_GET['idveic'], "liga"=>""],
                        ["id"=>"tpcad", "lbl"=>"", "obs"=>"", "tp"=>"hidden", "vl"=>"reserva", "liga"=>""],
                        ["id"=>"acao", "lbl"=>"", "obs"=>"", "tp"=>"hidden", "vl"=>"cad", "liga"=>""]
                      ];
                      ?>
                        <table class="table table-striped">
                          <thead class="thead-darkgreen">
                            <tr>
                              <th scope="col">Foto</th>
                              <th scope="col">Modelo</th>
                              <th scope="col">Reservar para</th>
                              <th scope="col">Ações</th>
                            </tr>
                          </thead>
                          <tbody >
                      <?php
                          foreach ($dados as $dado)
                          {
                            echo " 
                            <tr>
                              <th scope=\"row\"><img src=\"../foto/" . $dado['FOTO'] . "\" width=\"180\" ></th>
                              <td style=\"vertical-align: middle;\"><h3>$dado[MODELO]</h3></td>
                              <td style=\"vertical-align: middle;\">";
                              _Campos($campos);
                              echo "</td>
                              <td style=\"vertical-align: middle;\">
                                <div class=\"form-group\">
                                  <button class=\"btn-primary btn-lg\" id=\"reservar\" name=\"reservar\">Reservar</button>
                                  &nbsp&nbsp
                                  <a href=\"http://localhost/site-rentacar\" class=\"btn-danger btn-lg\">Cancelar</a>
                                </div>
                              </td>
                            </tr>";                      
                          }
                    }
                    else
                      {
                          $campos = null;
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