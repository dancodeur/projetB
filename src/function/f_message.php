<?php

function message($id,$id_destinateur,$content,$objet="Demande Client"){

    if(is_int($id) && is_string($content) && is_int($id_destinateur)){
        
        $id_client=$id;
        $id_destinateur=$id_destinateur;
        $content_message=$content;
        $message_objet=$objet;
        $time=date('H:i:s');
        $date=date('Y-m-d');

        include("function/db.php");

        $notif=$db->prepare("INSERT INTO message(message_objet,message_content,message_client_id,message_receiver_id,message_time,message_date) VALUES(?,?,?,?,?,?");
        $notif->execute(array($message_objet,$content_message,$id_client,$id_destinateur,$time,$date));

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

function ViewMessageAdmin($id){

    include("function/db.php");

    $ListMessage=$db->prepare("SELECT * FROM message WHERE message_client_id=? ORDER BY message_id DESC");
    $ListMessage->execute(array($id));

    if($ListMessage->rowCount()>0){

        return $ListMessage;
    }else{
        return false;
    }

}

//effacé la notification

function message_delete($id,){
    
    include("function/db.php");
    
    $delete=$db->prepare("DELETE FROM message WHERE message_id=?");
    $delete->execute(array($id));

    if($delete->rowCount()>0){

        header("location:message.php");
    }


}
