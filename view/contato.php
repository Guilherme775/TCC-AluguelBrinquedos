<?php 
//formulario de cadastro de pedido e dados do cliente 
include_once('../controller/pedido.controller.php'); 
include_once('../controller/equipamento.controller.php'); 
include_once('../controller/usuario.controller.php'); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Contato - Aluguel Briquedos</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">
  <link href="css/css.css" rel="stylesheet">

    <!-- Jquery -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <!-- Ajax -->
    <script src="../ajax/pedido.ajax.js"></script>
    <!-- Alertas Bonitinhos -->
    <script src="../js/sweetalert.js"></script>

    <script src="../js/validador.js"></script>
</head>
<body class="bg-light">
    

  <?php include_once("menu/menu-superior.php"); ?>

<center>
  <br>
  <hr>
    <div class="container">
    <h2>Contato</h2>
    <hr>
      <form action="email.php" method="post">
        
        <label for="Nome">Nome:</label>
            <input type="text" class="form-control" name="Nome" id="txtnome" placeholder="Digite seu Nome" maxlength="50"/>

        <label for="Email">E-mail:</label>
              <input type="text" class="form-control" name="Email" id="txtemail" placeholder="Digite seu Email"/>

        <label for="Fone">Telefone:</label>
              <input type="text" class="form-control" name="Fone"  id="txttelefone" maxlength="13" onkeydown="javascript: fMasc( this, mTel );" placeholder="(11)3333-9999" />

        <label for="Fone">Assunto:</label>
              <input type="text" class="form-control" name="Assunto" maxlength="20" placeholder="Digite o assunto da mensagem" />
            
        <label for="Mensagem">Mensagem:</label>
          <textarea  class="form-control"  name="Mensagem" rows="8" cols="40" placeholder="Digite a mensagem"></textarea>
      <br>
        <input type="submit" class="btn btn-primary" name="enviar" value="Enviar" />
      </form>
    </div>
</center>  
  <?php include_once("menu/menu-inferior.php"); ?>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>