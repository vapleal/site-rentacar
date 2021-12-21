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
$page = 'formSistema.php';
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
        <a href="<?php echo $page ?>?prl=0" class="list-group-item list-group-item-action"> Reservas </a>        
        <div class="dropdown-divider"></div>
        <a href="<?php echo $page ?>?prl=1" class="list-group-item list-group-item-action" id="dl"> Cadastro de Veículos </a>
        <a href="<?php echo $page ?>?prl=2" class="list-group-item list-group-item-action"> Cadastro de Fabricantes </a>
        <a href="<?php echo $page ?>?prl=3" class="list-group-item list-group-item-action"> Cadastro de Cores </a>
        <a href="<?php echo $page ?>?prl=4" class="list-group-item list-group-item-action"> Cadastro de Tipos </a>
        <div class="dropdown-divider"></div>
        <a href="<?php echo $page ?>?prl=5" class="list-group-item list-group-item-action" id="dl"> Cadastro de Usuários </a>
    </div>
    <div class="dropdown-divider"></div>
</div>
<!-- Formulario cadastro -->
<div class="col-md-9">
    <div class="page-content-wrapper">
        <div id="conteudo">
<h3><?php if ($_GET['prl'] == 0) { ?> Pedidos de Reservas <?php } elseif ($_GET['prl'] == 1) { ?> Cadastro de Veículos <?php } elseif ($_GET['prl'] == 2) { ?> Cadastro de Fabricantes <?php } elseif ($_GET['prl'] == 3) { ?> Cadastro de Cores <?php } elseif ($_GET['prl'] == 4) { ?> Cadastro de Tipos <?php } ?></h3>
            <form action="#" id="frmSistema" enctype="multipart/form-data">
                <?php 
                    include_once("../funcoes/relReserva.php");
                    // Para veiculo
                    include_once("../../controle/veiculoCon.php");
                    include_once("../../controle/fabricanteCon.php"); 
                    include_once("../../controle/corCon.php"); 
                    include_once("../../controle/tipoCon.php"); 
                    include_once("../../model/veiculo.php");

                    if ($_GET['prl'] == 0)
                    {
                    $dados = _sReservas();
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
                            <td>Ação</td>
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
                    elseif ($_GET['prl'] == 1)
                    {
                      /*
                      $url = 'http://localhost/site-rentacar/funcoes/veiculoVeic.php?acao=lista'; 
                      //$data = http_build_query( array( 'acao' => 'lista' ) );                      
                      $options = array(
                          'http' => array(
                              'header'  => "Content-type: application/x-www-form-urlencoded",
                              'method'  => 'GET'
                          ),
                      );                      
                      $context = stream_context_create( $options );                      
                      $dados = file_get_contents( $url, false, $context );
                      print_r($dados);
                      */   
                      
                      $id = "";
                      $modelo = "";
                      $placa = "";
                      $fabricante = "";
                      $tipo = "";
                      $cor = "";

                      $lista = new VeiculoCon();
                      $fab   = new FabricanteCon();
                      $cor   = new CorCon();
                      $tipo  = new TipoCon();

                      $veic = new Veiculo();

                      $fabl = $fab->ListaFabricante();
                      $corl = $cor->ListaCor();
                      $tipol = $tipo->ListaTipo();

                      $dados = $lista->ListaVeiculo();
                      ?>
                        <input type="hidden" name="tpcad" id="tpcad" value="veiculo">
                        <input type="hidden" name="acao" id="acao" value="cad">
                        <table class="table table-striped">
                          <thead class="thead-darkgreen">
                            <tr>
                              <th scope="col">Código</th>
                              <th scope="col">Modelo</th>
                              <th scope="col">Placa</th>
                              <th scope="col">Fabricante</th>
                              <th scope="col">Tipo</th>
                              <th scope="col">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                      <?php
                      
                          foreach ($dados as $dado)
                          {
                            echo " 
                            <tr>
                              <th scope=\"row\">$dado[CODIGO]</th>
                              <td>$dado[MODELO]</td>
                              <td>$dado[PLACA]</td>
                              <td>$dado[FABRICANTE]</td>
                              <td>$dado[TIPO]</td>
                              <td><a class=\"btn-primary btn-lg\" href=\"formSistema.php?prl=1&acao=1&id=$dado[CODIGO]\" name=\"nex\">  Alterar </a></td>
                            </tr>";                      
                          } 

                          if($_GET)
                          {
                            if($_GET['id'] != "")
                            {
                              $veic->setInt_CodVeiculo($_GET['id']);
                              
                              $l = $lista->BuscaVeiculo($veic);

                              foreach($l as $carro)
                              {
                                $id = $carro['CODIGO'];
                                $modelo = $carro['MODELO'];
                                $placa = $carro['PLACA'];
                                $fabricante = $carro['FABRICANTE'];
                                $tipo = $carro['TIPO'];
                                $cor = $carro['COR'];
                                $ano = $carro['ANO'];
                                $foto = $carro['FOTO'];
                              }
                            }
                          }
                          
                        ?> 
                          </tbody>
                          </table>
                          <div class="form-group">
                              <button class="btn-primary btn-lg" id="prev" name="prev"> << Anterior  </button>
    
                              <button class="btn-primary btn-lg" id="next" name="nex">  Próxima >> </button>
                          </div>
                        <?php
                        $campos = [ 
                          ["id"=>"modveiculo", "lbl"=>"Modelo", "obs"=>"", "tp"=>"text", "vl"=>"$modelo", "liga"=>""],
                          ["id"=>"placaveiculo", "lbl"=>"Placa", "obs"=>"", "tp"=>"text", "vl"=>"$placa", "liga"=>""],
                          ["id"=>"anoveiculo", "lbl"=>"Ano", "obs"=>"(Somente Ano)", "tp"=>"text", "vl"=>"$ano", "liga"=>""],
                          ["id"=>"tpcad", "lbl"=>"", "obs"=>"", "tp"=>"hidden", "vl"=>"veiculo", "liga"=>""],
                          ["id"=>"acao", "lbl"=>"", "obs"=>"", "tp"=>"hidden", "vl"=>"cad", "liga"=>""]
                        ];                       
                          
                    }
                    elseif ($_GET['prl'] == 2)
                    {
                      $fab   = new FabricanteCon();

                      $fablista = $fab->ListaFabricante();

                      ?>
                        <input type="hidden" name="tpcad" id="tpcad" value="fabricante">
                        <input type="hidden" name="acao" id="acao" value="cad">
                        <table class="table table-striped">
                          <thead class="thead-darkgreen">
                            <tr>
                              <th scope="col">Código</th>
                              <th scope="col">Descrição</th>
                              <th scope="col">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                      <?php
                      
                          foreach ($fablista as $dado)
                          {
                            echo " 
                            <tr>
                              <th scope=\"row\">$dado[0]</th>
                              <td>$dado[1]</td>
                              <td>Ação</td>
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
                        $campos = [ 
                          ["id"=>"idfabricante", "lbl"=>"Código", "obs"=>"", "tp"=>"text", "vl"=>"", "liga"=>"disabled"],
                          ["id"=>"descfabricante", "lbl"=>"Fabricante", "obs"=>"", "tp"=>"text", "vl"=>"", "liga"=>""]
                        ]; 

                    }
                    elseif ($_GET['prl'] == 3)
                    {
                      $cor   = new CorCon();

                      $corlista = $cor->ListaCor();

                      ?>
                        <input type="hidden" name="tpcad" id="tpcad" value="cor">
                        <input type="hidden" name="acao" id="acao" value="cad">
                        <table class="table table-striped">
                          <thead class="thead-darkgreen">
                            <tr>
                              <th scope="col">Código</th>
                              <th scope="col">Descrição</th>
                              <th scope="col">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                      <?php
                      
                          foreach ($corlista as $dado)
                          {
                            echo " 
                            <tr>
                              <th scope=\"row\">$dado[0]</th>
                              <td>$dado[1]</td>
                              <td>Ação</td>
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
                        $campos = [ 
                          ["id"=>"idcor", "lbl"=>"Código", "obs"=>"", "tp"=>"text", "vl"=>"", "liga"=>"disabled"],
                          ["id"=>"desccor", "lbl"=>"Cor", "obs"=>"", "tp"=>"text", "vl"=>"", "liga"=>""]
                        ]; 

                    }
                    elseif ($_GET['prl'] == 4)
                    {
                      $tipo  = new TipoCon();

                      $tipolista = $tipo->ListaTipo();

                      ?>
                        <input type="hidden" name="tpcad" id="tpcad" value="tipo">
                        <input type="hidden" name="acao" id="acao" value="cad">
                        <table class="table table-striped">
                          <thead class="thead-darkgreen">
                            <tr>
                              <th scope="col">Código</th>
                              <th scope="col">Descrição</th>
                              <th scope="col">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                      <?php
                      
                          foreach ($tipolista as $dado)
                          {
                            echo " 
                            <tr>
                              <th scope=\"row\">$dado[0]</th>
                              <td>$dado[1]</td>
                              <td></td>
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
                        $campos = [ 
                          ["id"=>"idtipo", "lbl"=>"Código", "obs"=>"", "tp"=>"text", "vl"=>"", "liga"=>"disabled"],
                          ["id"=>"desctipo", "lbl"=>"Tipo", "obs"=>"", "tp"=>"text", "vl"=>"", "liga"=>""]
                        ]; 

                    }
                    else
                      {
                          $campos = null;
                      }
                    _Campos($campos);

                    if($fabl != null)
                    {
                      // Array de dados, label, id do objeto
                      _Combos($fabl,'Fabricante', 'fabveiculo');
                    }
                    if($corl != null)
                    {
                      _Combos($corl,'Cor', 'corveiculo');
                    }
                    if($tipol != null)
                    {
                      _Combos($tipol,'Tipo', 'tipoveiculo');

                      ?>
                      <div >
                      
                        <input type="file" id="foto" name="foto" >
                        <label for="foto">Selecione uma foto</label>
                      </div>
                      <?php
                    }
                    
                    if ($campos !== null)
                    {
                    ?>
                    <div class="form-group">
                      <?php
                        if($foto != "")
                        {
                          ?>

                            <img src="../foto/<?php echo $foto; ?>" width="120px"><br>
                            <a class="btn-warning btn-lg" href="formSistema.php?prl=1">  Cancelar </a>

                          <?php
                        }
                      ?>
                      
                          <a class="btn-primary btn-lg" id="salva" name="salva">Salvar</a>
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