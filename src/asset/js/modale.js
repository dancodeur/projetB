$(function(){
    
    $("#modale").hide();
    $("#modale_code_secret").hide();

    $(".hide_btn").click(function(){
        $("#modale").hide();
        
    });

    $("#open_Modale").click(function(){
        $("#modale").show();
    })

    //Modale transaction : tab_transition.php bouton

    $("#confirm_transaction").click(function(){

        $("#modale").show();
    });


    /**
     * ESPACE RESERVE AU MODALE CODE SECRET
     * 
     */

    $("#modale_suivant_cs").click(function(){

        $("#modale").hide();
        $("#modale_code_secret").show();
    });

    $(".hide_btn2").click(function(){
        $("#modale_code_secret").hide();
        
    });



    
});