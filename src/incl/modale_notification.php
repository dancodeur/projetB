
<section class="inset-0 absolute flex justify-center items-center z-[2] modale_notif">
    <div class="bg-white rounded px-4 py-4 w-[25%] shadow m-auto  space-y-4 border border-slate-100 ">
         <div class=" flex justify-between ">
             <h1 class=" font-bold">Souhaitez-vous supprimer cette  notification ?</h1>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-red-500  cursor-pointer transition ease-in-out duration-150 transform hover:scale-125 hide_btn_notif">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
         </div>

         <hr class="mt-2 mb-2">

         <!----Contenu ici de base-->

         <div class=" flex justify-between ">
            <a href="#"  class="px-4 py-2 rounded bg-red-800 text-yellow-200 flex space-x-2 items-center mb-3 hide_btn_notif">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>

                <span>Annuler</span>
            </a>

            <a href="delete_notification.php?id=<?= $data["notification_id"]; ?>" class="px-4 py-2 rounded bg-slate-800 text-yellow-200 flex space-x-2 items-center mb-3 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                <span>Confirmer</span>
            </a>
         </div>
    </div>
</section>