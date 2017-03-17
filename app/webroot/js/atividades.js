/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {

    $(".especial-button").click(function() {

        $(".especial-button").removeClass("active");
        var clicadoEm = $(this).val();

        $(".corpo-atividades").fadeOut(0);
        $("#atividades-" + clicadoEm).fadeIn(200);

    });

});

