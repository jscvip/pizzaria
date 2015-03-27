$(document).ready(function(){
    var busca = $("#txt_busca"),
        carregar = $("#carregar_busca"),
        form_busca = $("#form_busca");
    busca.keyup(function() {
        if(busca.val() == ""){
            //carrega a pagina inicial
            carregar.load("telas/dashboard.php");
        }else{
            $.ajax({
                type: "post",
                url: "telas/buscar.php",
                data: form_busca.serialize(),
                success: function(data){
                    carregar.html(data);
                }
            })
        }
    });

    $("input[type=radio][name=tipo_metas]").click(function(){
        var escolhido = $(this).val();

        $.ajax({
            type: "post",
            data: "escolhido="+escolhido,
            url: "telas/cadastrar/metasResposta.php",
            success: function(resposta){
                $("#resposta").html(resposta);
            }
        });
    });

    $("select[name=categ]").change(function(){
        var escolhido = $(this).val();
        $.ajax({
            type: "post",
            data: "escolhido="+escolhido,
            url: "telas/cadastrar/pegar-pizza.php",
            success: function(resposta){
                $("#resposta").html(resposta);
            }
        });
    });

    $('#confirmDelete').on('show.bs.modal', function (e) {

        var data = $(e.relatedTarget);
        var message = data.data('message');
        $(this).find('.modal-body p').text(message);
        var title = data.data('title');
        $(this).find('.modal-title').text(title);

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
    });

    <!-- Form confirm (yes/ok) handler, submits form -->
    $('#confirmDelete').find('.modal-footer #confirm').on('click', function () {
        $(this).data('form').submit();
    });



});