<?php 



//

function SOLDE_INSUFFISANT($solde,$montant){
    

    if($solde>$montant){
        return false;
    }else{

        return true; #return array...
    }
    

}

//

function MONTANT_SUFFISANT($montant){
    

    if($montant>0){
        return true;
    }else{

        return false; #return array...
    }
    

}


function TRANSACTION($compte_id,$objet,$montant,$solde,$benef){

    

    $solde_update=$solde-$montant;
    $transac_objet=$objet;
    $transac_compte_id=$compte_id; #id du compte client...
    $date=date("Y-m-d");
    $montant=$montant;
    $benef_name=$benef;

    include("function/db.php");

    $compte=$db->prepare("UPDATE compte SET compte_solde=$solde_update WHERE compte_id=?");
    $compte->execute(array($transac_compte_id));

    if($compte->rowCount()>0){

        $transaction_save=$db->prepare("INSERT INTO transaction(transac_compte_id,transac_objet,transac_montant,transac_benef,transac_date) VALUES(?,?,?,?,?)");
        $transaction_save->execute(array($compte_id,$transac_objet,$montant,$benef_name,$date));

        if($transaction_save->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }


}

function TRANSACTION_DEPOT($compte_id,$objet,$montant,$solde){

    

    $solde_update=$solde+$montant;
    $depot_source=$objet;
    $depot_compte_id=$compte_id; #id du compte client...
    $date=date("Y-m-d");
    $montant=$montant;

    include("function/db.php");

    $compte=$db->prepare("UPDATE compte SET compte_solde=$solde_update WHERE compte_id=?");
    $compte->execute(array($depot_compte_id));

    if($compte->rowCount()>0){

        $transaction_save=$db->prepare("INSERT INTO depot(depot_compte_client_id,depot_source_revenu,depot_solde,depot_date) VALUES(?,?,?,?)");
        $transaction_save->execute(array($depot_compte_id,$depot_source,$montant,$date));

        if($transaction_save->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }


}

function GET_SOLDE($id){

    include("function/db.php");
    $solde=$db->prepare("SELECT * FROM compte WHERE compte_id=?");
    $solde->execute(array($id));

    $solde_actuel=$solde->fetch()["compte_solde"];

    return $solde_actuel;
}

function GET_SECRET_CODE($id){

    include("function/db.php");

    $code=$db->prepare("SELECT * FROM client WHERE client_id=?");
    $code->execute(array($id));

    if($code->rowCount()>0){

        $code_securite=$code->fetch()["client_code_secret"];
        return $code_securite;
    }
}

function CODE_SECRET_VERIFY($code_saisie,$code_secret){

    if($code_saisie==$code_secret){
        return true;
    }else{
        return false;
    }
}

function GET_COMPTE_ID($id){

    include("function/db.php");

    $compte=$db->prepare("SELECT compte_id FROM compte WHERE compte_client_id=?");
    $compte->execute(array($id));

    if($compte->rowCount()>0){

        return $compte;
    }else{
        return false;
    }
}



/**

*function RETRAIT_TRANSACTION($id,$depense){

        $id_client=$id; 
        $depenses_client=$depense; #depenses 

        include("function/db.php");

        $compte=$db->prepare("SELECT compte_solde AS 'solde' FROM compte WHERE compte_client_id=?");

        $compte->execute(array($id_client));

        while($data=$compte->fetch()){

            $solde=$data['solde'];


            $res=IS_DECOUVERT($solde,$depenses_client);

            if($res){

                return false;
            }else{
                
                $new_solde=$solde-$depenses_client; #new solde...
                $content_notification="Votre transaction a été effectué";

                include("function/f_notification.php");
                notification($id_client,$content_notification); #envoie de la notification...

                $update_solde_client=$db->prepare("UPDATE compte SET compte_solde=$new_solde  WHERE compte_client_id=?");
                $update_solde_client->execute(array($id_client));

                if($update_solde_client->rowCount()>0){
                    
                    return true; #return true...
                }



            }
        }

*}

**/