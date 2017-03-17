$(function() {

    $(".volta-acao").click(function() {
        window.location = '../../Acao/index';
    });

    $(".btn-completo-incompleto").click(function() {

        $(".btn-completo-incompleto").removeClass("active");
        var valor = $(this).val();

        $(".lista-acoes-corpo").fadeOut(0);
        $(".acoes-" + valor).fadeIn(500);

    });


//    $(".acao-respostas").click(function() {
//
//        var resposta = $(this).val();
//        resposta = resposta.split("-");
//
//        console.log(resposta);
//        if (resposta[0] === "ganha") {
//
//            var ponts = 0;
//            if ($("#acaoPontos").val() != '') {
//                ponts = parseInt($("#acaoPontos").val(), 10);
//            }
//            var pontosResposta = parseInt(resposta[1], 10);
//            ponts = (ponts + pontosResposta);
//            $("#acaoPontos").val(ponts);
//        }
//
//    });

});

