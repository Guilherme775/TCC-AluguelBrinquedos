<?php
include_once("../model/pedido.php");
$ped = new Pedido();
//carrinho - se a sessao não exixtir eu crio ela
@session_start();
// session_destroy();
if(!isset($_SESSION["CodEquipamento"]))
{
    $_SESSION["CodEquipamento"] = array();
    $_SESSION["quantidade"] = array();
}

//carrinho
$consulta = $ped->con->prepare("SELECT * FROM Equipamento");
$consulta->execute();

$linhas = $consulta -> rowCount();

foreach($consulta as $mostra):

$produtos;

$produtos[$mostra["CodEquipamento"]]["nomeproduto"] = $mostra["Nome"];
$produtos[$mostra["CodEquipamento"]]["preco"] = $mostra["Preco"];

endforeach;//ainda é o carrinho

$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);

    switch($acao){

        case 'add_carrinho':

            if(!in_array($_POST['CodEquipamento'], $_SESSION["CodEquipamento"])){
                $_SESSION["CodEquipamento"][] = $_POST['CodEquipamento'];
                $_SESSION["quantidade"][] = 1;
                echo 'adicionou'; 
                }
                else
                {
                    echo "repetido";
                }
            break;

            case 'del_carrinho':
                $CodEquipamento = $_POST["CodEquipamento"];
                unset($_SESSION["CodEquipamento"][$CodEquipamento]);
                unset($_SESSION["quantidade"][$CodEquipamento]);
                echo 'deleotu';
            break;


            case 'consultar_carrinho':
                ?>
                <div class="table-responsive-sm">
                <table id="tabela_carrinho" class="table table-sm">
                <thead class="fundo text-white">
                <th>Produto</th>
                <!-- <th>Quantidade</th> -->
                <th>Preço</th>
                <th>Subtotal</th>
                <th>Excluir</th>
                </thead>
                <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION["CodEquipamento"] as $indice => $valor):

                $total += $_SESSION["quantidade"][$indice] * $produtos[$valor]["preco"];
                $_SESSION["total"] = $total;
                $subtotal = $produtos[$valor]["preco"] * $_SESSION["quantidade"][$indice];
                ?>

                <tr>
                <td><?php echo $produtos[$valor]["nomeproduto"];?></td>
                <!-- <td><?php //echo $_SESSION["quantidade"][$indice];?></td> -->
                <td><?php echo number_format($produtos[$valor]["preco"],2,',','.');?></td>
                <td><?php echo number_format($subtotal,2,',','.');?></td>
                <td>
                    <button type="button" id="btn_excluir_carrinho" value="<?php echo $indice;?>" class="btn btn-sm btn-outline-danger">
                        <i class="em em-x"></i>
                    </button>
                </td>
                </tr>

                <?php endforeach; ?>
                </tbody>
                </table>
                <?php echo "<h4>Total: R$ ".number_format($total,2,",",".")."</h4>"; ?>
                </div>
            
            <?php 
                break;
    
        case 'verificar_carrinho':
            if (empty($_SESSION['CodEquipamento'])) {
                echo 'carrinho_vazio';
            }
            else{
                echo 'carrinho_cheio';
            }
        break;

        case 'cadastrar_ped':

            $CodPedido = rand(11111,99999);

            $Nome = filter_input(INPUT_POST, 'txtnome', FILTER_SANITIZE_STRING);
            $Telefone = filter_input(INPUT_POST, 'txttelefone' , FILTER_SANITIZE_STRING);
            $Celular = filter_input(INPUT_POST, 'txtcelular' , FILTER_SANITIZE_STRING);
            $Email = filter_input(INPUT_POST, 'txtemail' , FILTER_SANITIZE_EMAIL);
            $CPF = filter_input(INPUT_POST, 'txtcpf' , FILTER_SANITIZE_STRING);
            $CEP = filter_input(INPUT_POST, 'txtcep' , FILTER_SANITIZE_STRING);
            $Endereco = filter_input(INPUT_POST, 'txtendereco' , FILTER_SANITIZE_STRING);
            $Numero = filter_input(INPUT_POST, 'txtnumero' , FILTER_SANITIZE_STRING);
            $Bairro = filter_input(INPUT_POST, 'txtbairro' , FILTER_SANITIZE_STRING);
            $Complemento = filter_input(INPUT_POST, 'txtcomplemento' , FILTER_SANITIZE_STRING);

            date_default_timezone_set('America/Sao_Paulo');
            $DataPedido = date('Y-m-d H:i:s');
            $Data_de_uso = filter_input(INPUT_POST, 'txtdataUso' , FILTER_SANITIZE_STRING);
            $HorasAlugado = filter_input(INPUT_POST, 'txthorasAlugado' , FILTER_SANITIZE_STRING);
            $Hora_Montagem = filter_input(INPUT_POST, 'txthoraMontagem' , FILTER_SANITIZE_STRING);
            $FormaPagamento = filter_input(INPUT_POST, 'txtformaPagamento' , FILTER_SANITIZE_STRING);
            $Supervisao = filter_input(INPUT_POST, 'txtsupervisao' , FILTER_SANITIZE_NUMBER_INT);

            $cep_origem = "07909065";  
            $cep_destino = $CEP;

            $peso          = 2;
            $valor         = 100;
            $tipo_do_frete = '41106';
            $altura        = 6;
            $largura       = 20;
            $comprimento   = 20;

            $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?";
            $url .= "nCdEmpresa=";
            $url .= "&sDsSenha=";
            $url .= "&sCepOrigem=" . $cep_origem;
            $url .= "&sCepDestino=" . $cep_destino;
            $url .= "&nVlPeso=" . $peso;
            $url .= "&nVlLargura=" . $largura;
            $url .= "&nVlAltura=" . $altura;
            $url .= "&nCdFormato=1";
            $url .= "&nVlComprimento=" . $comprimento;
            $url .= "&sCdMaoProria=n";
            $url .= "&nVlValorDeclarado=" . $valor;
            $url .= "&sCdAvisoRecebimento=n";
            $url .= "&nCdServico=" . $tipo_do_frete;
            $url .= "&nVlDiametro=0";
            $url .= "&StrRetorno=xml";

            $xml = simplexml_load_file($url);

            $frete = $xml->cServico;

            $valor = $frete->Valor;

            function limpaCPF_CEP_TEL($value){
                $value = trim($value);
                $value = str_replace(".", "", $value);
                $value = str_replace(",", "", $value);
                $value = str_replace("-", "", $value);
                $value = str_replace("/", "", $value);
                $value = str_replace("(", "", $value);
                $value = str_replace(")", "", $value);
                return $value;
            }

            $Frete = $valor;
            
            // atribui valor a variavel privat eda class pedido
            $ped->CodPedido = $CodPedido;
            $ped->Nome = $Nome;
            $ped->Telefone = limpaCPF_CEP_TEL($Telefone);
            $ped->Celular = limpaCPF_CEP_TEL($Celular);
            $ped->Email = $Email;
            $ped->CPF = limpaCPF_CEP_TEL($CPF);

            $ped->CEP = limpaCPF_CEP_TEL($CEP);
            $ped->Endereco = $Endereco;
            $ped->Numero = $Numero;
            $ped->Bairro = $Bairro;
            $ped->Complemento = $Complemento;

            $ped->DataPedido = $DataPedido;
            $ped->Data_de_uso = $Data_de_uso;
            $ped->HorasAlugado = $HorasAlugado;            
            $ped->Hora_Montagem = $Hora_Montagem;
            $ped->Frete = $Frete;
            $ped->FormaPagamento = $FormaPagamento;
            $ped->Supervisao = $Supervisao;

            $ped->Status = 'Pendente';

            //cadastrar os brinquedos tambem
            //cadastrar compra retornando o código da compra gerado
            if($ped->CadastrarPedido()){
                //pega os itens do carrinho e cadastra no bd
                foreach ($_SESSION["CodEquipamento"] as $indice => $value){
                    $CodEquipamento = $value;
                    $PrecoEqui = $produtos[$value]["preco"];

                    if($ped->CadastrarItens($CodPedido,$CodEquipamento,$PrecoEqui)){
                        unset($_SESSION["CodEquipamento"]);
                        echo "bla";
                    }
            
                } 
            }
            
        break;

        case 'form_editar_ped':
            $CodPedido = filter_input(INPUT_POST, 'CodPedido', FILTER_SANITIZE_NUMBER_INT);
            $dados = $ped->RetornarDados($CodPedido);

        ?>

            <form method="post" class="form" name="form_editar_pedido">
                <input type="hidden" name="CodPedido" value="<?php echo $dados->CodPedido; ?>">
                Endereço
                <input type="text" name="EnderecoMontagem" value="<?php echo $dados->EnderecoMontagem; ?>">
                Data do Pedido
                <input type="date" name="DataPedido" value="<?php echo $dados->DataPedido; ?>">
                Data de uso
                <input type="date" name="Data_de_uso" value="<?php echo $dados->Data_de_uso ?>">
                Quantidade de horas alugado
                <input type="number" name="HorasAlugado" value="<?php echo $dados->HorasAlugado; ?>">
                Data de montagem
                <input type="date" name="Hora_Montagem" value="<?php echo $dados->Hora_Montagem ?>">
                Preço final
                <input type="number" name="PrecoFinal" value="<?php echo $dados->Frete; ?>">
                Forma de pagamento
                <input type="text" name="FormaPagamento" value="<?php echo $dados->FormaPagamento ?>">

                <button type="submit" id="btn_atualiza">
                    Atualizar pedido
                </button>
            </form>

        <?php
        break;

        case 'editar_ped':

            $ped->CodPedido = filter_input(INPUT_POST, 'CodPedido', FILTER_SANITIZE_NUMBER_INT);
            $ped->DataPedido = filter_input(INPUT_POST, 'DataPedido', FILTER_SANITIZE_STRING);
            $ped->Data_de_uso = filter_input(INPUT_POST, 'Data_de_uso', FILTER_SANITIZE_STRING);
            $ped->HorasAlugado = filter_input(INPUT_POST, 'HorasAlugado', FILTER_SANITIZE_STRING);
            $ped->Hora_Montagem = filter_input(INPUT_POST, 'Hora_Montagem', FILTER_SANITIZE_STRING);
            $ped->Frete = filter_input(INPUT_POST, 'PrecoFinal', FILTER_SANITIZE_STRING);
            $ped->FormaPagamento = filter_input(INPUT_POST, 'FormaPagamento', FILTER_SANITIZE_STRING);

            if($ped->AtualizarPedido()){
                echo 'atualizou';
            }
        break;

        case 'excluir_ped':
            $CodPedido = filter_input(INPUT_POST, 'CodPedido', FILTER_SANITIZE_STRING);

            if($ped->ExcluirPedido($CodPedido)){
                echo 'deletou';
            }
        break;

        case 'status_ped':
            $ped->CodPedido = filter_input(INPUT_POST, 'CodPedido', FILTER_SANITIZE_NUMBER_INT);
            $Status = filter_input(INPUT_POST, 'Status', FILTER_SANITIZE_STRING);

            
            if ($Status == 'Pendente') {
                //echo "Atualiza para Realizado";
                if ($ped->UpdateStatusPedidoRealizado()){
                    echo 'Atualizou';
                }
            }else{
                if ($ped->UpdateStatusPedidoPendente()){
                    echo 'Atualizou';
                }
            }
        break;

        case 'dados_pedido':
            $CodPedido = filter_input(INPUT_POST, 'CodPedido', FILTER_SANITIZE_NUMBER_INT);
            $dados = $ped->ConsultarPedidoEquipamento($CodPedido);?>
            <div class="list-group">
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Dados do cliente:</h5>
                    <small>
                        <?php
                            $data = $dados[0]['DataPedido'];
                            $date = new DateTime($data);
                            echo $date->format('d/m/Y H:i');
                        ?>
                    </small>
                    </div>
                    <p class="mb-1">
                        <p><?php echo $dados[0]['Nome']; ?></p> 

                        <p>
                            <?php 
                                $nbr_cpf = $dados[0]['CPF'];

                                $parte_um     = substr($nbr_cpf, 0, 3);
                                $parte_dois   = substr($nbr_cpf, 3, 3);
                                $parte_tres   = substr($nbr_cpf, 6, 3);
                                $parte_quatro = substr($nbr_cpf, 9, 2);
                                $monta_cpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";
                                echo "CPF: ".$monta_cpf; 
                            ?>
                        </p> 
            <hr>
                        <p><h6>Contato:</h6></p>

                        <p><?php echo "Email: ".$dados[0]['Email']; ?></p> 

                        <p>Telefone:
                            <?php 
                                if ($dados[0]['Telefone'] != '') {
                                    $nbr_tel = $dados[0]['Telefone'];
                                    $um     = substr($nbr_tel, 0, 2);
                                    $dois   = substr($nbr_tel, 2, 4);
                                    $tres   = substr($nbr_tel, 6);
                                    echo $monta_tel = "($um)$dois-$tres";
                                } else {
                                    echo "Sem telefone cadastrado";
                                }
                            ?>
                        </p>
                        <p>Celular: 
                            <?php 
                            if ($dados[0]['Celular'] != '') {
                                $nbr_cel = $dados[0]['Celular'];
                                $celum     = substr($nbr_cel, 0, 2);
                                $celdois   = substr($nbr_cel, 2, 5);
                                $celtres   = substr($nbr_cel, 6);
                                echo $monta_tel = "($celum)$celdois-$celtres";
                            }else{
                                echo "Sem celular cadastrado";
                            }
                            ?>
                        </p>
                    </p>
                </div>
                <div class="list-group-item flex-column">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Endereço</h5>
                    </div>
                    <?php 
                        if ($dados[0]['Complemento'] == ''){
                            $complemento = '';
                        }
                        else{
                            $complemento = "<br> Complemento: ".$dados[0]['Complemento'];
                        }  
                        echo $dados[0]['Endereco']." - ".$dados[0]['Numero'].", ". $dados[0]['Bairro']  . $complemento; ?>
                </div>
                <div class="list-group-item flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Dados do Pedido</h5>
                    </div>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Frete</th>
                                <th>Supervisao</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php //apenas para os dados dos equipamentos
                                $total = 0;
                                foreach($dados AS $valor){
                                $total += $valor["Preco"];
                                ?>
                                <td><?php echo "$valor[Equipamento]";?></td>
                                <td><?php echo "R$ ".$valor['Preco'];?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td></td>

                                <td><?php echo "<h6>R$ ".number_format($total,2,",",".")."</h6>"; ?></td>

                                <td><?php echo "R$ ".$dados[0]["Frete"];?></td>

                                <td>
                                    <?php 
                                        if($dados[0]["Supervisao"] == 0){
                                            echo "R$ 0,00";
                                        }
                                        else{
                                            $total += 50.00;
                                            echo "R$ 50,00";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $TOTAL = $total + $dados[0]["Frete"];
                                        echo "<h4>Total R$".  number_format($TOTAL,2,",",".")."</h4>";
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        break;
    }
?>