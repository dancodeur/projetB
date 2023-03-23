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
    <title>PDF RELEVE BANCAIRE</title>
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

    table, th, td {
      border: 1px solid black;
     border-collapse: collapse;
     padding:5px;
    }
    table th{
        text-align:left;
    }

</style>
<body>
    <main>
        <div style="margin-bottom:10px; border-bottom:2px solid black">
            <h1 style="color:gray">BANK</h1>
            <h2 >RELEVE DE COMPTE</h2>
        </div>
        <h3>VOS CONTACTES</h3>
        <ul class="space-y-2 font-bold">
            <?php
            
            $details_client=$res["client"];

            if($details_client->rowCount()>0){

                while($data=$details_client->fetch()){
                    ?>
                    <li>Code client : <span><?= $data["client_code"]?></span></li>
                    <li>Nom: <span><?= $data["client_nom"]?></span></li>
                    <li>Prénom: <span><?= $data["client_prenom"]?></span></li>
                    <li>Email: <span><?= $data["client_email"]?></span></li>
                    <li>Code Postal: <span><?= $data["client_postal"]?></span></li>
                    <li>Ville: <span><?= $data["client_ville"]?></span></li>
                    <?php
                }
            }else{
                ?>
                   <h1>Error</h1>
                <?php
            }
              
            ?>
        </ul>

        <div>
            <h3>RELEVE DES OPERATIONS</h3>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Nature de l'opération</th>
                    <th>Débit</th>
                </tr>

                <?php
                
                 $details_transaction=$db->prepare("SELECT * FROM transaction WHERE transac_compte_id=?");
                 $details_transaction->execute(array($compte_id));

                 if($details_transaction->rowCount()>0){

                    while($details=$details_transaction->fetch()){
                        ?>
                          <tr>
                             <td><?= $details["transac_date"];?></td>
                             <td><?= $details["transac_objet"];?></td>
                             <td><?= $details["transac_montant"];?> €</td>
                          </tr>
                        <?php
                    }

                 }else{
                    ?>
                    <p>Vous n'avez aucune transaction pour l'heure...</p>
                    <?php
                 }

                ?>
                
            </table>
            
            <?php 
                $total=$db->prepare("SELECT SUM(transac_montant) AS 'Montant des transactions' FROM transaction WHERE transac_compte_id=?");
                $total->execute(array($compte_id));

                $montant=$total->fetch()["Montant des transactions"];
                
            ?>
            <h3>Totaux des mouvements : <?= number_format($montant); ?> € </h3>
        </div>

    </main>

</body>
</html>