/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {

    $(".conquista-desbloqueada").click(function() {
        $(".conquista-desbloqueada").removeClass("col-xs-12");
        $(".conquista-desbloqueada").addClass("col-xs-6");
        $('.conquista-detalhes-corpo').fadeOut(0);

        $(this).removeClass("col-xs-6");
        $(this).addClass("col-xs-12");

        $(this).css("z-index", "9999");
        $(this).css("background", "#ffffff");
        $(this).css("width", "90%");
        $(this).css("position", "fixed");
        $(this).find('.conquista-detalhes-corpo').fadeIn(100);

        $(".conquista-detalhes").fadeOut(0);
        $("#fundo-conquista").fadeIn(300);
    });

    $(".conquista-bloqueada").click(function() {

        $(".conquista-desbloqueada").removeClass("col-xs-12");
        $(".conquista-desbloqueada").addClass("col-xs-6");
        $('.conquista-desbloqueada').removeAttr('style');
        $('.conquista-detalhes-corpo').fadeOut(0);
        $("#fundo-conquista").fadeOut(0);
        $(".conquista-detalhes").fadeIn(100);

    });

    $("#fundo-conquista").click(function() {

        $(".conquista-desbloqueada").removeClass("col-xs-12");
        $(".conquista-desbloqueada").addClass("col-xs-6");
        $('.conquista-desbloqueada').removeAttr('style');
        $('.conquista-detalhes-corpo').fadeOut(0);
        $("#fundo-conquista").fadeOut(0);
        $(".conquista-detalhes").fadeIn(100);
    });

});


