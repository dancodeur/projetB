$(function(){
   
    //toogle de la table compte...
    $("#toogle").click(function(){
        $(".tab").slideToggle();
    })


    $(".option_modale").hide();

    //je recupère la variable id de php en javascript

    $("#option").click(function(){
        $(".option_modale").toggle();
    })

  
});