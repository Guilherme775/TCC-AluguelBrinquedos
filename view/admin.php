<?php 
include_once('../controller/usuario.controller.php');
session_start();
$usu->Logado('administrador');
//botao sair
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_start();
    unset($_SESSION['administrador']);
    header("location: login.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Pagina do admin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/Logo/logo.png" type="image/*" />
    <!-- Bootstrap CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Jquery -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <!-- Ajax -->
    <script src="../ajax/usuario.ajax.js"></script>
    <!-- Alertas Bonitinhos -->
    <script src="../js/sweetalert.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="../js/icone.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand h1 my-auto ml-4" href="#"><h3>Admin: <?php echo $_SESSION['administrador'][0]->Nome;?></h3></a>
      <ul class="navbar-nav ml-auto">          
        <div class="ml-auto">  
          <li class="nav-item dropdown mr-sm-5" >
            <a class="nav-link mr-5" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="img/admin/usuario.png" style="width:50px; height:50px;">
            </a>
            <div class="dropdown-menu bg-danger" aria-labelledby="navbarDropdown">
              <a class="dropdown-item bg-danger" href="?logout=true">Sair</a>
            </div>
          </li>         
        </div>
      </ul>
  </nav>
  <div class="container ml-0 mt-4">
    <div class="row">

      <div class="navbar-sidebar col-2 mr-0">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">       
          <a class="nav-link badge-light active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
            Pedidos
          </a>
      
          <a class="nav-link badge-light" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
            Usuarios
          </a>
      
          <a class="nav-link badge-light" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
            Equipamentos
          </a>
                
        </div>
      </div>

      <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <?php include_once("admin.pedido.php"); ?>
          </div>
          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
      
            <?php include_once("admin.usuario.php"); ?>
            
          </div>
          <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
            <?php include_once("admin.equipamento.php"); ?>
          </div>

        </div>
      </div>

    </div>

  </div>
  </body>
</html>