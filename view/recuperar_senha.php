<!-- vai estar na pagina de admin -->
<?php 
include_once('../controller/usuario.controller.php');

// echo "<pre>";
// print_r($_SESSION['administrador']);
// echo "</pre>";
// echo "<br> <br>";
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Area Restrita</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Jquery -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <!-- Ajax -->
    <script src="../ajax/usuario.ajax.js"></script>
    <!-- Alertas Bonitinhos -->
    <script src="../js/sweetalert.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
  </head>
  <body>

  <div class="container">
  <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          

        <h5 class="card-title text-center">Recuperação de senha</h5>
          <form name="form_recuperar_senha" method="POST" class="form-signin">
            <div class="form-label-group">
              <label for="inputEmail">Digite seu email</label>
                <input type="email" name="txtemail" class="form-control" placeholder="rodolfo@gmail.com" required autofocus>
            </div>
            <br>
            <div class="form-label-group text-center">
              <button type="submit"  id="btn_enviar" class="btn btn-primary">Enviar</button>
            </div>

            <a href="login.php">Voltar</a>
          </form>

          <form id="form_confrimar_cod" method="POST" style="display: none">
            <input type="number" name="txtcod">

            <button type="submit">Comfirmar</button>
          </form>




        </div>
      </div>
    </div>
  </div>
  </body>
</html>