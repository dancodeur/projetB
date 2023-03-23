
<section id="modale_code_secret" class=" inset-0 absolute flex justify-center items-center z-[2]">
    <div class="bg-white rounded shadow px-4 py-4 w-[30%] m-auto  space-y-4 border border-slate-100">
         <div class=" flex justify-between ">
             <h1 class=" font-bold">Votre code secret</h1>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-red-500  cursor-pointer transition ease-in-out duration-150 transform hover:scale-125 hide_btn2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
         </div>

         <hr class="mt-2 mb-2">

         <div class=" space-y-2 mb-2 ">
                <div class="flex items-center  space-x-2 mb-3 group">
                    <label for="code_secret">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-focus:stroke-green-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>

                    </label>

                    <input type="password" name="code_secret"  id="code_secret" class="border border-slate-800 px-2 py-2 transition ease-in-out duration-150 delay-200 group-focus:outline-green-300" required>
                </div>
         </div>

         <div class=" flex ">
            <button type="submit" name="btn"class="px-4 py-2 rounded bg-slate-800 text-yellow-200 flex space-x-2 items-center mb-3 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                <span>Valider</span>
            </button>
         </div>
    </div>
</section>