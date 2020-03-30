<?php 
//pagina do admin colsultar editar e atualizar os pedidos 
include_once('../controller/pedido.controller.php'); 
?>
<html lang="en">
  <head>
    <title>Pedido e dados do cliente</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <!-- Jquery -->
    <!-- Ajax -->
    <script src="../ajax/pedido.ajax.js"></script>
    <!-- Alertas Bonitinhos -->
    <script src="../js/sweetalert.js"></script>
    <!-- emojis -->
    <link href="css/emoji-css.css" rel="stylesheet">
    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  </head>
<body>
<div class="">
  <div class="container-fluid">
    <h2 class="linha">
      Pedidos 
      <span class="badge badge-success">
        <?php echo count($ped->ConsultarPedido());?>
      </span>
    </h2>
    <div class="box">
      <div class="box-content nopadding">
        <table id="tabela_pedido" class="table display text-center">
          <thead>
            <tr>
              <th>Status/Data de envio</th>
              <th>Nome do Cliente</th>
              <th>CPF Do Cliente</th>
              <th>Data de Utilização</th>
              <th>Endereço</th>
              <th>Horario da Montagem</th>
              <th>Forma de Pagamento</th>
              <th>Supervisao</th>
              <th>Preco total</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
              <?php
              if($certo = $ped->ConsultarPedido()){
                foreach($certo as $value):
              ?>
              <tr>
                  <td>
                    <?php 
                    $status = $value->Status;
                    if ($status == 'Pendente') {?>
                      <button type="button" id="btn_status" value="<?php echo $value->CodPedido; ?>" class="btn btn-success">
                        <?php echo $status;?>
                      </button>
                    <?php
                      $data = $value->DataPedido;
                      $date = new DateTime($data);
                      echo $date->format('d/m/Y H:i');
                    }
                    else{
                      echo "<button type='button' id='btn_status' value='$value->CodPedido' class='btn btn-danger'>
                              $status
                            </button>";
                      $data = $value->DataPedido;
                      $date = new DateTime($data);
                      echo $date->format('d/m/Y H:i');
                    }
                    ?>
                  </td>

                  <td><?php echo $value->Nome;?></td>

                  <td>
                    <?php //CPF
                      $nbr_cpf = $value->CPF;
                      $parte_um     = substr($nbr_cpf, 0, 3);
                      $parte_dois   = substr($nbr_cpf, 3, 3);
                      $parte_tres   = substr($nbr_cpf, 6, 3);
                      $parte_quatro = substr($nbr_cpf, 9, 2);
                      echo $monta_cpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";
                    ?>
                  </td>

                  <td>
                    <?php //data do pedido
                    $data = $value->Data_de_uso;
                    $date = new DateTime($data);
                    echo $date->format('d/m/Y');
                    ?>
                  </td>

                  <td>
                    <?php //endereço do cliente
                      $nbr_cep = $value->CEP;
                      $um     = substr($nbr_cep, 0, 2);
                      $dois   = substr($nbr_cep, 3, 3);
                      $tres   = substr($nbr_cep, 6, 3);
                      $monta_cep = "$um.$dois-$tres";
                      echo "$value->Endereco, $value->Bairro, Número: $value->Numero CEP: $monta_cep ";
                    ?>
                  </td>

                  <td><?php echo $value->Hora_Montagem;?></td>

                  <td><?php echo $value->FormaPagamento;?></td>

                  <td>
                  <?php 
                  $CodPedido = $value->CodPedido;
                  $bla = $ped->RetornarPrecoItem($CodPedido);
                  if($value->Supervisao == 0){
                  echo '<i class="em em-heavy_multiplication_x" aria-role="presentation" aria-label="HEAVY MULTIPLICATION X"></i>';
                  $PrecoTotal = $value->Frete + $bla[0]->Preco;
                  }
                  else{
                  echo '<i class="em em-heavy_check_mark" aria-role="presentation" aria-label="HEAVY CHECK MARK"></i>';
                  $PrecoTotal = $value->Frete + 50.00 + $bla[0]->Preco;
                  }
                  ?>
                  </td>
                  <td><?php echo "R$: ".$PrecoTotal;?></td>
                  <td>  
                  <button type="button" id="btn_ver_mais" value="<?php echo $value->CodPedido; ?>" class="btn btn-outline-info">
                  Mais
                  </button> 
                  <!-- <button type="button" id="btn_editar" value="<?php echo $value->CodPedido; ?>"class="btn btn-outline-success">
                  <i class="em em-pencil"></i>
                  </button> polpar trabalho -->

                  <button type="button" id="btn_excluir" value="<?php echo $value->CodPedido; ?>" class="btn btn-outline-danger">
                  <i class="em em-x"></i>
                  </button>
                  </td>
                  <?php
                  endforeach;
                  }
                  else{
                  ?>
                  <td colspan="6" align="center"><?php echo "Nenhum registro"; ?></td>
                  <?php
                  }
                  ?>
              </tr>
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal dados pedido -->
<div class="modal fade bd-example-modal-lg" id="modal_itens" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Pedido 
          <?php 
          echo "nº ".$CodPedido."<br>";
            $data = $value->DataPedido;
            $date = new DateTime($data);
            echo $date->format('d/m/Y H:i');
          ?>
        </h5>
        <button type="button" class="close" data-dimiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>

<!-- modal editar pedido -->
<!-- <div class="modal fade" id="modal_pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Cadastro</h5>
      <button type="button" class="close" data-dimiss="modal" aria-label="Fechar">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body"></div>
  </div>
  </div>
</div>  -->
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/popper.min.js"></script>
    <!-- datatable -->
    <script type="text/javascript" charset="utf8" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#tabela_pedido').dataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            }
        } );
    } );
  </script>
  </body>
</html>