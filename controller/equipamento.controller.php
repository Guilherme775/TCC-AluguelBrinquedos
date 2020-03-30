<?php 
/*tudo relacionado aos equipamentos
cadastro 
update
delete
*/
include_once('../model/equipamento.php');

$equi = new Equipamento();/*Instancia do objeto da classe para poder usar as funçoes da classe*/

$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);

//verificaçao de campo vazio
if (isset($_REQUEST['acao'])) 
{

    switch ($_REQUEST['acao']) 
    {
        case 'value':
            # code...
            break;

    case 'cadastrar_equi':
        $equi->Nome = filter_input(INPUT_POST, 'txtnomeEquipamento', FILTER_SANITIZE_STRING);
        $equi->Descricao = filter_input(INPUT_POST, 'txtdescricao', FILTER_SANITIZE_STRING); 
        $equi->Preco = filter_input(INPUT_POST, 'txtpreco', FILTER_SANITIZE_STRING);//DOUBLE
        $equi->Peso = filter_input(INPUT_POST, 'txtpeso', FILTER_SANITIZE_STRING);
        $equi->Altura = filter_input(INPUT_POST, 'txtaltura', FILTER_SANITIZE_STRING);
        $equi->Comprimento = filter_input(INPUT_POST, 'txtcomprimento', FILTER_SANITIZE_STRING);
        $equi->Largura = filter_input(INPUT_POST, 'txtlargura', FILTER_SANITIZE_STRING);
        $equi->Status = "Disponivel";

        $formatosPermitidos = array("png", "jpeg", "jpg");
        $extensao = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        //verificar se a extensao existe no array
        if (in_array($extensao , $formatosPermitidos)) {
            $pasta = "img/Produtos/";
            $temporario = $_FILES['img']['tmp_name'];
            $novo_nome = uniqid().".$extensao";
            
            
            //upload 
            if (move_uploaded_file($temporario ,$pasta.$novo_nome)) {
                //deu certo
                $equi->Imagem = $novo_nome;
                if($equi->CadastrarEquipamento()){
                    echo "<body onload='certo()'>";
                }
                else{
                    echo "<body onload='erro()'>";
                }
                
            }else {
                echo "<body onload='erroImagem()'>";
            }   
        }
        
        ?>
        <script>
            function certo(){
                swal({
                position: 'top-end',
                icon: 'success',
                title: 'Equipamento cadastrado !',
                button: true,
                timer: 900
                })
                setTimeout(function(){
                        $(location).attr('href','admin.php')
                    }, 1000)
            }
            function erro(){
                swal({
                title: "Erro ao cadastrar equipamento !", 
                icon: "error",
                })
            }
            function erroImagem(){
                swal({
                position: 'top-end',
                icon: 'error',
                title: 'Erro ao upar imagem !'
                })
            }
        </script>
        <?php
    break;

    case 'editar_equi':

        $equi->CodEquipamento = filter_input(INPUT_POST, 'CodEquipamento', FILTER_SANITIZE_NUMBER_INT);
        $equi->Nome = filter_input(INPUT_POST, 'txtnomeEquipamento', FILTER_SANITIZE_STRING);
        $equi->Descricao = filter_input(INPUT_POST, 'txtdescricao', FILTER_SANITIZE_STRING); 
        $equi->Preco = filter_input(INPUT_POST, 'txtpreco', FILTER_SANITIZE_STRING);//DOUBLE
        $equi->Peso = filter_input(INPUT_POST, 'txtpeso', FILTER_SANITIZE_STRING);
        $equi->Altura = filter_input(INPUT_POST, 'txtaltura', FILTER_SANITIZE_STRING);
        $equi->Comprimento = filter_input(INPUT_POST, 'txtcomprimento', FILTER_SANITIZE_STRING);
        $equi->Largura = filter_input(INPUT_POST, 'txtlargura', FILTER_SANITIZE_STRING);

        
            
        $formatosPermitidos = array("png", "jpeg", "jpg");
        $extensao = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        //verificar se a extensao existe no array
        if (in_array($extensao , $formatosPermitidos)) {
            $pasta = "img/Produtos/";
            $temporario = $_FILES['img']['tmp_name'];
            $novo_nome = uniqid().".$extensao";
            $equi->Imagem = $novo_nome;

            //upload 
            if (move_uploaded_file($temporario ,$pasta.$novo_nome)) {
                //deu certo
                $equi->Imagem = $novo_nome;
                if ($equi->AtualizarEquipamento()) {
                    echo "<body onload='certo()'>";
                }
                else{
                    echo "<body onload='erro()'>";
                }
            }
            else {
                echo "<body onload='erroImagem()'>";
            }
        }
        
        
        
        ?>
        <script>
            function certo(){
                swal({
                        title: 'Atualizado com sucesso !',
                        icon: 'success'
                    })
                setTimeout(function(){
                        $(location).attr('href','admin.php')
                    }, 1000)
            }
            function erro(){
                swal({
                        title: 'Você não alterou nenhum dado !',
                        icon: 'info'
                    })
            }
            function erroImagem(){
                swal({
                position: 'top-end',
                icon: 'error',
                title: 'Erro ao upar imagem !'
                })
            }
        </script>
        <?php
        break;
    }
}

