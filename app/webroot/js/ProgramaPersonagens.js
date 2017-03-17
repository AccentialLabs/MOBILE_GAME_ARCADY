/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {

    console.log("document.location.origin: " + document.location.origin);

    $(".selec-personagem").click(function() {

        $("#loading").fadeIn(100);
        var personagem = $(this).val();

        $.ajax({
            type: "POST",
            data: {
                personagem_id: personagem
            },
            url: "../../Programa/decrescePersonagem",
            success: function(result) {
                // alert(result);
                console.log(result);
                $("#loading").fadeOut(0);
                window.location.href = "../rodada";
            },
            error: function(XMLHTTRequest, texStatus, errorThrown) {
                alert('erro');
            }
        });

    });

});


