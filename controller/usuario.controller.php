<?php
/*Tudo relacionado a login e ao usuario*/
include_once('../model/usuario.php');


/*PHPMailer*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../mailer/src/Exception.php';
require '../mailer/src/PHPMailer.php';
require '../mailer/src/SMTP.php';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
/*///////////////////////*/

$usu = new Usuario();/*Instancia do objeto da classe para poder usar as funçoes da classe*/

$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);

switch ($acao) {


    case 'consultar_usu':
        
                    if($certo = $usu->ConsultarUsuario()){
                        foreach($certo as $value):

                    ?>
                        <tr>
                            <td><?php echo $value->CodUsuario;?></td>
                            <td><?php echo $value->Nome;?></td>
                            <td><?php echo $value->Login;?></td>
                            <td><?php echo $value->Email;?></td>
                            <td><?php echo $value->Tipo;?></td>
                            
                            <td>
                            <button type="button" id="btn_editar" value="<?php echo $value->CodUsuario; ?>"class="btn btn-outline-warning">
                                    <i class="em em-pencil"></i>
                                </button>
                                <button type="button" id="btn_excluir" value="<?php echo $value->CodUsuario; ?>" class="btn btn-outline-danger">
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
                <?php
        break;
    
    case 'form_cadastrar_usu':
        ?>
                
        <!-- se for usar alguma mascara tem q abrir o script e colar o codigo aq-->

        <form name="form_cad_usuario" method="POST">
        <div class="form-group">
            <label for="inputEmail3">Nome</label>
            <input type="text" name="txtnome" class="form-control" placeholder="Nome">
            
        </div>
        <div class="form-group">
            <label for="inputEmail3">Nome de Login</label>
            <input type="text" name="txtlogin" class="form-control" placeholder="Login">
            
        </div>
        <div class="form-group">
            <label for="inputEmail3">Email</label>
            <input type="email" name="txtemail" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="inputPassword3">Senha</label>
            <input type="password" name="txtsenha" class="form-control" placeholder="Senha">
        </div>
        <div class="form-group">
            <label for="inputPassword3">Nivel de acesso</label>
            <select class="form-control" name="tipo">
                <option value="">Escolha uma opção</option>
                <option value="Administrador">Administrador</option>
                <option value="Moderador">Moderador</option>
            </select>
        </div>
        <div class="form-group">
            
            <button type="submit" class="btn btn-dark">Cadastrar Usuário</button>
            <img src="../img/load.gif" class="load" alt="Carregando..." style="display: none" />
            
            
        </div>
        </form>
        <div class="retorno"></div>

        <?php
        break;

    case 'cadastrar_usu':

        
        $usu->Nome = filter_input(INPUT_POST, 'txtnome', FILTER_SANITIZE_STRING);
        $usu->Login = filter_input(INPUT_POST, 'txtlogin', FILTER_SANITIZE_STRING);
        $usu->Email = filter_input(INPUT_POST, 'txtemail', FILTER_SANITIZE_EMAIL);
        $usu->Senha = filter_input(INPUT_POST, 'txtsenha', FILTER_SANITIZE_STRING);
        $usu->Tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);

        if ($usu->CadastrarUsuario()) {
            echo true;
        }
        break;

        case 'form_editar_usu':
            $CodUsuario = filter_input(INPUT_POST, 'CodUsuario', FILTER_SANITIZE_NUMBER_INT);

            $dados = $usu->RetornarDadosUsu($CodUsuario);

            ?>
            

            <form action="" name="form_editar_usuario" method="POST">
        <div class="form-group">
            <label for="inputEmail3">Nome</label>
            
            <input type="text" name="txtnome" value="<?php echo $dados->Nome; ?>" class="form-control" placeholder="Nome">
            
        </div>
        <div class="form-group">
            <label for="inputEmail3">Login</label>
            
            <input type="text" name="txtlogin" value="<?php echo $dados->Login; ?>"  class="form-control" placeholder="Login">
            
        </div>
        <div class="form-group">
            <label for="inputEmail3">Email</label>
           
            <input type="email" name="txtemail" value="<?php echo $dados->Email; ?>"  class="form-control" placeholder="Email">
            
        </div>

        <div class="form-group">
            <label for="inputEmail3">Senha</label>
           
            <input type="password" name="txtsenha" value="AluguelBrinquedos"  class="form-control" placeholder="Email">
            
        </div>

        <input type="hidden" name="CodUsuario" value="<?php echo $dados->CodUsuario; ?>"/>
        
        <div class="form-group row">
            <div class="col-sm-10">
            <button id="btn_atualiza" class="btn btn-dark">
            Atualizar
        </button>
            <img src="../img/load.gif" class="load" alt="Carregando..." style="display: none" />
            </div>
        </div>
        </form>
        <div class="retorno"></div>

    <?php

            break;

        case 'editar_usu':

            $usu->CodUsuario = filter_input(INPUT_POST, 'CodUsuario', FILTER_SANITIZE_NUMBER_INT);
            $usu->Nome = filter_input(INPUT_POST, 'txtnome', FILTER_SANITIZE_STRING);
            $usu->Login = filter_input(INPUT_POST, 'txtlogin', FILTER_SANITIZE_STRING);
            $usu->Email = filter_input(INPUT_POST, 'txtemail', FILTER_SANITIZE_EMAIL);
            $usu->Senha = filter_input(INPUT_POST, 'txtsenha', FILTER_SANITIZE_STRING);

            if($usu->AtualizarUsuario()){
                echo true;
            }
            break;

        case 'excluir_usu':

            $usu->CodUsuario = filter_input(INPUT_POST, 'CodUsuario', FILTER_SANITIZE_NUMBER_INT);

            if($usu->ExcluirUsuario())
            {
                echo true;
            }
            break;

        case 'login':

            
            $Login = filter_input(INPUT_POST, 'txtlogin', FILTER_SANITIZE_STRING);    
            $Senha = filter_input(INPUT_POST, 'txtsenha', FILTER_SANITIZE_STRING);


            if($usu->Login($Login,$Senha)){
                session_start();
                $_SESSION['administrador'][] = $usu->RetornoLogin($Login); 
                echo 'login';
            }
            else{
                $dados = $usu->RetornoLogin($Login);
                
                session_start();
                if (!isset($_SESSION['tentativas'])) {                    
                    $_SESSION['tentativas'] = 1;
                }else{
                    $_SESSION['tentativas'] ++;
                }
                if($_SESSION['tentativas'] >= 3){
                    echo "tentativas";
                }
                //echo 'Tentativas: '.$_SESSION['tentativas'] ."  ";

                else if (empty($Login) || empty($Senha)) {//campos vazios
                    echo 'vazio';
                }
                else if (!$dados) {
                    echo "naolocalizado";
                }
                else if ($dados->Senha != sha1(md5(strrev($Senha)))) {
                    echo 'senha'; 
                }
                else if ($dados->Tipo != 'Administrador') {
                    echo "nivel";
                }


            } 
            break;

        case 'sair':
            session_start();
            session_destroy();
            unset($_SESSION['administrador']);
            echo "logoff";
            break;

        case 'verificar':


            $resposta = $_POST['txtresposta'];
            $certa = $_POST['txtcerta'];

            if ($resposta == $certa) {
                echo "certo";
                session_start();
                $_SESSION['tentativas'] = 0 ;
            }else{
                echo "errado";
            }
            break;


        case 'recuperar_senha':

                //Endereço de email q ser enviado
                $email = filter_input(INPUT_POST, 'txtemail', FILTER_SANITIZE_EMAIL);

                //Cod de Verificação
                $cod_recuperacao = rand(22222,99999);
                
             
            
                session_start();

                //Se a sessao nao existir eu crio ela
                if (!isset($_SESSION['cod_verificaco'])) {
                    $_SESSION['cod_verificacao'] = $cod_recuperacao;
                
                }else{
                    //Se ela já existir eu destruo ela
                    unset($_SESSION['cod_verificacao']);    
                }
                
                print_r($_SESSION['cod_verificacao']);
                /*
                echo "<script>
                    alert('Codigo enviado com sucesso! Olhe seu email $cod_recuperacao');
                    window.location='cod_verificacao.php';        
                    </script>";
                    
                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'SMTP.office365.com';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'danielfernandesdk17@outlook.com';                     // SMTP username
                    $mail->Password   = base64_decode('RGFuaWVsT3V0');                               // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                    $mail->Port       = 587;                                    // TCP port to connect to

                    //Recipients
                    $mail->setFrom('danielfernandesdk17@outlook.com', 'Site Notícias');
                    $mail->addAddress($email, 'Senhor Usuario');     // Add a recipient
                    //$mail->addAddress('ellen@example.com');               // Name is optional
                    //$mail->addReplyTo('info@example.com', 'Information');
                    //$mail->addCC('cc@example.com');
                    //$mail->addBCC('bcc@example.com');

                    // Attachments
                    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = "Recuperacao de senha Site Noticias";
                    $mail->Body    = "<h3>Seu codigo de Verificacao: $cod_recuperacao</h3>";
                    $mail->AltBody = 'Texto alternativo';

                    $mail->send();
                    echo "<script>
                    alert('Codigo enviado com sucesso! Olhe seu email');
                    window.location='cod_verificacao.php';        
                    </script>";
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    echo "<script>
                    alert('Deu Ruim');
                    window.location='senha.php';        
                    </script>";
                }*/
        break;

        case 'confrimar_cod':

            $codigo = $_POST['txtcod'];

            session_start();
            
            if ($_SESSION['cod_verificacao'] == $codigo) {
                echo "comfirmado";
                $_SESSION['cod_verificacao'] = 12;
            }else{
                echo "incompatível";
            }
        break;

        case 'alterar_senha':
            
            break;

        case 'contato':

            $Nome		= $_POST["Nome"];	// Pega o valor do campo Nome
            $Fone		= $_POST["Fone"];	// Pega o valor do campo Telefone
            $Email		= $_POST["Email"];	// Pega o valor do campo Email
            $Mensagem	= $_POST["Mensagem"];	// Pega os valores do campo Mensagem
            $Assunto	= $_POST["Assunto"];	// Pega os valores do campo Mensagem
            // Variável que junta os valores acima e monta o corpo do email
            
            $Vai = "Nome: $Nome\n\nE-mail: $Email\n\nTelefone: $Fone\n\nMensagem: $Mensagem\n";
            
            require_once("phpmailer/class.phpmailer.php");
            
            define('GUSER', 'viniciusr0308@gmail.com');	// <-- Insira aqui o seu GMail
            define('GPWD', 'vini@321');		// <-- Insira aqui a senha do seu GMail
            
            
            function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
                global $error;
                $mail = new PHPMailer();
                $mail->IsSMTP();		// Ativar SMTP
                $mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
                $mail->SMTPAuth = true;		// Autenticação ativada
                $mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
                $mail->Host = 'smtp.gmail.com';	// SMTP utilizado
                $mail->Port = 465;  		// A porta 587 deverá estar aberta em seu servidor
                $mail->Username = GUSER;
                $mail->Password = GPWD;
                $mail->From = $de;
                $mail->FromName = $de_nome;
                $mail->Subject = $assunto;
                $mail->Body = $corpo;
                $mail->AddAddress($para);
                if(!$mail->Send()) {
                    $error = 'Mail error: '.$mail->ErrorInfo; 
                    return false;
                } else {
                    $error = 'Mensagem enviada!';
                    return true;
                }
            }
            
            // Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
            //o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.
            
                if (smtpmailer('filipesantossoares2607@gmail.com', 'Pedro', 'Site Aluguel Brinquedos - '.$Assunto, 'assunto', $Vai)) {
            
                Header("location:contato.php"); // Redireciona para uma página de obrigado.
            
            }
            if (!empty($error)) echo $error;

        break;
}
?>