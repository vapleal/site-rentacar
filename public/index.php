<?php
$path = "";
require_once("view/header.php");

require_once("view/formlogin.php");

require_once("view/formregister.php");

require_once("view/banner.php");

?>

 <!-- Conteúdo da página -->
   <main>
   <br>
   <div class="container">  
   <div class="row"> 
   <?php
      include_once("../dao/connection.php");
      include_once("../controle/veiculoCon.php");

      $vc = new VeiculoCon();
      $lista = $vc->ListaVeiculo();
      
      foreach($lista as $card)
      { echo $card['foto_veiculo']; ?> 

      <div class="card col-sm-3" style="width: 18rem;">
         <div style="height: 200px;">
            <img class="card-img-top" src="foto/<?php echo $card['FOTO']; ?>" width="180" alt="Card image cap">
         </div>
         <div class="card-body">
            <h5 class="card-title"><?php echo $card['MODELO']; ?></h5>
            <p class="card-text"><?php echo $card['FABRICANTE'] . " " . $card['MODELO'] . " ano " . $card['ANO'] . " na cor " . $card['COR']; ?></p>
            <a href="view/formReserva.php?prl=3&idveic=<?php echo $card['CODIGO']; ?>" class="btn btn-primary">Faça sua reserva!</a>
         </div>
      </div> 

      <?php } ?> 
      
   </div>
   </div>
   </main>
 <!-- Fim conteúdo -->  
 <br><br>
<?php

require_once("view/footer.php");
?>