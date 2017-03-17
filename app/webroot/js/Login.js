/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {

    $("#mensagemTrocaSenha").fadeOut(0);
    $("#loading").fadeOut(0);

    $("#password-btn").click(function() {

        $("#loading").fadeIn(100);
        var email = $("#email").val();

        $.ajax({
            type: "POST",
            data: {
                email: email
            },
            url: "../Login/trocarSenha",
            success: function(result) {
                console.log(result);
                $("#mensagemTrocaSenha").html(result + "<br/><br />");
                $("#mensagemTrocaSenha").fadeIn(100);
                $("#loading").fadeOut(0);

            },
            error: function(XMLHTTRequest, texStatus, errorThrown) {
                alert('erro');
            }
        });

    });

    $("#email").focus(function() {
        $("#mensagemTrocaSenha").fadeOut(0);
    });

});