switch ($acao) {

        case 'form_cadastrar_equi':

            ?>
            
            <form action="?acao=cadastrar_equi" enctype="multipart/form-data" method="post" id="form_equi" class="form" name="form_cad_equipamento" >
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" name="txtnomeEquipamento" class="form-control" aria-describedby="emailHelp" placeholder="Nome Equipamento" >             
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Descrição</label>
                    <input type="text" name="txtdescricao" class="form-control" placeholder="Descrição" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Peso(KG)</label>
                    <input type="number" step="0.01" name="txtpeso" class="form-control" placeholder="Peso" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Altura(CM)</label>
                    <input type="number" name="txtaltura" class="form-control" placeholder="Altura" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Comprimento(CM)</label>
                    <input type="number" name="txtcomprimento" class="form-control" placeholder="Comprimento" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Largura(CM)</label>
                    <input type="number" name="txtlargura" class="form-control" placeholder="Largura">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Preço</label>
                    <input type="number" step="0.01" name="txtpreco" class="form-control" placeholder="Preço" >
                </div>

                <input type="file" name="img" id="imagem">
                
                <button type="submit" class="btn btn-dark">Cadastrar Equipamento</button>
                </form>
                
            <?php
            break;

        case 'form_editar_equi':/*Formulario Preenchido com os dados para EDIÇÂO*/

            $CodEquipamento = filter_input(INPUT_POST, 'CodEquipamento', FILTER_SANITIZE_NUMBER_INT);

            $dados = $equi->RetornarDadosObj($CodEquipamento);//pegando o retorno do metodo e colocando na variavel $equi
            
            /*FORM Q VAI DENTRO DA MODAL*/
            ?>

            <form action="?acao=editar_equi" enctype="multipart/form-data" method="post" class="form" name="form_editar_equipamento">
                <div class="form-group">
                
                    <input type="hidden" name="CodEquipamento" value="<?php echo $dados->CodEquipamento; ?>">
                
                </div> 
                <div class="form-group">
                  
                <label for="exampleInputEmail1">Nome</label> 
                    <input type="text" name="txtnomeEquipamento"  class="form-control" value="<?php echo $dados->Nome;?>">
                    
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Descrição</label>
                
                    <input type="text" name="txtdescricao"  class="form-control" value="<?php echo $dados->Descricao;?>">
                    
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Peso(KG)</label>
                
                    <input type="number" step="0.01"  class="form-control" name="txtpeso" value="<?php echo $dados->Peso;?>">
                    
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Altura(CM)</label>
                
                    <input type="number" name="txtaltura"  class="form-control" value="<?php echo $dados->Altura;?>">
                    
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Comprimento(CM)</label>
                
                    <input type="number" name="txtcomprimento"  class="form-control" value="<?php echo $dados->Comprimento;?>">
                    
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Largura(CM)</label>
                    <input type="number" name="txtlargura"  class="form-control" value="<?php echo $dados->Largura;?>">
                    
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Preço</label>
                    <input type="number" step="0.01" name="txtpreco"  class="form-control" value="<?php echo $dados->Preco;?>">
                </div>
                <div class="form-group">
                    <input type="file" name="img" id="imagem">
                </div>

                    <button type="submit" id="btn_atualiza " class="btn btn-dark" >
                        Atualizar Equipamento 
                    </button>
                </form>

            <?php
            break;

        case 'excluir_equi':
            $CodEquipamento = filter_input(INPUT_POST, 'CodEquipamento', FILTER_SANITIZE_NUMBER_INT);
            //$dados = $equi->RetornarDados($CodEquipamento);
            if($equi->ExcluirEquipamento($CodEquipamento)){
                echo 'deletou';
            }
            //unlink("img/Produtos/$dados->Imagem");
            //falta excluir a imagem ao deletar
            break;
    }

?>