$(document).ready(function(){

    

    var btn_cad = $('#btn_cadastra_usu')

    var conteudo_modal = $('#modal_usuario').find('.modal-body')

    //carregar o form na modal ao clicar no botao
    btn_cad.click(function(){

        $.post('../controller/usuario.controller.php',
            {acao: 'form_cadastrar_usu'},
            
            
            function(formRetornado){
                $('#modal_usuario').modal({backdrop: true})

                conteudo_modal.html(formRetornado)
            })
    })

    /**CADASTRAR USUARIO*/
    $('#modal_usuario').on('submit','form[name="form_cad_usuario"]', function(){
        var form = $(this)

        var botao = $(this).find(':button')

        $.ajax({
            type: "POST",
            url: "../controller/usuario.controller.php",
            data: "acao=cadastrar_usu&" + form.serialize(),
            beforeSend: function(){
                botao.attr('disabled', true)
            },
            success: function (retorno) {
                console.log(retorno)
                if (retorno == true) {

                    form.fadeOut('fast')

                    $('#modal_usuario').modal('hide')

                    swal({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuário cadastrado !',
                        button: true,
                        timer: 600
                      }) 
                      botao.attr('disabled', false)

                     ConsultarUsuario("../controller/usuario.controller.php", "consultar_usu", true);
                    
                }
                else{
                    swal({
                        title: "Erro ao cadastrar usuário !",
                        text: "já existe um usuario com esse email", 
                        icon: "error",
                    })
                    botao.attr('disabled', false)
                }
            }
        })
        return false
    })

    function ConsultarUsuario(url,acao,atualiza){        
        $.post(
            url,
            {acao: acao},
            function(retorno){

                var tbody = $('#tabela_usuario').find('tbody')
                //var imagem = tbody.find('.load')

                if (retorno == false) {
                    tbody.html('Nenhum registro');
                }
                else if(atualiza == true){
                    tbody.html(retorno);
                }
                else if(retorno != ''){
                    //imagem.fadeOut('fast', function(){
                        tbody.html(retorno)
                    //});
                }                
            }

        )    
    }
    ConsultarUsuario("../controller/usuario.controller.php", "consultar_usu");

    /**BOTAO EDITAR */
    $('#tabela_usuario').on('click', '#btn_editar', function(){
        var CodUsuario = $(this).attr('value')

        $.post(
            '../controller/usuario.controller.php',
            {acao: 'form_editar_usu',
            CodUsuario : CodUsuario},
            function(retornoform){
                $('#modal_usuario').modal({backdrop: true})

                conteudo_modal.html(retornoform);
                var modal_usuario = $('#modal_usuario');
                modal_usuario.find('.modal-title').text('Editar Usuário');

            })
            console.log(CodUsuario);        
    })

    /**BOATO ATUALIZAR */
    $('#modal_usuario').on('submit','form[name="form_editar_usuario"]', function(){
        var form = $(this)
        var btn_atualiza  = form.find('#btn_atualiza');

    

        $.ajax({
            url: '../controller/usuario.controller.php',
            type: 'POST',
            data: 'acao=editar_usu&' + form.serialize(),
            beforeSend: function(){
                btn_atualiza.attr('disabled', true)
            },
            success: function(retorno){
                console.log(retorno)
                
                if (retorno == 1) {//1 = true
                    form.fadeOut('fast')

                    $('#modal_usuario').modal('hide')
                            
                    swal({
                        title: 'Atualizado com sucesso !',
                        icon: 'success',
                        timer: 600
                    })
                    ConsultarUsuario('../controller/usuario.controller.php','consultar_usu',true)
                                       
                }
                else{
                    swal({
                        title: 'Você não alterou nenhum dado !',
                        icon: 'info',
                        timer: 600
                    })
                    btn_atualiza.attr('disabled',false)
                }
            }
        })
        return false
    })


    /**EXCLUIR */
    $('#tabela_usuario').on('click', '#btn_excluir', function(){
        var CodUsuario = $(this).attr('value')

        if (
            swal({
                title: "Você tem certeza ?",
                text: "Está ação ira deletar todos os dados desse usuário",
                icon: "warning",
                buttons: ['Cancelar','Continuar'],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    /*Passar o cod para o metodo deletar*/
                    $.post("../controller/usuario.controller.php",
                        {acao: 'excluir_usu', 
                        CodUsuario: CodUsuario}, 
                        function(retorno){//retorna se deu certo ou nao
                            console.log(retorno);
                            
                            if (retorno == true) {//1=TRUE
                                
                                swal({
                                    title: "Deletado com sucesso !", 
                                    icon: "success",
                                    timer: 600
                                })
                                //atualiza a tabela
                                ConsultarUsuario('../controller/usuario.controller.php','consultar_usu',true)

                            } else {
                                //se deu algo errado ao deletar
                                swal({
                                    title: "Erro ao deletar usuário !", 
                                    icon: "error",
                                })
                            }

                        })
                } 
                else {
                    //cancelar a ação
                    swal({
                        title: "Essa ação foi cancelada !",
                        icon: "info"
                    })
                }
            })
            ){

        }else{
            return false; //se deu muitaaaa merda e tudo deu errado
            console.log('Deu muito ruim ao deletar');
        }
    })


 
    /**LOGIN */
    $('form[name="form_login"]').submit(function(){

        var form = $(this)
        var botao = $(this).find('#btn_login')

        $.ajax({
            url: "../controller/usuario.controller.php",
            type: "POST",
            data: "acao=login&" + form.serialize(),
            beforeSend: function(){

            },
            success: function(retorno) {
                console.log(retorno);

                if (retorno == 'login') {
                    

                    form.fadeOut('fast',function(){
                        swal({
                            title: "Login realizado com sucesso !",
                            icon: "success",
                            timer: 1000
                        })

                        $('#load').fadeIn('slow') //mostrar                     
                        
                    })//ocultar

                    setTimeout(function(){
                        $(location).attr('href','admin.php')
                    }, 3000) 
                }
                else if(retorno == 'tentativas'){
                    swal({
                        title: "Muitas tentativas !",
                        icon: "error"
                    })

                    setTimeout(function(){
                        $(location).attr('href','login.php')
                    }, 1000)
                    //só para atualizar a pagina, aparecer o form de verificação
                }
                else if (retorno == 'vazio') {
                    swal({
                        title: "Verifique se todos campos estão preenchido corretamente!",
                        icon: "info"
                    })
                }
                else if (retorno == 'naolocalizado') {
                    swal({
                        title: "Usuário não localizado !",
                        icon: "info"
                    })
                }
                else if (retorno == 'senha') {
                    swal({
                        title: "Está senha não corresponde a esse usuário !",
                        icon: "info"
                    })
                }
                else if (retorno == 'nivel') {
                    swal({
                        title: "Você não tem permissão para continuar !",
                        icon: "info"
                    })
                }
            }
        })
        return false
    })

    $('form[name="form_verificar"]').submit(function(){
        var form = $(this)
        
        $.ajax({
            url: "../controller/usuario.controller.php",
            type: "POST",
            data: "acao=verificar&" + form.serialize(),
            beforeSend: function(){

            },
            success: function(retorno){
                console.log(retorno);

                if (retorno == 'errado') {
                    swal({
                        title: "Resposta errada tente novamente !",
                        icon: "error"
                    })
                    setTimeout(function(){
                        $(location).attr('href','login.php')
                    }, 500)
                }else{
                    swal({
                        title: "Resposta Certa !",
                        icon: "success"
                    })

                    setTimeout(function(){
                        $(location).attr('href','login.php')
                    }, 500)
                }
                
            }
        })

        return false;
    })
    var form_conf = $('#form_confrimar_cod')
    /**RECUPERAR SENHA */
    $('form[name="form_recuperar_senha"]').submit(function(){
        var botao = $(this).find('#btn_enviar')
        var form = $(this)
        
        $.ajax({
            url: "../controller/usuario.controller.php",
            type: "POST",
            data: "acao=recuperar_senha&" + form.serialize(),
            beforeSend: function(){

            },
            success: function(retorno){
                console.log(retorno);

                botao.text('Reenviar')

                form_conf.fadeIn('fast')
                
            }
        

        })


        return false
    })

    $('form[id="form_confrimar_cod"]').submit(function(){
        var form = $(this)

        $.ajax({
            url: "../controller/usuario.controller.php",
            type: "POST",
            data: "acao=confrimar_cod&" + form.serialize(),
            beforeSend: function(){

            },
            success: function(retorno){
                console.log(retorno);

                if (retorno == 'comfirmado') {
                    swal({
                        title: "Codigo de verificação comfirmado !",
                        icon: "success"
                    })

                    //redireciona para alterar a senha
                    setTimeout(function(){
                        $(location).attr('href','alt_senha.php')
                    }, 500)
                } else {
                    swal({
                        title: "Codigo de verificação incompatível !",
                        icon: "error"
                    })
                }

                
                
            }
        

        })

        return false

    })

})