<?php

include("function/f_bank.php");
include("function/f_notification.php");
include("function/email.php");

if(isset($_POST['btn'])){

        $id_client=$_SESSION["id"];
        $source_revenu=$_POST["objet"];
        $montant=$_POST["montant"];
        $compte_id=$_POST["compte"];
        $solde=GET_SOLDE($compte_id);
       
        $res=MONTANT_SUFFISANT($montant);

        if($res){

            $is_ok=TRANSACTION_DEPOT($compte_id,$source_revenu,$montant,$solde);

            if($is_ok){
               
                //Notification
                $content="Votre depot à été effectuer avec succès";
                notification($id_client,$content);

                //Email

                $client_mail=recupEmail($id_client);
                $content_email="Votre depot d'un  montant de : ".$montant." € a été effectuer avec succès";
                $objet="Depot";

                virementEmail($client_mail,$objet,$content_email);

                ?>
                  <section class="w-[80%] py-3  m-auto mb-3 bg-green-500 text-slate-50 text-center font-semibold">
                    <p>Votre Depot a été effectuer avec succès</p>
                  </section>

                <?php
            }

        }else{
            $content="Votre montant de depot  est insuffisant ";
            notification($id_client,$content);
            ?>
               <section class="w-[80%] py-3  m-auto mb-3 bg-red-500 text-slate-50 text-center font-semibold">
                  <p>Le montant du depot  est insuffisant </p>
              </section>
            <?php
        }
}

?>

<section class="w-[80%] m-auto" data-aos="fade-up" data-aos-delay="50"  data-aos-duration="1000"  data-aos-easing="ease-in-out">
    <div class="space-y-2 border border-slate-300 rounded w-[60%] bg-slate-100 px-4 py-4 mb-3">
                 
        <!---Formulaire de transaction-->

        <form action="" method="post" class="w-[30%]">
        <div class=" space-y-2 mb-3">
            <label for="compte" class="flex space-x-4">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                 </svg>
                <span>Selection de compte</span>
            </label>

            <select name="compte" id="compte" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required>
                <?php
                            
                $compte=$db->prepare("SELECT * FROM compte WHERE compte_client_id=?");
                $compte->execute(array($_SESSION["id"]));

                if($compte->rowCount()>0){
                    while($datas=$compte->fetch()){
                        ?>
                            <option value=<?= $datas["compte_id"] ?>><?='Type de compte : '.$datas["compte_type"].'- IBAM : '.$datas["compte_ibam"]; ?></option>
                        <?php
                    }
                }else{
                    ?>
                        <option value="" disabled="disabled">Vous n'avez aucun aucun pour l'instant</option>
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

                <span>Source de revenu :</span>
            </label>

            <select name="objet" id="motif" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required>
                    <option value="transfert_argent">Salaire</option>
                    <option value="loyer">Location appartement</option>
                    <option value="vetement">Aide Sociale</option>
                    <option value="autres">Autres</option>
            </select>
                        
                        

                        
        </div>

                    
        <!---Bouton envoyer-->

        <button type="submit" name="btn" class="px-4 py-2 rounded bg-slate-800 text-yellow-200 flex space-x-2 items-center mb-3 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            <span>Valider</span>
        </button>
        </form>
    </div>
</section>