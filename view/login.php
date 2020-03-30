<!-- vai estar na pagina de admin -->
<?php 
include_once('../controller/usuario.controller.php');
session_start();

$usu->Logou('administrador');//se ja esta logado

// echo "<pre>";
// print_r($_SESSION['administrador']);
// echo "</pre>";
// echo "<br> <br>";
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Área Restrita</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/Logo/logo.png" type="image/*" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Jquery -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <!-- Ajax -->
    <script src="../ajax/usuario.ajax.js"></script>
    <!-- Alertas Bonitinhos -->
    <script src="../js/sweetalert.js"></script>
  </head>
  <body>
<center>
  <div class="container">
  
  <div class="col-md-6 col-sm-6">

  
  <div>&nbsp;</div>
  <div>&nbsp;</div>
  <div>&nbsp;</div>    
  
<?php if(@$_SESSION['tentativas'] < 3){ ?>      


          
          <div class="card border-primary mb-3" style="max-width: 25rem;">
  <div class="card-header"><h3>Área Restrita</h3></div>
  <div class="card-body text-danger">
    <h5 class="card-title"></h5>
    <p class="card-text">
    <form action="" name="form_login" class="form" method="post">
            <div class="form-group">
                
                <input type="text" name="txtlogin" class="form-control  input-lg" placeholder="Login">   
            </div>
            <div class="form-group">
                
                <input type="password" name="txtsenha" class="form-control" placeholder="Senha">
            </div>

            <div class="form-group">
                <a href="recuperar_senha.php">Esqueceu sua senha ?</a>
                
              </div>

            
                <button type="submit" id="btn_login" class="btn btn-primary btn-lg">
                Logar
            </button>

            
            <img src="../img/load.gif" class="load" alt="Carregando..." style="display: none" />
          </form>
          <br>
          <img src="../img/load-login.gif" id="load" style="display: none" />
          
    </p>
  </div>
</div>  

<?php
}
else {
$n1 = rand(1,10);
$n2 = rand(1,10);

$total = $n1 + $n2;
?>


<div class="card border-danger mb-6" style="max-width: 25rem;">
  <div class="card-header bg-danger text-white"><h3>Verificação</h3></div>
  <div class="card-body">
    <h5 class="card-title"><?php echo "Responda Quanto é $n1 + $n2 ? "; ?></h5>
    <p class="card-text">
    <form name="form_verificar" method="POST" class="form-signin">
      <div class="form-label-group">
      <label for="inputEmail"></label>
        <input type="number" name="txtresposta" class="form-control col-4" required autofocus>
      </div>
        <input type="hidden"  name="txtcerta" value="<?php echo $total;?>" class="form-control">
      <div class="custom-control custom-checkbox mb-3"></div>
      <input type="submit" value="Verificar" class="btn btn-lg btn-danger">
    </form>
    </p>
  </div>
</div>



            
            
<?php } ?>



          
      </div>
  </div>
  </center>
  </body>
</html>