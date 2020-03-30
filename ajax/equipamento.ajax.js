$(document).ready(function(){

    var conteudo_modal = $('.modal-body')//para injetar conteudo na modal 
    
    var btn_cad = $('#btn_cadastra')

    $('#modal_equipamento').fadeOut('fast')

    /*Cadastrar Equipamento*/

    /*COLOCAR O FORM DE CADASTRO NA MODAL*/
    btn_cad.click(function(){

        $.post('../controller/equipamento.controller.php',
            {acao: 'form_cadastrar_equi'},
            
            function (formRetorno) {
                $('#modal_equipamento').modal({backdrop: true}) //chama a modal

                conteudo_modal.html(formRetorno)
            })
    })
    /*ACAO DOS BOTOES*/
    //pegando o codequipamento da linha da tabela
    

    /*BOTAO EDITAR*/
    //encapsular a tabela, pegar os dados dela 
    $('#tabela_equipamento').on('click', '#btn_editar', function(){
        //Pegar o botao da tabela
        var CodEquipamento = $(this).attr('value')

        //pessar o form preenchido para modal
        $.post(
            '../controller/equipamento.controller.php',
            {acao: 'form_editar_equi',
            CodEquipamento: CodEquipamento}, 
             function(retornarform){
                $('#modal_equipamento').modal({backdrop: true})//para modal nao fechar
                
                //colocando o form dentro da modal
                conteudo_modal.html(retornarform)
                var modal_equipamento = $('#modal_equipamento')
                modal_equipamento.find('.modal-title').text('Editar Equipamento')
             })
        console.log(CodEquipamento);  
    })

    /*BOTAO ATUALIZAR
    PEGAR OS DADOS DO FORM NA MODAL E MANDAR PARA O METODO COM O UPDATE*/
    // $('#modal_equipamento').on('submit', 'form[name="form_editar_equipamento"]', function(){
    //     var form_dados = $(this)//formulario
    //     var btn_atualiza = form_dados.find('#btn_atualiza')

    //     $.ajax({
    //         url: '../controller/equipamento.controller.php',
    //         type: 'POST',
    //         data: 'acao=editar_equi&' + form_dados.serialize(),
    //         beforeSend: function(){
    //             btn_atualiza.attr('disabled',true)
    //         },
    //         success: function(retorno){

    //             console.log(retorno)
                
    //             if (retorno == 'atualizou') {
    //                 form_dados.fadeOut('fast')

    //                 $('#modal_equipamento').modal('hide')
                            
    //                 swal({
    //                     title: 'Atualizado com sucesso !',
    //                     icon: 'success'
    //                 })
    //                 //ConsultarEquipamento('../controller/equipamento.controller.php','consultar_equi',true)                    
    //                 setTimeout(function(){
    //                     $(location).attr('href','admin.equipamento.php')
    //                 }, 1000)
    //             }
    //             else{
    //                 swal({
    //                     title: 'Você não alterou nenhum dado !',
    //                     icon: 'info'
    //                 })
    //                 btn_atualiza.attr('disabled',false)
    //             }
    //         }
    //     })
    //     return false //para nao atualizar a pagina
    // })
    
    /*BOTAO EXCLUIR*/
    $('#tabela_equipamento').on('click', '#btn_excluir', function(){
        var CodEquipamento = $(this).attr('value')
        
        if(/*Confirmação*/
            swal({
                title: "Você tem certeza ?",
                text: "Está ação ira deletar todos os dados desse equipamento",
                icon: "warning",
                buttons: ['Cancelar','Continuar'],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    /*Passar o codequipamento para o metodo deletar*/
                    $.post("../controller/equipamento.controller.php",
                        {acao: 'excluir_equi', 
                        CodEquipamento: CodEquipamento}, 
                        function(retorno){//retorna se deu certo ou nao
                            
                            if (retorno == 'deletou') {//se deu certo 
                                
                                swal({
                                    title: "Deletado com sucesso !", 
                                    icon: "success",
                                    timer: 700
                                })
                                setTimeout(function(){
                                    $(location).attr('href','admin.php')
                                }, 1000)

                            } else {
                                //se deu algo errado ao deletar
                                swal({
                                    title: "Erro ao deletar equipamento !", 
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

})