<?php

include("function/f_bank.php");
include("function/f_notification.php");
include("function/email.php");


if(isset($_POST['btn'])){

        $id_client=$_SESSION["id"];
        $benef_nom=$_POST["beneficiaire"];
        $objet=$_POST["objet"];
        $solde=$_POST["solde"];
        $montant=$_POST["montant"];
        $compte_id=$_GET["id"];
        
        $code_secret=$_POST["code_secret"];

        $code_secret_client=GET_SECRET_CODE($id_client); //recup du code secret
        $code_secret_is_true=CODE_SECRET_VERIFY($code_secret,$code_secret_client); //verification des deux codes secrets...

        $res=SOLDE_INSUFFISANT($solde,$montant);

        if($code_secret_is_true){

                if($res==false && $montant>0){

                    $is_ok=TRANSACTION($compte_id,$objet,$montant,$solde,$benef_nom);

                    if($is_ok){
               
                        //Notification
                        $content="Votre virement vers ".$benef_nom." à été effectuer avec succès";
                        notification($id_client,$content);

                        //Email

                        $client_mail=recupEmail($id_client);
                        $content_email="Votre Virement vers le bénéficiaire : ".$benef_nom." d'un  montant de : ".$montant." € a été effectuer avec succès";
                        $objet="Virement compte IBAM : [" .$_POST["compte_ibam"]. "]";

                        virementEmail($client_mail,$objet,$content_email);

                        ?>
                          <section class="w-[80%] py-3  m-auto mb-3 bg-green-500 text-slate-50 text-center font-semibold">
                            <p>Votre Virement a été effectuer avec succès</p>
                          </section>

                        <?php
                    }

                }else{
                    $content="Votre virement vers ".$benef_nom." à échouée. Motif : solde insuffisant";
                    notification($id_client,$content);
                    ?>
                       <section class="w-[80%] py-3  m-auto mb-3 bg-red-500 text-slate-50 text-center font-semibold">
                          <p>Le montant de la transaction est soit insuffisant ou négatif pour effectuer ce virement !</p>
                      </section>
                    <?php
                }
        }else{
                $content="Alert : Une tentative de virement a été effectuer sur votre compte";
                notification($id_client,$content);
            ?>
                   <section class="w-[80%] py-3  m-auto mb-3 bg-red-500 text-slate-50 text-center font-semibold">
                        <p>Le code secret saisi n'est pas correct !</p>
                   </section>

            <?php
        }
}

?>

<section class="w-[80%] m-auto" data-aos="fade-up" data-aos-delay="50"  data-aos-duration="1000"  data-aos-easing="ease-in-out">
      <?php
      
      $compte=$db->prepare("SELECT * FROM compte WHERE compte_id=?");
      $compte->execute(array($_GET["id"]));

      if($compte->rowCount()>0){

        while($data=$compte->fetch()){

            ?>

            <div class="space-y-2 border border-slate-300 rounded w-[60%] bg-slate-100 px-4 py-4 mb-3">
                 <ul class="space-y-2">
                     <li class="flex space-x-4">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                         </svg>
                        <span>IBAM :  <span class="text-slate-800 font-semibold"><?php echo $data["compte_ibam"]; ?></span></li></span> 
                     </li>

                     <li class="flex space-x-4">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 7.756a4.5 4.5 0 100 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                         </svg>
                        <span>Solde :  <span class="text-slate-800 font-semibold"><?php echo $data["compte_solde"]; ?> €</span></li></span> 
                     </li>
                 </ul>

                  <!---Formulaire de transaction-->

                 <form action="" method="post" class="w-[30%]">
                    <div class=" space-y-2 mb-3">
                        <label for="beneficiaire" class="flex space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span>Vers le bénéficiaire :</span>
                        </label>

                        <select name="beneficiaire" id="beneficiaire" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required>
                            <?php
                            
                            $benef=$db->prepare("SELECT * FROM beneficiaire WHERE benef_client_id=? AND benef_client_compte_id=?");
                            $benef->execute(array($_SESSION["id"],$_GET["id"]));

                            if($benef->rowCount()>0){
                                while($datas=$benef->fetch()){
                                    ?>
                                      <option value=<?= $datas["benef_nom"] ?>><?= $datas["benef_nom"].' IBAM : '.$datas["benef_ibam"]; ?></option>
                                    <?php
                                }
                            }else{
                                ?>
                                  <option value="" disabled="disabled">Vous n'avez aucun bénéficiaire pour l'instant</option>
                                <?php
                            }
                            
                            ?>
                        </select>

                        
                    </div>
                    <!---Montant du virement-->

                    <div class="flex flex-col space-y-2 mb-3">
                        <label for="montant" class="flex space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>
                            <span>Montant :</span>
                        </label>

                        <input type="number" name="montant" step="0.01" id="montant" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required>
                    </div>
                    <!---Motif du virement-->
                    <div class="flex flex-col space-y-2 mb-3">
                        <label for="motif" class="flex space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>

                            <span>Motif :</span>
                        </label>

                        <select name="objet" id="motif" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required>
                               <option value="transfert_argent">Transfert d'argent</option>
                               <option value="loyer">Loyer</option>
                               <option value="alimentaire">Alimentaire</option>
                               <option value="vetement">Vetement</option>
                               <option value="autres">Autres</option>
                        </select>
                        
                        

                        
                    </div>

                    <!----Solde ---> 
                    <input type="hidden" name="solde" value=<?=$data["compte_solde"]?>>
                    <input type="hidden" name="compte_ibam" value=<?=$data["compte_ibam"]?>>
                    <!----Solde --->

                    
                    <!---Bouton envoyer-->

                    <a href="#" id="confirm_transaction" class="px-4 py-2 rounded bg-slate-800 text-yellow-200 flex space-x-2 items-center mb-3 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                               <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        <span>Valider</span>
                    </a>
                    <!----Modale--->
                    <?php
                       include("incl/modale_transaction.php");
                       include("incl/modale_transaction_code_secret.php");
                    ?>
                 </form>
            </div>

            <?php
            
        }
      }
      
      ?>
</section>