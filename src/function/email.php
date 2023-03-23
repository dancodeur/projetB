<?php 

function sendEmail($emailContributeur,$admin=false){
   
    if(is_string($emailContributeur)){

       $to=$emailContributeur;
       $subject="Projet scolaire (Bank) Collaboration ";
       $message="Salut, tu t'es inscris en tant que collaborateur pour le project Bank";

       mail($to,$subject,$message);

       if($admin==true){

        $to="elengadan@gmail.com";
        $subject="collaborateur inscrit (Bank)";
        $message="Tu as un nouveau collaborateur ! voici son email: ".$emailContributeur;

        mail($to,$subject,$message);
       }

    }
    
}

function virementEmail($email,$objet,$content){
    
    $to=$email;
    $objet=$objet;
    $message=$content;

    mail($to,$objet,$message);

}

function recupEmail($id){

    if(is_int($id)){

        include("function/db.php");

        $recup_email=$db->prepare("SELECT client_email FROM client WHERE client_id=?");
        $recup_email->execute(array($id));

       $email=$recup_email->fetch()["client_email"];

       return $email;

    }
}
