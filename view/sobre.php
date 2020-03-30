-<?php 
//formulario de cadastro de pedido e dados do cliente 
include_once('../controller/pedido.controller.php'); 
include_once('../controller/equipamento.controller.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Sobre - Aluguel Briquedos</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">
  <link href="css/css.css" rel="stylesheet">

    <!-- Jquery -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <!-- Ajax -->
    <script src="../ajax/pedido.ajax.js"></script>
    <!-- Alertas Bonitinhos -->
    <script src="../js/sweetalert.js"></script>
</head>
<body class="bg-light">
 

  <?php include_once("menu/menu-superior.php"); ?>

  <br>

<center>
<div class="container">
<hr>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Contatos</h1>
    <p class="lead">(11) 99026-1709 <i class="fa fa-whatsapp" style="font-size:24px"></i></p>
    <p class="lead">(11) 99202-1098</p>
    <p class="lead">(11) 4488-7230</p>  
  </div>
</div>

<hr>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Pagamento</h1>
    <p class="lead"> O Pagamento se dá entre o Cliente alugador para o Proprietário locador apenas no local da locação ou na retirada do brinquedo.</p>
  </div>
</div>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Politica de privacidade</h1>
    <p class="lead">Garantimos que seus dados não serão trocados ou vendidos para parceiros ou quaisquer outras empresas sem sua prévia autorização. Para que estes dados permaneçam intactos, desaconselhamos expressamente a divulgação de sua senha a terceiros, mesmo a amigos e parentes. As alterações sobre nossa política de privacidade serão devidamente informadas neste espaço.</p>
    <p class="lead">Seus dados pessoais serão usados estritamente para que seu pedido chegue em segurança no endereço desejado, de acordo com nosso prazo de entrega.</P>
  </div>
</div>
<hr>

</div>
</center>  
  <?php include_once("menu/menu-inferior.php"); ?>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>