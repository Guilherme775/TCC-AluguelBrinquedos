<?php 
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

  <title>Pedido - Aluguel de Briquedos</title>
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
    <!-- Mascaras -->
    <script src="../js/validador.js"></script>
</head>
<body class="bg-light">
    

  <?php include_once("menu/menu-superior.php"); ?>

<center>
<div class="container"><br></div>
<div class="container">
  <h2>Solicitar Aluguel</h2>
</div>
<hr>
<div class="container">
  <form name="form_cad_cliente_pedido" method="POST">    
    
  <section id="pessoais" class="col-md-6 col-sm-6">

<h3>Informações Pessoais</h3>

<div>&nbsp;</div>
<label for="Text" class="text-rigth">Nome <span>*</span></label>
<input type="text" class="form-control" name="txtnome" id="txtnome" placeholder="Digite seu Nome" maxlength="50">

<div>&nbsp;</div>
<label for="Text">Telefone <span>(Opcional)</span></label>
<input type="tell" class="form-control" name="txttelefone" id="txttelefone" maxlength="13" onkeydown="javascript: fMasc( this, mTel );" placeholder="(11)3333-9999">

<div>&nbsp;</div>
<label for="Text">Celular <span>(Opcional)</span></label>
<input type="tell" class="form-control" name="txtcelular" id="txtcelular" maxlength="14" onkeydown="javascript: fMasc( this, mTel );" placeholder="(11)98888-9999">

<div>&nbsp;</div>
<label for="inputEmail4">Email <span>*</span></label>
<input type="email" class="form-control" name="txtemail" id="txtemail" placeholder="Digite seu Email" >

<div>&nbsp;</div>
<label for="inputCPF">CPF <span>*</span></label>
<input type="text" class="form-control" name="txtcpf" id="txtcpf"maxlength="14" placeholder="Digite seu CPF" onkeydown="javascript: fMasc( this, mCPF );">

<div>&nbsp;</div>
<button type="button" id="proximo" class="btn btn-primary">Proximo</button>

</section>



<section id="montagem" style="display: none" class="col-md-6 col-sm-6">

<h3>Local da Montagem</h3>

<label for="Text"> CEP <span>*</span></label>
<input type="text" class="form-control" name="txtcep" id="txtcep" placeholder="Informe seu CEP" maxlength="10" onkeydown="javascript: fMasc( this, mCEP );">

<label for="Text">Endereço <span>*</span></label>
<input type="text" class="form-control" name="txtendereco" id="txtendereco" placeholder="Rua da Florinda" maxlength="75">

<label for="inputEmail4">Bairro <span>*</span></label>
<input type="text" class="form-control" name="txtbairro" id="txtbairro" placeholder="Vila do chaves" maxlength="30">


<label for="inputCPF">Numero</label> <span>*</span></label>
<input type="number" class="form-control" name="txtnumero" id="txtnumero" placeholder="725" max="10000" min="1" >

<label for="inputEmail4">Complemento <span>(Opcional)</span></label>
<input type="text" class="form-control" name="txtcomplemento" placeholder="Do lado do barril" maxlength="100" >

<div>
&nbsp;
</div>


<button type="button" class="btn btn-primary" id="anterior">Anterior</button>
<button type="button"  class="btn btn-primary" id="proximo">Proximo</button>

</section>

<section id="pedido" style="display: none"> 

<div class="col-md-6 col-sm-6">
<h3>Dados do Pedido</h3>

<label for="Text"> Data de uso <span>*</span></label>
<input type="date" class="form-control" name="txtdataUso" id="txtdataUso" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" min="2019-11-07" max="2022-12-31" >

<label for="Text">Número de horas utilizadas<span>*</span></label>
<input type="number" class="form-control" name="txthorasAlugado" id="txthorasAlugado" max="600" min="1">

<label for="inputEmail4">Horário de Montagem <span>*</span></label>
<input type="time" class="form-control" name="txthoraMontagem" id="txthoraMontagem" >

<label for="Text">Forma de pagamento<span>*</span></label>
<select class="custom-select" name="txtformaPagamento" id="txtformaPagamento" >
<option value="Dinheiro">Dinheiro</option>
<option value="Cartão">Cartão</option>
</select>

<label for="Text">Supervisão<span>*</span></label>
<select class="custom-select" name="txtsupervisao" >
<option value="0">Sem Supervisão</option>
<option value="1">Com Supervisão Acressimo de R$ 50,00</option>
</select>
</div>

    
    <h4>Escolha um Brinquedos</h4>
    <hr>
    <div class="container">
      <div class="row">
        <div class="card-deck">
        <?php 
        if ($certo = $equi->ConsultarEquipamento()) {
          foreach($certo as $value){
        ?>
        <div class="col-md-3" id="card-carrinho">
        <div class="card" style="height: 30rem;">
          <img class="card-img-top" src="img/Produtos/<?php echo $value->Imagem;?>" alt="Imagem Equipamento">
          <div class="card-body">
            <p class="card-title"><?php echo $value->Nome;?></p>
            <?php if ($value->Status != "Disponivel") {
              echo "<span class='badge badge-pill badge-danger'>Indisponivel</span>";
            } else{
              echo "<span class='badge badge-pill badge-success'>Disponivel</span>";
            }?>
            <p>R$ <?php echo $value->Preco?></p>
          </div>
          <div class="card-footer">
            <a href="Pag_Equipamento.php?CodEquipamento=<?php echo $value->CodEquipamento;?>" class="btn btn-primary btn-sm" tabindex="-1" role="button">Ver Mais</a>
            
            <?php if ($value->Status == 'Disponivel') {?>
              <hr>

              <?php if(in_array($value->CodEquipamento, $_SESSION["CodEquipamento"])){?>
                        <button type='button' carrinho='btn_add_carrinho' value='<?php echo $value->CodEquipamento;?>' class='btn btn-success btn-sm'>
                            No carrinho
                        </button>     
              <?php }else{?>
                <button type='button' carrinho='btn_add_carrinho' value='<?php echo $value->CodEquipamento;?>' class='btn btn-warning btn-sm'>
                Adicionar ao carrinho
                  </button>
            <?php }
                }?>
          
            
            </div>
          
        </div>
      </div>
        <?php }
            }else {
              echo '<div class="container">Nenhum registro</div>';
            } ?>
        </div>
      </div>
    </div>
    <div>
    &nbsp;
    </div>
    <button type="button" class="btn btn-primary"  id="anterior">Anterior</button>
    <button type="submit" class="btn btn-danger" id="btn_finalizar">Finalizar Pedido</button>
    </section>
    
  </form>
</div>
</center>  
  <?php include_once("menu/menu-inferior.php"); ?>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
