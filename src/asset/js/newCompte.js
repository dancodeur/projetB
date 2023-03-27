//alert("Hello");

/*
function Validation(){

    let nom=document.forms["ValidationJS"]["nom"].value;
    let prenom=document.forms["ValidationJS"]["prenom"].value;
    let email=document.forms["ValidationJS"]["email"].value;
    let tel=document.forms["ValidationJS"]["tel"].value;
    let ville=document.forms["ValidationJS"]["ville"].value;
    let code_postal=document.forms["ValidationJS"]["code_postal"].value;

    alert(nom);

    if(nom.length<2 &&  typeof(nom) !="string"){
        
        document.getElementById("nomJs").innerHTML="Ce nom n'est pas valide";
        document.getElementById("nomJs").style.color="red";
        return false;
    }


    if(prenom.length<2 && typeof(nom) !="string"){
        
        document.getElementById("prenomJs").innerHTML="Ce prénom n'est pas valide";
        document.getElementById("prenomJs").style.color="red";
        return false;
    }

    
    if(typeof(tel)!="number" && !tel.startsWith("0033") || !tel.startsWith("+33") || !tel.startsWith("06") || !tel.startsWith("07")){
        
        document.getElementById("telJs").innerHTML="Ce numéro de téléphone n'est pas valide";
        document.getElementById("telJs").style.color="red";
        return false;
    }

    if(tel.length>=10 && tel.length<=13){
        
        document.getElementById("telJs").innerHTML="Ce numéro de téléphone n'est pas valide";
        document.getElementById("telJs").style.color="red";
        return false;
    }

    if(typeof(ville)!="string" && ville.length<3){

        document.getElementById("villeJs").innerHTML="Ce nom de ville n'est pas valide";
        document.getElementById("villeJs").style.color="red";
        return false;
    }

    if(typeof(code_postal)!="number" && code_postal.length<4){
        
        document.getElementById("code_postalJs").innerHTML="Ce code postal n'est pas valide";
        document.getElementById("code_postalJs").style.color="red";
        return false;
    }

    if(email.startsWith(typeof(email)=="number") || email.endsWith(typeof(email)=="number") || email.includes(",")){
        
        document.getElementById("emailJs").innerHTML="Cette adresse éléctornique n'est pas valide";
        document.getElementById("emailJs").style.color="red";
        return false;
    }

   
}

*/


