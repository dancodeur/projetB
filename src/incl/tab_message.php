<?php

include("function/f_message.php");
include("function/f_notification.php");

if(isset($_POST['btn'])){
   $objet=htmlspecialchars(trim($_POST['objet']));
   $message=htmlspecialchars(trim($_POST['message']));
   $id_client=$_SESSION['id'];
  
   $res=Addmessage($id_client,$message,$objet);

   if($res){
     
    $notification_content="Accuser de recepetion";
    notification($id_client,$notification_content);

    ?>
    <section class="w-[80%] py-3  m-auto mb-3 bg-green-500 text-slate-50 text-center font-semibold">
        <p>Le message a été reçu par votre Banquier</p>
    </section>

    <?php
   }else{
    ?>
     <section class="w-[80%] py-3  m-auto mb-3 bg-red-500 text-slate-50 text-center font-semibold">
        <p>Error</p>
     </section>

    <?php
   }

   
}

?>

<section class="flex justify-between  w-[80%] m-auto mb-3" >
  <ul class="flex space-x-4">
      <li>
        <a href="messagerie.php" class="flex space-x-2 items-center group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-hover:stroke-2 ">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
            </svg> 
            <span class="group-hover:font-semibold">
                <?php 
                  $nbr_msg_envoyer=Nbre_message($_SESSION["id"]);
                  echo "Envoyés (".$nbr_msg_envoyer.")";
                ?>
            </span>       
        </a>
      </li>
      <li>
        <a href="messagerie_recu.php" class="flex space-x-2 items-center group">
           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-hover:stroke-2">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z" />
           </svg>           
           <span class="group-hover:font-semibold">
                <?php 
                  $nbr_msg_envoyer=Nbre_message_recu(1);
                  echo "Reçus (".$nbr_msg_envoyer.")";
                ?>
           </span>
        </a>
      </li>
     
  </ul>
</section>

<section class="mb-3">

    <div class="flex justify-between  w-[80%] m-auto">
        <!---message envoyé--->
        <div class="w-[50%] border border-slate-300 rounded bg-slate-100   px-4 py-4 space-y-2">
            <!---Bloc ici--->
            <?php 
            
            #include("function/f_message.php");
            $user=$_SESSION['id'];

            $res=ViewMessage($user);

            if($res){

                while($data=$res->fetch()){

                    ?>

               
                <div class="bg-white mt-3 rounded py-4 text-center  items-center px-2 shadow-sm border border-slate-300  w-[80%] m-auto mb-3" data-aos="fade-up" data-aos-delay="50"  data-aos-duration="1000"  data-aos-easing="ease-in-out">
        
                     <div class="flex space-x-3">
                         <ul class="space-y-2">
                             <li class="text-left flex space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>

                                 <span class="text-slate-800 font-semibold">Moi<?php #echo $data['notification_date']; ?></span> 
                             </li>

                             <li class="">
                                 <p class=" text-left">  <?php echo $data['message_content']; ?></p>
                              </li>

                         </ul>
      
                     </div>

                     <hr class="mt-2 mb-2">

                      <div class=" space-x-3">
                          
                            <ul class="flex justify-between items-center">
                                <li class="flex space-x-2">
                                    

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                    </svg>

                                    <span class="text-xs"><?php echo $data['message_date']; ?></span>

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                    <span class="text-xs"><?php echo $data['message_time']; ?></span>
                                </li>
                                <!----delete--->
                                <li>
                                    <a href="#" class="open_modale_message">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 stroke-red-500  cursor-pointer transition ease-in-out duration-150 transform hover:scale-125">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>

                      </div>

                </div>

                <?php
                  include("incl/modale_message.php");
                }   
            }

            ?>
        </div>
        
<!---FORMULAIREE ICI-->

        <div class="w-[40%] border border-slate-300 rounded bg-slate-100 h-[350px]  px-4 py-4 space-y-2">
             <!---Formulaire d'envoie de message-->
             <div class="bg-white mt-3 rounded py-4  px-2 shadow-sm border border-slate-300 ">
                <form action="" method="post">
                    <div class="flex flex-col space-y-2 mb-3">
                        <label for="objet" class="font-semibold">Objet</label>
                        <input type="text" name="objet" id="objet" class="border border-slate-300 p-2 focus:outline-yellow-200" requuired>
                    </div>

                    <div class="flex flex-col space-y-2 mb-3">
                        <label for="message" class="font-semibold">Message</label>
                        <textarea name="message" id="" cols="10" rows="3" id="message" class="border border-slate-300 p-2 focus:outline-yellow-200" required></textarea>
                    </div>
                    <!---Button -->
                    <button type="submit" name="btn" class="px-4 py-2 rounded bg-slate-800 text-yellow-200 flex space-x-2 items-center ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>

                        <span>Envoyer</span>
                    </button>
                </form>
             </div>
        </div>

    </div>

</section>