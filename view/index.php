<?php 
include_once("../controller/equipamento.controller.php");
include_once("../controller/pedido.controller.php");

$Aleatorio = rand(1,4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Home - Aluguel de Briquedos</title>
  <link rel="shortcut icon" href="img/Logo/logo.png" type="image/*" />
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="css/fontes.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">
  <link href="css/css.css" rel="stylesheet">
    <!-- Jquery -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <!-- Ajax -->
    <script src="../ajax/pedido.ajax.js"></script>
    <!-- Alertas Bonitinhos -->
    <script src="../js/sweetalert.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <?php include_once("menu/menu-superior.php");?>

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/Menu/castelo.jpg" alt="Primeiro Slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Praticidade</h5>
            <h6><p>Alugue seu brinquedo em apenas alguns cliques!</p></h6>
            <a href="Cad_Pedido.php" class="btn btn-danger text-light btn-lg" tabindex="-1" role="button">
            Alugue já !
          </a>
        </div>
    </div>
  <div class="carousel-item">
    <img class="d-block w-100" src="img/Menu/caminha.jpg" alt="Segundo Slide">
      <div class="carousel-caption d-none d-md-block">
        <h5>Alugue já</h5>
        <h6><p>Garanta a diversão das crianças</p></h6>
          <a href="Cad_Pedido.php" class="btn btn-danger text-light btn-lg" tabindex="-1" role="button">
          Alugue já !
          </a>
      </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="img/Menu/bolinha.jpg" alt="Terceiro Slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Brinquedos Seguros</h5>
          <h6><p>Brinquedos revisados frequentemente para uma maior segurança!</p></h6>
          <a href="Cad_Pedido.php" class="btn btn-danger text-light btn-lg" tabindex="-1" role="button">
          Alugue já !
          </a>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Próximo</span>
    </a>
  </div>


 
<section class="features-icons bg-light text-center" >
  <h2>Brinquedos</h2>
  <hr>
  <div class="container-fluid">
    <div class="row">
      <div class="card-deck">
        <?php 
        if ($certo = $equi->ConsultarEquipamento()) {
          foreach($certo as $value){
          ?>
          <div class="col-md-3" id="card-carrinho">
            <div class="card" style="height: 50rem;">
              <a href="Pag_Equipamento.php?CodEquipamento=<?php echo $value->CodEquipamento;?>" >
                <img class="card-img-top" src="img/Produtos/<?php echo $value->Imagem;?>" alt="Imagem Equipamento">
              </a>
              <div class="card-body">
                <div class="card-title">
                  <?php if ($value->Status == 'Disponivel') {?>
                    <button type='button' carrinho='btn_add_carrinho' value='<?php echo $value->CodEquipamento;?>' class='btn btn-warning btn-sm'>
                        Adicionar ao carrinho
                    </button>
                    <hr>
                    <a href="Pag_Equipamento.php?CodEquipamento=<?php echo $value->CodEquipamento;?>" >
                      <span class='badge badge-pill badge-success'>Disponivel</span>
                    </a>
                    <br>
                  <?php }else{ ?>
                      <button type='button' class='btn btn-warning btn-sm' disabled>
                          Adicionar ao carrinho
                      </button>     
                    <hr>
                      <a href="Pag_Equipamento.php?CodEquipamento=<?php echo $value->CodEquipamento;?>" >
                        <span class='badge badge-pill badge-danger'>Indisponivel</span>
                      </a>
                    <br>             
                  <?php }?>
                    <br>
                  <h5><?php echo $value->Nome;?></h5>
                </div>
                <p class="card-text"><?php echo $value->Descricao;?></p>
                <hr>
                <a href="Pag_Equipamento.php?CodEquipamento=<?php echo $value->CodEquipamento;?>" class="btn btn-primary btn-sm" tabindex="-1" role="button">
                  Ver Mais
                </a>
              </div>
              <div class="card-footer"></div>
            </div>
          </div>
          <?php }
                }else {
                  echo '<div class="container">Nenhum registro</div>';
                } ?>
      </div> 
    </div>
  </div>
</section>

  <!-- Icons Grid -->
  <section class="features-icons bg-light text-center" style="background:url('img/Menu/bolinha.jpg')"">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-screen-desktop m-auto text-black"></i>
            </div>
            <h3>Praticidade</h3>
            <p class="lead mb-0">Alugue seu brinquedo em apenas alguns cliques!</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="fa fa-truck m-auto text-black"></i>
            </div>
            <h3>Entrega rapida</h3>
            <p class="lead mb-0">Entrega rápida e no dia agendado!</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="fas fa-lock m-auto text-black"></i>
            </div>
            <h3>Brinquedos Seguros</h3>
            <p class="lead mb-0">Brinquedos revisados frequentemente para uma maior segurança!</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include_once("menu/menu-inferior.php"); ?>
</body>
</html>