<?php

function GET_COMPTE_TRANSACTION($id){

    include("function/db.php");

    $transac=$db->prepare("SELECT * FROM compte WHERE compte_id=?");
    $transac->execute(array($id));

    if($transac->rowCount()>0){

        return $transac;
    }else{
        return false;
    }
}

function GET_MONTANT($item){
    
    include("function/db.php");

    $sum_transfert=$db->prepare("SELECT SUM(transac_montant) AS 'montant total' FROM transaction WHERE transac_objet=?");
    $sum_transfert->execute(array($item));

    $total=$sum_transfert->fetch()["montant total"];

    return $total;


}

function GET_MONTANT_REVENU($item){
    
    include("function/db.php");

    $sum_transfert=$db->prepare("SELECT SUM(depot_solde) AS 'montant total' FROM depot WHERE depot_source_revenu=?");
    $sum_transfert->execute(array($item));

    $total=$sum_transfert->fetch()["montant total"];

    return $total;


}

