<?php

function notification($id,$content="Welcome"){

    if(is_int($id) && is_string($content)){
        
        $id_client=$id;
        $content_notif=$content;
        $time=date('H:i:s');
        $date=date('Y-m-d');

        include("function/db.php");

        $notif=$db->prepare("INSERT INTO notification(notification_client_id,notification_content,notification_time,notification_date) VALUES(?,?,?,?)");
        $notif->execute(array($id_client,$content_notif,$time,$date));

        if($notif->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

}

//Affiché les notifications

function ViewNotification($id){

        include("function/db.php");

        $ListNotification=$db->prepare("SELECT * FROM notification WHERE notification_client_id=? ORDER BY notification_id DESC");
        $ListNotification->execute(array($id));

        if($ListNotification->rowCount()>0){

            return $ListNotification;
        }else{
            return false;
        }

}

//effacé la notification

function notification_delete($id,){
    
    include("function/db.php");
    
    $delete=$db->prepare("DELETE FROM notification WHERE notification_id=?");
    $delete->execute(array($id));

    if($delete->rowCount()>0){

        header("location:notification.php");
    }


}
