<?php 
include("function/db.php"); 
include("function/session.php");
include("function/function.php");
VerifAuth();
$client=$_SESSION["id"];
$res=SingleClientCompte($client);
$compte_id=$_GET["id"];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF RIB</title>
    <link href="../dist/output.css" rel="stylesheet">
</head>

<style>
    ul{
        margin-bottom:10px;
        border-bottom:2px solid black;
    }
    ul li{
        list-style: none;
        margin-bottom:5px;
        padding:5px;
    }
    ul li span{
        font-weight:bold;
    }

    div{
        margin-bottom:10px;
    }

    table{
        width:100%;
        border:1px solid black;
    }

</style>
<body>
    <main>
        <div style="margin-bottom:10px; border-bottom:2px solid black">
            <h1 style="color:gray">BANK</h1>
            <h2 >RELEVE D'IDENTITE BANCAIRE</h2>
        </div>
        <h3>TITULAIRE DU COMPTE</h3>
        <ul class="space-y-2 font-bold">
            <?php
            
            $details_client=$res["client"];

            if($details_client->rowCount()>0){

                while($data=$details_client->fetch()){
                    ?>
                    <li>Monsieur  : <span><?= $data["client_nom"].' '.$data["client_prenom"]?></span></li>
                    <li><span><?= $data["client_ville"].', '.$data["client_postal"]?></span></li>
    
                    <?php
                }
            }else{
                ?>
                   <h1>Error</h1>
                <?php
            }
              
            ?>
        </ul>

    
            <table>
                <tr>
                    <th>Banque</th>
                    <th>Identification Internationale (IBAM)</th>
                    <th>Clé RIB</th>
                </tr>
                
            </table>

            <?php
            
                $rib=$db->prepare("SELECT * FROM compte WHERE compte_id=?");
                $rib->execute(array($compte_id));

                /**if($rib->rowCount()>0){

                   while($data=$rib->fetch()){
                       ?>
                         <tr>
                            <td>0000</td>
                            <td><?= $data["compte_ibam"]?></td>
                            <td><?= $data["compte_rib"]?> €</td>
                         </tr>
                       <?php
                   }

                }else{
                   ?>
                   <p>Vous n'avez aucune transaction pour l'heure...</p>
                   <?php
                }**/

            ?>
               
           </table>
   
    </main>

</body>
</html>