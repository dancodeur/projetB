<?php

include("function/db.php");

//Methode ajoute un client dans la base de donnée...

function AddClient($nom,$prenom,$nation,$email,$tel,$ville,$postal,$c_secret,$c_retrait,$code_client){
    
    include("function/db.php");

    $verification_existence_client=$db->prepare("SELECT client_nom,client_prenom,client_email,client_tel FROM client WHERE client_nom=?,client_prenom=?,client_email=?,client_tel=?");
    $verification_existence_client->execute(array($nom,$prenom,$email,$tel));

    if($verification_existence_client->rowCount()>0){

        $message="Ce client existe dans la base de donnée";
        return $message;

    }else{

         $insertion=$db->prepare("INSERT INTO client VALUES(?,?,?,?,?,?,?,?,?,?)"); #Insertion dans la table Client...
         $insertion->execute(array($nom,$prenom,$nation,$email,$tel,$ville,$postal,$c_secret,$c_retrait,$code_client));

         if($insertion->rowCount()>0){  
           return true;
         }else{
           return false;
         }
    }

}

//Methode Efface un client dans la base de donnée...

function DeleteClient($id){

    if(is_int($id)){
        
        include("function/db.php");

        $delete=$db->prepare("DELETE FROM client WHERE client_id=?");
        $delete->execute(array($id));

        if($delete->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
}

//Affiche les clients

function ViewClient($orderBy="id",$ASC=true,$limit=10,){

    if(is_string($orderBy)){

        if(is_bool($ASC)){

            if(is_int($limit)){
                if($ASC==true){
                    
                    include("function/db.php");

                    $client=$db->query("SELECT * FROM client ORDER BY $orderBy ASC limit $limit");
                    
                    return $client; #Valeur de retour...
                }else{

                    include("function/db.php");

                    $client=$db->query("SELECT * FROM client ORDER BY $orderBy DESC limit $limit");
                    return $client; #Valeur de retour...
                }
            }
        }
    }
    
}

//Creation de Compte Bancaire Client

function NewCompteCB($client_id,$compte_type,$compte_solde,$compte_rib,$compte_ibam,$compte_date_creation){
    
    include("function/db.php");

    $Compte=$db->prepare("INSERT INTO compte VALUES (?,?,?,?,?,?)");
    $Compte->execute(array($client_id,$compte_type,$compte_solde,$compte_rib,$compte_ibam,$compte_date_creation));

    if($Compte->rowCount()>0){
        return true;
    }else{
        return false;
    }
}

//Affcihe les comptes d'un client

function SingleClientCompte($id){

    include("function/db.php");
    
    $Client=$db->prepare("SELECT * FROM client where client_id=?");
    $Client->execute(array($id));

    if($Client->rowCount()>0){
        
        $Compte=$db->query("SELECT COUNT(*) AS 'nombre_de_client' FROM compte where compte_client_id=$id");

        if($Compte->rowCount()>0){
            
            
            $data=['client'=>$Client,'compteNumber'=>$Compte];

            return $data;
        }
    
    }else{
        return false;
    }
}

//Ajoute un bénéficiaire


function Addbeneficiaire($compte_id,$id_client,$nom,$rib,$ibam){
    
    $compte=$compte_id;
    $client=$id_client;
    $nom=$nom;
    $rib=$rib;
    $ibam=$ibam;

    $date=date("Y-m-d");
    include("function/db.php");

    $add=$db->prepare("INSERT INTO beneficiaire(benef_client_compte_id,benef_client_id,benef_nom,benef_rib,benef_ibam,benef_date) VALUES(?,?,?,?,?,?)");
    $add->execute(array($compte,$client,$nom,$rib,$ibam,$date));

    if($add->rowCount()>0){

        return true;
    }else{
        return false;
    }
}


