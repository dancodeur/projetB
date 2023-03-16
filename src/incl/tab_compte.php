<section class="">
    <div class="bg-slate-100 mt-3 rounded py-2 text-center flex justify-between px-4 shadow-sm border border-slate-300  w-[80%] m-auto mb-3">
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

        

           <div  class="bg-slate-800 mt-3 py-2 text-center relative rounded flex justify-between px-4 shadow  w-[80%] m-auto mb-3 hover:bg-slate-700 tab"><!--tab est la classe javascript-->
                 <div class="py-2 px-4">
                     <h1 class="text-xl text-yellow-200 font-semibold text-left space-y-2">Compte</h1>
                     <h3><a class="text-slate-50 hover:text-slate-300" href="transaction.php?id=<?= $compte_client['compte_id']; ?>"><?php echo $compte_client['compte_ibam']; ?> : </a> <span class=" text-green-600  font-semibold">+ <?php echo $compte_client['compte_solde']; ?> €</span></h3>
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
                                <a href="#" class="text-slate-800 font-semibold hover:text-red-500 transition ease-linear duration-150">Télécharger le RIB</a>
                            </li>
                            <hr>
                            <li>
                                <a href="#" class="text-slate-800 font-semibold hover:text-red-500 transition ease-linear duration-150">Détails de solde</a>
                            </li>
                        </ul>
                    </div>

                </div>
           </div>

         <?php
            }

    ?>

</section>