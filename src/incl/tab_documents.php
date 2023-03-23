<section class="w-[80%] m-auto" data-aos="fade-up" data-aos-delay="50"  data-aos-duration="1000"  data-aos-easing="ease-in-out">
    
    <!---RIB--->

    <div class="bg-slate-100 mt-3 rounded py-2 text-center flex justify-between px-4 shadow-sm border border-slate-300 mb-3">
        <h1 class=" font-semibold text-xl">RIB</h1>
         
        <svg id="rib_toogle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6  cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>

    </div>

    <?php
    
    $client=$_SESSION['id']; #session utilisateur...

    $compte=$db->prepare("SELECT compte_id,compte_ibam,compte_solde FROM compte WHERE compte_client_id=?");
    $compte->execute(array($client));

    while($data=$compte->fetch()){

        ?>
         <!---rib is a Javascript class-->
         <div class="border border-slate-300  bg-white px-4 py-4 space-y-2 mb-3 rib">
             <ul class="flex justify-between">
                 <li class="flex space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                     <span>Numéro de compte : <span class="text-slate-800 font-semibold"><?php echo $data['compte_ibam']; ?></span></li></span>
                 </li>

                 <li>
                     <a href="RIB.php?id=<?= $data["compte_id"];?>">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-yellow-500  cursor-pointer transition ease-in-out duration-150 transform hover:scale-125">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                         </svg>

                     </a>
                 </li>
             </ul>

         </div>

        <?php
     }
    
    ?>

    <!---relevé de compte--->

    <div class="bg-slate-100 mt-3 rounded py-2 text-center flex justify-between px-4 shadow-sm border border-slate-300 mb-3">
        <h1 class=" font-semibold text-xl">Prélèvement</h1>
         
        <svg id="prelevement_toogle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6  cursor-pointer ">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>

    </div>

    <?php 
    
        $client=$_SESSION['id']; #session utilisateur...

        $compte=$db->prepare("SELECT compte_id,compte_ibam,compte_solde FROM compte WHERE compte_client_id=?");
        $compte->execute(array($client));

        while($data=$compte->fetch()){

            ?>
                <!---prelevement is a Javascript class-->
                <div class="border border-slate-300  bg-white px-4 py-4 space-y-2 mb-3 prelevement">
                     <ul class="flex justify-between">
                         <li class="flex space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                             <span>Numéro de compte : <span class="text-slate-800 font-semibold"><?php echo $data['compte_ibam']; ?></span></li></span>
                         </li>

                         <li>
                             <a href="RELEVE_COMPTE.php?id=<?= $data["compte_id"];?>">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-yellow-500  cursor-pointer transition ease-in-out duration-150 transform hover:scale-125">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                 </svg>
                             </a>
                         </li>
                     </ul>

                </div>

            <?php
        }
    
    ?>

</section>