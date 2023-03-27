
<section class=" inset-0 absolute flex justify-center items-center z-[2] modale_premier_depot">
    <div class="bg-white rounded px-4 py-4 w-[25%] shadow m-auto  space-y-4 border border-slate-100 ">
         <div class=" flex justify-between ">
             <h1 class=" font-bold">Votre premier dépôt</h1>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-red-500  cursor-pointer transition ease-in-out duration-150 transform hover:scale-125 hide_btn_premier_depot">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
         </div>

         <div>
            <p>Pour activer votre compte vous devez effectuer un dépôt minimum de 50.00€</p>
         </div>

         <hr class="mt-2 mb-2">

         <div class="flex flex-col space-y-2 mb-3">
                <label for="montant" class="flex space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                    </svg>
                <span>Montant :</span>
            </label>

            <input type="number" name="montant" step="0.01" min="50.00" id="montant" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 focus:outline-yellow-300" required>
        </div>

        

         <div class=" flex justify-between ">
            <a href="#"  class="px-4 py-2 rounded bg-red-800 text-yellow-200 flex space-x-2 items-center mb-3 hide_btn_premier_depot">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>

                <span>Annuler</span>
            </a>

            <button type="submit" name="btn" class="px-4 py-2 rounded bg-slate-800 text-yellow-200 flex space-x-2 items-center mb-3 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                <span>Confirmer</span>
            </button>
         </div>
    </div>
</section>