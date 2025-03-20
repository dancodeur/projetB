<section class="">
    <div class="grid grid-cols-5 min-h-screen ">
         <section class="  col-span-2 md:flex justify-center bg-slate-800 rounded-br-[30rem]">
              <img src="asset/image/sign-up-form.png" alt="svg connexion" style="width:480px; height: 600px;">        
         </section>

         <section class="col-span-3  space-y-4 px-4">

            <nav class="flex justify-between mt-[3rem] mb-[0.8rem] border-0 pb-3">
                <div class="">
                   <h1 class="text-4xl font-semibold text-slate-800">DanBank</h1>
                </div>

                <div class="">
                      <!-- <ul class="flex">
                         <li>
                            <a href="nouveau_client.php" class="bg-red-600 text-slate-100 hover:bg-red-500 py-2 px-4 rounded-full">Ouvrir un compte</a>
                         </li>
                      </ul> -->
                </div>
            </nav>

              <hr class="mt-2 mb-2">

              <?php 
                  
                  if(isset($_POST["btn"])){
                   
                    $code_client=htmlspecialchars($_POST["code_client"]);
                    $code_secret=htmlspecialchars($_POST["code_secret"]);

                    $auth=$db->prepare("SELECT * FROM client WHERE client_code=? AND client_code_secret=?");
                    $auth->execute(array($code_client,$code_secret));

                    if($auth->rowCount()>0){
                         $id=$auth->fetch()["client_id"];
                         $_SESSION["id"]=$id;

                         header("location:Comptes.php");
                         
                    }else{
                        ?>
                        <section class="text-slate-100 bg-red-500 rounded px-2 py-3 text-center">
                            <p class="text-sm">Aucun compte client ne correspond aux identifiants saisis.</p>
                        </section>
                        <?php
                    }
                   
                  }
              
              ?>
              
             <div class="mt-[3.8rem] mb-[2.8rem]">
                 <h1 class="text-slate-800 text-md text-left  font-semibold">Connexion à votre espace client</h1>
             </div>

             <div class="flex justify-center w-[80%] m-auto items-center  mb-[2.8rem]">
                
                <form action="" method="post" class="space-y-3 pt-3">
                     <div class=" flex flex-col space-y-2 mb-3">
                          <label for="code_client" class="text-slate-800 font-semibold text-md">Code client</label>
                          <div class="flex space-x-2 group items-center">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-focus:stroke-yellow-200">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                               </svg>
                               <input type="text" id="code_client" name="code_client" placeholder="Votre code client" class="px-4 p-2 focus:outline-none border-0 border-b-2 border-slate-800 focus:border-b-2 group-focus:border-yellow-200 " required>
                          </div>

                     </div>

                     <div class=" flex flex-col space-y-2 mb-3">
                          <label for="code_secret" class="text-slate-800 font-semibold text-md">Code secret</label>
                          <div class="flex space-x-2 group items-center">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                              </svg>

                               <input type="password" id="code_secret" name="code_secret" placeholder="*********" class="px-4 p-2 focus:outline-none border-0 border-b-2 border-slate-800 focus:border-b-2 group-focus:border-yellow-200 " required>
                          </div>
                     </div>
                    <br>
                    <div class="">
                        <button href="#" name="btn" id="confirm_transaction" class="px-4 py-2 rounded-full bg-slate-800 text-yellow-200 flex space-x-2 items-center mb-3 ">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                              </svg>
                              <span>Valider</span>
                         </button>
                    </div>
                </form>

             </div>

             <div class="text-center">
                 <p class="text-slate-600 text-xs">DanBank 2025 made by <a href="mailto:elengadan@gmail.com" class="text-red-500">Dan Elenga</a> CY Cergy-Paris Université</p>
             </div>

         </section>
    </div>
</section>