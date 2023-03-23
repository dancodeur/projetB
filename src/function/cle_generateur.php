<?php 

function GEN_IBAM_RIB(){

    $i="FR00";
    $i1=rand(1000,9999);
    $i2=rand(1000,9999);
    $i3=rand(1000,9999);
    $i4=rand(1000,9999);
    $i5=rand(1000,9999);
    
    $key_rib=rand(001,900);
    
    $IBAM=$i." ".$i1." ".$i2." ".$i3." ".$i4." ".$i5." ".$key_rib; #IBAM
    $RIB=$key_rib; #RIB
    
    $res=[
        'IBAM'=>$IBAM,
        'RIB'=>$RIB
    ];

    return $res;

}

function GEN_COMPTE_NUMBER(){
    
    $compte_number=rand(10000000000,99999999999);
    return $compte_number;
}

function GEN_CLIENT_NUM(){

    $CLIENT_NUM=rand(1000000000,9999999999);
    return $CLIENT_NUM;
}

function GEN_CODE_SECRET(){
    $code_secret=rand(10000,99999);

    return $code_secret;
}

function GEN_CODE_RETRAIT(){

    $code_retrait=rand(1000,9999);

    return $code_retrait;
}