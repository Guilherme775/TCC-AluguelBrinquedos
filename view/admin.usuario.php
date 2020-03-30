<!-- vai estar na pagina de admin -->
<?php include_once('../controller/usuario.controller.php'); ?>

<html lang="en">
  <head>
    <title>Cadastrar Usuario</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <!-- Jquery -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <!-- Ajax -->
    <script src="../ajax/usuario.ajax.js"></script>
    <!-- Alertas Bonitinhos -->
    <script src="../js/sweetalert.js"></script>
    <!-- emojis -->
    <link href="css/emoji-css.css" rel="stylesheet">
    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  </head>
  <body>

<div class="row">
    <div class="col-lg-10 ml-auto mt-4">
        <div class="row">   
            <h2 class="linha">Usuários</h2>
            <div class="ml-auto ">
                <button class="btn btn-primary" type="button" id="btn_cadastra_usu">Cadastrar Usuario</button>
            </div>   
        </div>
        <div class="box">
            <div class="box-content nopadding">
                <table id="tabela_usuario" class="table display text-center">
                    <thead>
                        <tr>
                            <th>Cod</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Email</th>
                            <th>Tipo de Conta</th>
                            <th width="200">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>                            
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <!-- Modal -->
<div class="modal fade" id="modal_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                <!--o conteudo q esta na pagina painel.controller.php passa pelo metodo post para o jquery exibindo aq-->
                </div>
        </div>
    </div>
</div>   

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/popper.min.js"></script>
    <!-- datatable -->
    <!-- <script type="text/javascript" charset="utf8" src="../js/jquery.dataTables.min.js"></script>
    <script>
    $('#tabela_usuario').DataTable()
    </script> -->
  </body>
</html>