/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    
    $(".list-group-item").click(function(){
    
        var id  = $(this).attr("value");
        
        $("#desafiadoID").val(id);
        
    });
    
    
    
});
