<?php

$id=$_SESSION['id'];

$datas=SingleClientCompte($id);
$Client=$datas['client'];
$Comptes=$datas['compteNumber'];

#var_dump($Comptes);

if($datas){

    while($data=$Client->fetch()){

?>

<section class="mb-3 z-[1]" data-aos="fade-up" data-aos-delay="50"  data-aos-duration="1000"  data-aos-easing="ease-in-out">
    <div class="flex justify-between  w-[80%] m-auto">
        <div class="w-[30%] border border-slate-300 rounded bg-slate-100 h-[250px]  px-4 py-4 space-y-2">
            <ul class="space-y-2">
                <li>Nom : <span class="text-slate-800 font-semibold"><?php echo $data['client_nom']; ?></span> </li>
                <li>Prénom : <span class="text-slate-800 font-semibold"><?php echo $data['client_prenom']; ?></span></li>
                <li>Tél : <span class="text-slate-800 font-semibold"><?php echo $data['client_tel']; ?></span></li>
                <li>Ville : <span class="text-slate-800 font-semibold"><?php echo $data['client_ville']; ?></span></li>
                <li>Code postal : <span class="text-slate-800 font-semibold"><?php echo $data['client_postal'] ?></span></li>
            </ul>
        </div>

        <div class="w-[60%] border border-slate-300 rounded bg-slate-100  px-4 py-4 space-y-2 ">
            <ul class="space-y-2">
                <li class="flex space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>

                    <span>Numéro Client : <span class="text-slate-800 font-semibold"><?php echo $data['client_code'] ?></span></li></span>
                </li>
            </ul>

            <hr>

            <h2 class="font-bold">Liens utiles</h2>

            <ul class="flex flex-wrap   justify-around p-2 space-y-4">

                <li class="p-2 bg-white shadow rounded hover:bg-slate-800 group transition ease-in-out duration-200">
                    <a href="messagerie.php" class="space-x-4 flex items-center group-hover:text-yellow-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:stroke-yellow-200 ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>

                        <span>Envoyer un message</span>
                    </a>
                </li>

                <li class="p-2 bg-white shadow rounded hover:bg-slate-800 group transition ease-in-out duration-200">
                    <a href="documents.php" class="space-x-4 flex items-center group-hover:text-yellow-200">
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                       </svg>
    
                     <span>Télécharger mon RIB</span>
                   </a>
                </li>

                <li  class="p-2  bg-white relative shadow rounded hover:bg-slate-800 group transition ease-in-out duration-200">
                    <a onclick="Auth_Code_Client()" href="#"  class="space-x-4 flex group-hover:text-yellow-200">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                           </svg>
                        <span>Mon code secret</span>

                        <?php $code_secret= $data['client_code_retrait'];
                              $code_pass_securite=$data['client_code_secret'];
                        ?>
                        
                        <script>
                           
                            let code_secret='<?php echo $code_secret; ?>';
                            let pass_securite='<?php echo $code_pass_securite; ?>';

                            document.getElementById("code_client_modal").style.display="none";

                            function Auth_Code_Client(){
                                
                                let Auth=prompt("Votre pass sécurité");

                                if(Auth==pass_securite){

                                    document.getElementById("code_client_modal").style.display="block";
                                }else if(Auth==''){
                                    
                                }else{
                                    alert("Votre pass de sécurité est incorrect");
                                }
                            }

                            function CloseModal(){
                                document.getElementById("code_client_modal").style.display="none";
                            }
                            
                        </script>
                        

                    </a>

                    <div onclick="CloseModal()" id="code_client_modal" class="text-sm rounded px-2 py-4 flex  space-x-4  shadow bg-slate-800 text-yellow-200 absolute -top-[1rem] right-4">
                         <p>Code secret : <span class="text-slate-50"><?php echo $data['client_code_retrait']; ?></span></p>
                           <svg id="close_modal_cc" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 stroke-slate-50 hover:stroke-red-500 cursor-pointer">
                               <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                          </svg>
                    </div>
                </li>

                <li class="p-2 bg-white relative shadow rounded hover:bg-slate-800 group transition ease-in-out duration-200">
                    <a href="#" class="space-x-4 flex group-hover:text-yellow-200">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                         </svg>
 
                        <span>Mon code de sécurité</span>
                    </a>
                    
                </li>

                <li class="p-2 bg-white shadow rounded hover:bg-slate-800 group transition ease-in-out duration-200">
                    <a href="documents.php" class="space-x-4 flex group-hover:text-yellow-200">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                         </svg>
    
                        <span>Mes documents</span>
                    </a>
                </li>

                <li class="p-2 bg-white shadow rounded hover:bg-slate-800 group transition ease-in-out duration-200">
                    <a href="documents.php" class="space-x-4 flex group-hover:text-yellow-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                       </svg>
                        <span>Mes prélèvements</span>
                    </a>
                </li>

                <li class="p-2 bg-white shadow rounded hover:bg-slate-800 group transition ease-in-out duration-200">
                    <a href="messagerie_recu.php" class="space-x-4 flex group-hover:text-yellow-200">
                       
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                        </svg>
                        <span> Mes demandes</span>
                    </a>
                </li>

                <li class="p-2 bg-white shadow rounded hover:bg-slate-800 group transition ease-in-out duration-200">
                    <a href="#" class="space-x-4 flex group-hover:text-yellow-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                       </svg>

                        <span>Aide</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</section>

<?php
}

}else{
    echo "error";
}

?>
<script src="asset/js/jquery-git.min.js"></script>
<script src="asset/js/tab_profil.js"></script>
