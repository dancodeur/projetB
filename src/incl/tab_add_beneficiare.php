<?php

include("function/f_bank.php");
include("function/f_notification.php");
include("function/email.php");
include("function/cle_generateur.php");
include("function/function.php");
//GENERE IBAM ET RIB

$gen=GEN_IBAM_RIB();

$RIB=$gen["RIB"];
$IBAM=$gen["IBAM"];


if(isset($_POST['btn'])){
   
        $id_client=$_SESSION["id"];
        $nom_benef=$_POST["nom"];
        $compte_id=$_POST["compte"];
        $code_secret=$_POST["code_secret"];
        $code_secret_client=GET_SECRET_CODE($id_client); //recup du code secret
        $code_secret_is_true=CODE_SECRET_VERIFY($code_secret,$code_secret_client); //verification des deux codes secrets...

        if($code_secret_is_true){
        
            if(is_string($nom_benef)){

                $is_ok=Addbeneficiaire($compte_id,$id_client,$nom_benef,$RIB,$IBAM);

                if($is_ok){
                    //email
                    $email=recupEmail($id_client);
                    $objet="Bénéficiaire [".$nom_benef."] ajouté";
                    $content="Le bénéficiaire a été ajouté avec succès"; 
                    virementEmail($email,$objet,$content);

                    //notification

                    notification($id_client,$content);

                    ?>
                        <section class="w-[80%] py-3  m-auto mb-3 bg-green-500 text-slate-50 text-center font-semibold">
                            <p>Le bénéficiaire a été ajouté avec succès</p>
                        </section>
                    <?php
                }


            }else{
                ?>
                    <section class="w-[80%] py-3  m-auto mb-3 bg-red-500 text-slate-50 text-center font-semibold">
                        <p>Le nom du bénéficiaire doit etre une chaine de caractère</p>
                    </section>
                <?php
            }
        
        }else{
            ?>
                <section class="w-[80%] py-3  m-auto mb-3 bg-red-500 text-slate-50 text-center font-semibold">
                    <p>Le code secret saisi n'est pas correct !</p>
                </section>
            <?php
        }

        
        
}

?>

<section class="w-[80%] m-auto">
    <div class="space-y-2 border border-slate-300 rounded w-[60%] bg-slate-100 px-4 py-4 mb-3">
                 
        <!---Formulaire de transaction-->

        <form action="" method="post" class="w-[60%]">

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
      
            <!---Nom du bénéficiaire-->

            <div class="flex flex-col space-y-2 mb-3">
                <label for="nom" class="flex space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>

                    <span>Nom du bénéficiare :</span>
                </label>

                <input type="text" name="nom"  id="nom" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required>
            </div>

            <!---IBAM-->

            <div class="flex flex-col space-y-2 mb-3">
                <label for="ibam" class="flex space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                    
                    <span>IBAM : <?php echo $IBAM ?></span>
                </label>

                <input type="text" name="ibam" value=<?= $IBAM?>  id="ibam" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300 cursor-not-allowed " required disabled>
            </div>

            <!---RIB-->

            <div class="flex flex-col space-y-2 mb-3">
                <label for="rib" class="flex space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>


                    <span>RIB : <?php echo $RIB ?></span>
                </label>

                <input type="text" value=<?= $RIB;?>  name="rib"  id="rib" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300 cursor-not-allowed" required disabled>
            </div>
            

                    
            <!---Bouton envoyer-->
            <a href="#" id="confirm_transaction" class="px-4 py-2 rounded bg-slate-800 text-yellow-200 flex space-x-2 items-center mb-3 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                <span>Valider</span>
            </a>

            <!----Modale--->
            <?php
                include("incl/modale_add_beneficiaire.php");
                include("incl/modale_transaction_code_secret.php");
            ?>

        </form>
    </div>
</section>