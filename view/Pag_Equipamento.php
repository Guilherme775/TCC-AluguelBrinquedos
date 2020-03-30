<?php include_once("../controller/equipamento.controller.php");
include_once("../controller/pedido.controller.php");

$CodEquipamento = filter_input(INPUT_GET, 'CodEquipamento', FILTER_SANITIZE_NUMBER_INT);

if(isset($_REQUEST['CodEquipamento'])):
if (!$value = $equi->RetornarDados($CodEquipamento)):
    echo "<h1>Página não encontrada</h1>";
    include_once("erro.php");
else:
    $value = $equi->RetornarDadosObj($CodEquipamento);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo $value->Nome;?> - Aluguel de Briquedos</title>

  <link rel="shortcut icon" href="img/Logo/logo.png" type="image/*" />

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
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Mascaras -->
  <script src="../js/validador.js"></script>
  
</head>

<body>
<?php include_once("menu/menu-superior.php");?>

<section class="features-icons bg-light text-center espaco-topo" >
    <h3>Brinquedo - <?php echo $value->Nome;?></h3>
    <hr>
  <div class="container">
    <div class="row">
        <div class="card-deck">
            <div class="card brinquedos" id="brinquedos">
              <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <?php 
                  $CodEquipamento = $value->CodEquipamento; 
                  if ($CodEquipamento == 1){
                    $img1 = "<img class='d-block w-100' src='img/Produtos/CasteloInflavel/1.jpg' alt='Primeiro Slide'>";
                    $img2 = "<img class='d-block w-100' src='img/Produtos/CasteloInflavel/2.jpg' alt='Segundo Slide'>";
                    $img3 = "<img class='d-block w-100' src='img/Produtos/CasteloInflavel/3.jpg' alt='Terceiro Slide'>";
                  }
                  else if ($CodEquipamento == 2){
                      $img1 = '<img class="d-block w-100" src="img/Produtos/CamaElastica/1.jpg" alt="Primeiro Slide">';
                      $img2 = '<img class="d-block w-100" src="img/Produtos/CamaElastica/2.jpg" alt="Segundo Slide">';
                      $img3 = '<img class="d-block w-100" src="img/Produtos/CamaElastica/3.jpg" alt="Terceiro Slide">';
                  }
                  else if ($CodEquipamento == 3){
                    $img1 = '<img class="d-block w-100" src="img/Produtos/PiscinaBolinhas/1.jpg" alt="Primeiro Slide">';
                    $img2 = '<img class="d-block w-100" src="img/Produtos/PiscinaBolinhas/2.jpg" alt="Segundo Slide">';
                    $img3 = '<img class="d-block w-100" src="img/Produtos/PiscinaBolinhas/3.jpg" alt="Terceiro Slide">';
                    }
                    else if($CodEquipamento == 4){
                    $img1 = '<img class="d-block w-100" src="img/Produtos/MaquinaAlgodão/1.jpg" alt="Primeiro Slide">';
                    $img2 = '<img class="d-block w-100" src="img/Produtos/MaquinaAlgodão/2.jpg" alt="Segundo Slide">';
                    $img3 = '<img class="d-block w-100" src="img/Produtos/MaquinaAlgodão/3.jpg" alt="Terceiro Slide">';

                    }                   
                    if ($CodEquipamento <= 4) {
                    echo "<div class='carousel-item active'>
                            $img1
                          </div>
                          <div class='carousel-item'>
                            $img2
                          </div>
                          <div class='carousel-item'>
                            $img3
                          </div>";
                    }
                    else{
                    echo "<img class='d-block w-100' src='img/Produtos/$value->Imagem' width='555' height='400' alt='Imagem Equipamento'>";
                    }
                  ?>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                  </a>
                </div>

              <div class="card-footer">
                  <small class="text-muted">Imagens do Produto</small>
              </div>
            </div>

            <div class="card">
              <h5 class="card-header"><?php echo $value->Nome;?></h5>
              <div class="card-body">
                <h5 class="card-title">R$ <?php echo $value->Preco;?>
                  <br>
                  <a id="retornoFrete">
                    <!-- retorno do calculo de frete -->
                  </a>
                </h5>
                <p class="card-text">
                  <?php echo $value->Descricao;?>
                </p>
                <?php if ($value->Status != "Disponivel") {
                  echo "<a href='#' class='btn btn-danger'>Indisponivel</a>";
                }else{
                  echo "<a href='Cad_Pedido.php' class='btn btn-danger'>Alugue já !</a>";
                }?>
                <br>
                <br>
                <button type='button' carrinho='btn_add_carrinho' value='<?php echo $value->CodEquipamento;?>' class='btn btn-warning btn-sm'>
                  Adicionar ao carrinho
                </button>
              </div>
              <hr>
              <center>
              <h5 class="card-header">
                <div class="col-md-8 col-sm-8 ">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Calcular Frete</label>
                    <input type="text" class="form-control" id="cep" placeholder="Digite seu CEP" maxlength="10" onkeydown="javascript: fMasc(this, mCEP)">
                    <small class="form-text text-muted">
                      <a href="http://www.consultaenderecos.com.br/busca-endereco" target="_blank">Não sei meu CEP</a>
                    </small>
                  </div>
                </div>
                <button onclick="calculo();" class="btn btn-primary">Calcular</button>
              </h5>
              </center>  
            </div>   
        </div>
    </div>
  </div>
</section>

<section class="features-icons bg-light text-center espaco" >
<h3>Recomendados</h3>
  <hr>
  <div class="container-fluid">
    <div class="row">
      <div class="card-deck">
        <?php foreach($equi->ConsultarDiferente($value->CodEquipamento) as $valor): ?>
          <div class="col-md-4">
            <div class="card" style="height: 40rem;">
              <img class="card-img-top" src="img/Produtos/<?php echo $valor->Imagem;?>"alt="Imagem de capa do card">
              <div class="card-body">
                <h5 class="card-title"><?php echo $valor->Nome;?></h5>
                <p class="card-text"><?php echo $valor->Descricao;?></p>
              </div>
              <div class="card-footer">
                <a href="Pag_Equipamento.php?CodEquipamento=<?php echo $valor->CodEquipamento;?>" class="btn btn-primary btn-sm" tabindex="-1" role="button">Conferir</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
  <?php include_once("menu/menu-inferior.php");?>
</body>
</html>
<?php 
endif;
  else:
    echo "<h1>Página não encontrada</h1>";
    include_once("erro.php");
  endif;
?>


 