<?php

function Addmessage($id,$content,$objet="Demande Client"){

    if(is_int($id) && is_string($content)){
        
        $id_client=$id;
        $content_message=$content;
        $message_objet=$objet;
        $time=date('H:i:s');
        $date=date('Y-m-d');

        include("function/db.php");

        $notif=$db->prepare("INSERT INTO message(message_objet,message_content,message_client_id,message_time,message_date) VALUES(?,?,?,?,?)");
        $notif->execute(array($message_objet,$content_message,$id_client,$time,$date));

        if($notif->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

}



//Affiché les notifications

function ViewMessage($id){

        include("function/db.php");

        $ListMessage=$db->prepare("SELECT * FROM message WHERE message_client_id=? ORDER BY message_id DESC");
        $ListMessage->execute(array($id));

        if($ListMessage->rowCount()>0){

            return $ListMessage;
        }else{
            return false;
        }

}

function ViewMessageConseiller($id_conseiller,$id_client){

    include("function/db.php");

    $ListMessage=$db->prepare("SELECT * FROM message_cons WHERE message_cons_id=? AND message_client_id=? ORDER BY message_id DESC");
    $ListMessage->execute(array($id_conseiller,$id_client));

    if($ListMessage->rowCount()>0){

        return $ListMessage;
    }else{
        return false;
    }

}

//effacé la notification

function message_delete($id,$reçu=false){
    
    include("function/db.php");

    if($reçu==true){
    
        $delete=$db->prepare("DELETE FROM message_cons WHERE message_client_id=?");
        $delete->execute(array($id));
    
        if($delete->rowCount()>0){
    
            header("location:messagerie_recu.php");
        }

    }else{
        
        $delete=$db->prepare("DELETE FROM message WHERE message_id=?");
        $delete->execute(array($id));
    
        if($delete->rowCount()>0){
    
            header("location:messagerie.php");
        }

    }
    
    


}


//compte nombre de message

function Nbre_message($id){

    include("function/db.php");

    $Nb_message=$db->prepare("SELECT COUNT(*) AS 'Nombre_message' FROM message WHERE message_client_id=?");
    $Nb_message->execute(array($id));

    $message_nbr=$Nb_message->fetch()["Nombre_message"];
    
    return $message_nbr;
}

function Nbre_message_recu($id){

    include("function/db.php");

    $Nb_message=$db->prepare("SELECT COUNT(*) AS 'Nombre_message' FROM message_cons WHERE message_cons_id=?");
    $Nb_message->execute(array($id));

    $message_nbr=$Nb_message->fetch()["Nombre_message"];
    
    return $message_nbr;
}

