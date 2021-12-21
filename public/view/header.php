<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentACar - Aluguel de Veículos</title>
    <link rel="stylesheet" href="<?php echo $path . "css\bootstrap\style.css"; ?>" >
    <link rel="icon" href="<?php echo $path . "image\image.png"; ?>" type="image/png">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>
<!-- Cabeçalho e menu -->
 <header>
<?php
session_start();

$site = "http://www.rentacar.com/";
$dev = "http://localhost/site-rentacar/";

?>
        <nav class="navbar navbar-dark navbar-expand-lg bg-success">
            <div class="container">
                <a href="<?php echo $dev; ?>" class="navbar-brand"> <img src="<?php echo $path . "image/logo.png";?>" width="60%"> </a>
                
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navSite">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--
                <div class="collapse navbar-collapse" id="navSite">
                    
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link"> Link 1 </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"> Link 2 </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"> Link 3 </a>
                        </li>
                    </ul>

                </div>
                -->
                <?php 
                if (!$_SESSION) { ?>
                    <div class="row">
                        <div id="loga" class="botao-login" data-toggle="modal" data-target="#LoginModal"></div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div id="loga">
                            <div class="collapse navbar-collapse">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" id="ProfMenu" role="button"
                                        data-toggle="dropdown" >
                                            <img src="<?php echo $path ."image/logo.png"; ?>" height="50px" class="rounded-circle">
                                        </a>
                                        <div class="dropdown-menu" aria-labelleadby="ProfMenu">
                                            <div class="dropdown-item"><?php echo $_SESSION["nome"]  ?></div>
                                            <div class="dropdown-divider"></div>
                                            <a href="<?php echo $path ."view/formProfile.php?prl=2"; ?>" class="dropdown-item"> Reservas </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="<?php echo $path ."view/formProfile.php?prl=0"; ?>" class="dropdown-item"><i class="fa fa-user"></i> Dados pessoais </a>
                                            <a href="<?php echo $path ."view/formProfile.php?prl=1"; ?>" class="dropdown-item"> Alterar senha </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="<?php echo $path . "funcoes/login.php?sair=sair";?>" class="dropdown-item">Sair</a>
                                        </div>
                                    </li>
                                </ul>                            
                            </div>                            
                        </div>
                    </div>
                <?php } ?>

            </div>        
        </nav>
    </header>
 <!-- Fim cabeçalho -->