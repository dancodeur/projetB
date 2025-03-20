<section class="" data-aos="fade-up" data-aos-delay="50"  data-aos-duration="1000"  data-aos-easing="ease-in-out">

     <section class="flex justify-between  w-[80%] m-auto mb-3">
       <ul class="flex space-x-4">
           <li>
            <a href="virements.php" class="flex space-x-2 items-center group">
                 <span class="group-hover:text-yellow-500">Virement</span> 
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 group-hover:stroke-yellow-500 -rotate-45">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                 </svg>
             </a>
           </li>

           <li>
            <a href="#" class="flex space-x-2 items-center group">
                 <span class="group-hover:text-yellow-500">Virement international</span> 
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 group-hover:stroke-yellow-500">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 01-1.161.886l-.143.048a1.107 1.107 0 00-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 01-1.652.928l-.679-.906a1.125 1.125 0 00-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 00-8.862 12.872M12.75 3.031a9 9 0 016.69 14.036m0 0l-.177-.529A2.25 2.25 0 0017.128 15H16.5l-.324-.324a1.453 1.453 0 00-2.328.377l-.036.073a1.586 1.586 0 01-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 01-5.276 3.67m0 0a9 9 0 01-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                 </svg>
             </a>
           </li>

           <li>
             <a href="beneficiaire.php" class="flex space-x-2 items-center group">
                <span class="group-hover:text-yellow-500">Ajouter  un bénéficiaire </span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 group-hover:stroke-yellow-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
                
             </a>
           </li>

           <li>
             <a href="transaction_depot.php" class="flex space-x-2 items-center group">
                <span class="group-hover:text-yellow-500">Effectuer un dépôt  </span>
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 group-hover:stroke-yellow-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 7.756a4.5 4.5 0 100 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                     </svg>     
             </a>
           </li>
     
       </ul>
     </section>

    <div class="bg-slate-100 mt-3 rounded py-2 text-center flex justify-between px-4 shadow-sm border border-slate-300  w-[80%] m-auto mb-3" >
        <h1 class=" font-semibold text-xl">Comptes personnels</h1>
         
        <svg id="toogle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6  cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>

    </div>

    <?php 
    
       $client=$_SESSION['id']; #session utilisateur...

       $compte=$db->prepare("SELECT compte_id,compte_ibam,compte_solde FROM compte WHERE compte_client_id=?");
       $compte->execute(array($client));

       while($compte_client=$compte->fetch()){
          ?>

        

           <div class="bg-slate-800 mt-3 py-2 text-center  rounded  px-4 shadow  w-[80%] m-auto mb-3  tab"><!--tab est la classe javascript-->
                    <div class="flex justify-between relative">
                            <div class="py-2 px-4">
                               <h1 class="text-xl text-yellow-200 font-semibold text-left space-y-2">Compte</h1>
                               <h3><a class="text-slate-50 hover:text-slate-300" href="transaction.php?id=<?= $compte_client['compte_id']; ?>"><?php echo $compte_client['compte_ibam']; ?> : </a> <span class=" text-green-600  font-semibold">+ <?php echo number_format($compte_client['compte_solde']) ; ?> €</span></h3>
                           </div>

                           <div class="px-4 py-2 flex items-center">
                              
                              <?php 
                              if($_SERVER['PHP_SELF']=='/projetB/src/Comptes.php'){
                                  ?>

                                      <svg id="option"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-red-500  cursor-pointer transition ease-in-out duration-150 transform hover:scale-125">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                      </svg>

                                  <?php
                              }
                    
                              ?>

                                    <div class="bg-slate-100 rounded shadow-md absolute -right-[6.8rem] -top-[3rem] px-3 py-3 option_modale">
                                        <ul class="text-sm space-y-2">
                            
                                            <?php
                                            #recuperation de la variable id de cette element
                                            $id=$compte_client['compte_id'];
                                            ?>

                                            <li>
                                                <a href="transaction.php?id=<?= $compte_client['compte_id']; ?>" class="text-slate-800 font-semibold hover:text-red-500 transition ease-linear duration-150">Faire un virement</a>
                                            </li>
                                            <hr>
                                            <li>
                                                <a href="RIB.php?id=<?= $compte_client["compte_id"];?>" class="text-slate-800 font-semibold hover:text-red-500 transition ease-linear duration-150">Télécharger le RIB</a>
                                            </li>
                                            <hr>
                                            <li>
                                                <a href="#" class="text-slate-800 font-semibold hover:text-red-500 transition ease-linear duration-150">Détails de solde</a>
                                            </li>
                                        </ul>
                                    </div>

                          </div>
                    </div>

                    <!---Bar de prodression--->

                    <div class="mb-6 h-1 bg-neutral-200 dark:bg-neutral-600 ml-[1rem]" style="width:50%">
                       <div class="h-1 bg-green-600" style="width: 25%" id="progress"></div>
                    </div>

                    <?php
                    
                       $calcule=($compte_client['compte_solde']/10000)*100;
                       $calcule=$calcule;
                    ?>
          </div>

          

           

         <?php
            }

    ?>

</section>

