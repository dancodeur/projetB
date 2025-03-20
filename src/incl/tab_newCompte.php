<section class="">
    <div class="px-4">

         <section class="">

            <nav class="flex justify-between items-center mt-[3rem]  border-0 pb-3">
                <div class="">
                   <h1 class="text-4xl font-semibold text-slate-800">Bank</h1>
                </div>

                <div class="">
                      <ul class="flex">
                         <li>
                            <a href="index.php" class="text-red-500 underline text-sm">Retour à la page de connexion</a>
                         </li>
                      </ul>
                </div>
            </nav>

              <hr class="mt-2 mb-2">

              <?php 
                  
                  if(isset($_POST["btn"])){
                   
                    //Compte
                    $type=htmlspecialchars($_POST["type_compte"]);
                    $epargne=$_POST["compte_epargne"];
                    $plafond=$_POST["plafond_paiement"];
                    //details client
                    $nom=$_POST["nom"];
                    $prenom=$_POST["prenom"];
                    $continent=$_POST["contient_naissance"];
                    $email=$_POST["email"];
                    $tel=$_POST["tel"];
                    $ville=$_POST["ville"];
                    $code_postal=$_POST["code_postal"];
                    $montant=$_POST["montant"];

                    if(is_string($nom) && strlen($nom)>=2){

                        if(is_string($prenom) && strlen($prenom)>=2){

                            if(stristr($email,"@gmail.com") || stristr($email,"@outlook.fr") || stristr($email,"yahoo.fr")){

                                if(is_int($tel) && strlen($tel)>=10 || strlen($tel)<=13 ){

                                    if(is_string($ville) && strlen($ville)>2){

                                        if(isset($code_postal)){

                                            include("function/cle_generateur.php");
                                            $KEY_GEN= GEN_IBAM_RIB();
                                            
                                           
                                            $COMPTE_NUMBER=GEN_CLIENT_NUM(); #Client_code
                                            $CODE_SECRET=GEN_CODE_SECRET();
                                            $CODE_RETRAIT=GEN_CODE_RETRAIT();
                                            
                                            $verif=$db->prepare("SELECT * FROM client WHERE client_nom=? AND client_prenom=? ");
                                            $verif->execute(array($nom,$prenom));

                                            if($verif->rowCount()>0){

                                                ?>
                                                   <section class="w-[80%] py-3  m-auto mb-3 bg-yellow-500 text-slate-50 text-center font-semibold">
                                                      <p>Vous existez déjà en tant que client !  <a href="index.php" class="text-yellow-600">connectez-vous ! </a> </p>
                                                   </section>

                                                <?php

                                            }else{

                                                $add=$db->prepare("INSERT INTO client(client_nom,client_prenom,client_nationalite,client_email,client_tel,client_ville,client_postal,client_code_secret,client_code_retrait,client_code,client_epargne) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                                                $add->execute(array($nom,$prenom,$continent,$email,$tel,$ville,$code_postal,$CODE_SECRET,$CODE_RETRAIT,$COMPTE_NUMBER,$epargne));

                                                if($add->rowCount()>0){

                                                    //Recupération  de l'id...

                                                    $get_client_id=$db->prepare("SELECT * FROM client WHERE client_nom=? AND client_prenom=?");
                                                    $get_client_id->execute(array($nom,$prenom));

                                                    $id_client=$get_client_id->fetch()["client_id"];

                                                    $RIB=$KEY_GEN["RIB"];
                                                    $IBAM=$KEY_GEN["IBAM"];
                                                    $date=date('Y-m-d');

                                                    $newCompte=$db->prepare("INSERT INTO compte(compte_client_id,compte_type,compte_solde,compte_rib,compte_ibam,compte_plafond,compte_date_creation) VALUES(?,?,?,?,?,?,?)");
                                                    $newCompte->execute(array($id_client,$type,$montant,$RIB,$IBAM,$plafond,$date));

                                                    if($newCompte->rowCount()>0){
                                                        
                                                        include("function/f_notification.php");
                                                        $content_notif="Bienvenue chèrs client ! nous sommes ravis de vous compter parmi nous.";
                                                        $notif=notification($id_client,$content_notif);
                                                        if($notif==true){
                                                            include("function/f_message.php");
                                                            $objet="Message de bienvenu";
                                                            $content_msg="Bonjour $nom ! Je suis votre conseiller client , vous pourrez me joindre à tout moment via la messagerie de l'application";
                                                            $msg=Addmessage($id_client,$content_msg,$objet);

                                                            if($msg==true){

                                                                //recupération ddes infos du compte client

                                                                #Email 
                                                                $to=$email;
                                                                $objet_email="Bank: Activation de compte[".$nom." ".$prenom."]";
                                                                $message_email="Chers Mr(Mme). $nom $prenom Nous vous souhaitons une chaleureuse bienvenue. Vous faite desormais parti de notre grande famille de client. Voici votre code client :" .$COMPTE_NUMBER." ainsi que votre code secret :".$CODE_SECRET.". Authentifiez-vous via ce lien : https://projetb.alwaysdata.net/projetB/src/index.php ,pour acceder à votre espace client.";
                                                       
                                                                 mail($to,$objet_email,$message_email);

                                                                ?>
                                                                   <section class="w-[80%] py-3  m-auto mb-3 bg-green-500 text-slate-50 text-center font-semibold">
                                                                    <p>Merci d'avoir choisi Bank, vous recevrez sous peu par mail, la confirmation de votre inscription !</p>
                                                                   </section>
                                                                <?php
                                                            }
                                                        }
                                                    }

                                                }
                                                
                                            }
                                 
                                        }else{
                                            ?>
                                              <section class="w-[80%] py-3  m-auto mb-3 bg-red-500 text-slate-50 text-center font-semibold">
                                                  <p>Le code postal n'est pas valide</p>
                                              </section>
                                            <?php
                                        }

                                    }else{
                                        ?>
                                          <section class="w-[80%] py-3  m-auto mb-3 bg-red-500 text-slate-50 text-center font-semibold">
                                           <p>La ville n'est pas valide </p>
                                          </section>
                                        <?php
                                    }
                                    
                                }else{
                                    ?>
                                    <section class="w-[80%] py-3  m-auto mb-3 bg-red-500 text-slate-50 text-center font-semibold">
                                        <p>Le numéro de téléphone n'est pas valide</p>
                                    </section>
                                    <?php
                                }

                            }else{
                                ?>
                                <section class="w-[80%] py-3  m-auto mb-3 bg-red-500 text-slate-50 text-center font-semibold">
                                   <p>Les adresses électroniques acceptées sont : </p>
                                   <ul>
                                      <li>exemple@gmail.com</li>
                                      <li>exemple@outlook.fr</li>
                                      <li>exemple@yahoo.fr</li>
                                   </ul>
                                </section>
                                <?php
                            }
                            
                        }else{
                            ?>
                             <section class="w-[80%] py-3  m-auto mb-3 bg-red-500 text-slate-50 text-center font-semibold">
                               <p>Le prénom n'est pas valide</p>
                             </section>
                            <?php
                        }

                    }else{
                        ?>
                          <section class="w-[80%] py-3  m-auto mb-3 bg-red-500 text-slate-50 text-center font-semibold">
                            <p>Le nom n'est pas valide</p>
                          </section>
                        <?php
                    }

                  }
              
              ?>
              
             <div class="mt-[3rem] mb-[1rem]">
                 <h1 class="text-slate-800 text-md text-left  font-semibold">Ouverture de compte</h1>
             </div>

             <div class="  mb-[1rem]">
                
                <form action="" name="ValidationJS" method="post" class="space-y-3 pt-3 px-4 py-4" onsubmit="return Validation()">
                     <div class="flex justify-between">
                        <!---Compte-->
                          <div style="width:470px">
                                  <div class="flex justify-start items-center mb-3 space-x-3 font-semibold">
                                     <h2 class="text-md  font-semibold text-slate-800">Comptes</h2>
                                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                                       </svg>
                                  </div>

                                 <!---Type de compte-->
                                 <div class=" flex flex-col space-y-2 mb-3  border p-2">
                                       <label for="type_compte" class="text-slate-800 font-semibold text-md">Type de compte</label>
                                       <select name="type_compte" id="type_compte" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required>
                                          <option value="particulier">Compte particulier</option>
                                          <option value="prive">Compte privé</option>
                                          <option value="entreprise">Compte entreprise</option>
                                          <option value="etudiant">Compte étudiant</option>
                                       </select>
                                  </div>
                                   <!---Livret epargne-->
                                  <div class=" flex flex-col space-y-2 mb-3  border p-2">
                                       <label class="text-slate-800  font-semibold  text-md">Activé un livret épargne</label>
                                       <div class="flex justify-start space-x-2">
                                           <input type="radio" name="compte_epargne" value="1" id="compte_epargne" class="accent-slate-800" required>
                                           <label for="compte_epargne"  class="text-slate-800  text-md">Oui</label>
                                       </div>

                                       <div class="flex justify-start space-x-2">
                                           <input type="radio" name="compte_epargne" value="0" id="compte_epargne2" class="accent-slate-800" required>
                                           <label for="compte_epargne2"  class="text-slate-800  text-md" >Non</label>
                                       </div>
                                  </div>
                                   <!---Plafond de paiement-->
                                  <div class=" flex flex-col space-y-2 mb-3  border p-2">
                                       <label for="plafond_compte" class="text-slate-800 font-semibold text-md">Plafond de paiement</label>
                                       <input type="number" step="100" max="10000" id="plafond_compte" min="500" name="plafond_paiement" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required>
                                      
                                  </div>
                          </div>
                         <!---Details client-->
                          <div style="width:540px">
                                  <div class="flex justify-start items-center mb-3 space-x-3 font-semibold">
                                     <h2 class="text-md  font-semibold text-slate-800">Informations client</h2>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                        </svg>
                                  </div>

                                   <!---Nom et prénom-->
                                   <div class=" flex flex-col space-y-2 mb-3  border p-2">
                                       <div class=" flex  justify-between relative">
                                            <div class=" flex flex-col space-y-2">
                                                <label for="nom" class="text-slate-800 font-semibold text-md">Nom</label>
                                                <input type="text"  name="nom" id="nom" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required style="width:245px">
                                            </div>
                                            <span id="nomJs"></span>

                                            <div class=" flex flex-col space-y-2">
                                                <label for="prenom" class="text-slate-800 font-semibold text-md">Prénom</label>
                                                <input type="text" name="prenom" id="prenom" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required style="width:245px">
                                            </div>
                                            <span id="prenomJs"></span>
                                       </div>
                                      
                                  </div>

                                  <!---Continent de naissance-->
                                 <div class=" flex flex-col space-y-2 mb-3  border p-2">
                                       <label for="contient_naissance" class="text-slate-800 font-semibold text-md">Continent de naissance</label>
                                       <select name="contient_naissance" id="contient_naissance" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required>
                                          <option value="amerique">Amérique</option>
                                          <option value="europe">Europe</option>
                                          <option value="asie">Asie</option>
                                          <option value="afrique">Afrique</option>
                                          <option value="oceanie">l'Océanie</option>
                                          <option value="antarctique">Antarctique</option>
                                       </select>
                                 </div>
                                 <!---Email-->
                                  <div class=" flex flex-col space-y-2  border p-2">
                                    <label for="email" class="text-slate-800 font-semibold text-md">Email</label>
                                    <input type="email" name="email" id="email" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required >     
                                  </div>
                                  <span id="emailJs"></span>
                          </div>

                            
                           <!---Adresse-->
                          <div style="width:400px">
                                 <br>
                                 <!--Tél-->
                                <div class=" flex flex-col space-y-2  border p-2 mt-3">
                                    <label for="tel" class="text-slate-800 font-semibold text-md">Numéro de téléphone</label>
                                    <input type="text" name="tel" id="tel" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required >     
                                </div>
                                <span id="telJs"></span>
                                <!--Ville-->
                                <div class=" flex flex-col space-y-2  border p-2 mt-3">
                                    <label for="ville" class="text-slate-800 font-semibold text-md">Ville</label>
                                    <input type="text" name="ville" id="ville" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required >     
                                </div>
                                <span id="villeJs"></span>

                                  <!--Code postal-->
                                  <div class=" flex flex-col space-y-2  border p-2 mt-3">
                                    <label for="cd_postal" class="text-slate-800 font-semibold text-md">Code Postal</label>
                                    <input type="text" name="code_postal" id="cd_postal" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required >     
                                  </div>
                                  <span id="code_postalJs"></span>

                          </div>

                          <!--Modale--->

                          <?php include("incl/modale_premier_depot.php"); ?>
                     </div>
                     
                     <!--Bouton--->

                     <div class="">
                        <a href="#"  class="px-4 py-2 rounded-full bg-slate-800 text-yellow-200 flex space-x-2 items-center mb-3 open_modale_premier_depot" style="width:120px">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                              </svg>
                              <span>Valider</span>
                        </a>
                     </div>



                </form>

             </div>

             <div class="text-center">
                 <p class="text-slate-600 text-xs">Bank 2023 made by <a href="mailto:elengadan@gmail.com" class="text-red-500">Dan Elenga</a> TD2-TP3 BUT MMI CY Cergy-Paris université - IUT Sarcelles.</p>
             </div>

         </section>
    </div>
</section>