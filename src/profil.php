<?php
include("function/db.php");
include("function/session.php");
include("function/function.php");

VerifAuth();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="../dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
     <?php include("incl/header.php"); ?>

     <main class="px-8 h-[560px]">
        <section class="mb-[3rem] mt-[3rem]">
            <div class="flex space-x-3 items-center font-semibold pl-[9rem]">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
               </svg>
                <h1 class="text-xl">Profil</h1>
            </div>
         </section>

        <?php include("incl/tab_profil.php"); ?>

        
     </main>

     <?php include("incl/footer.php"); ?>


    
</body>
</html>