<?php
include("function/db.php");
include("function/session.php");
VerifAuth();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depot</title>
    <link href="../dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
     <?php include("incl/header.php"); ?>

     <main class="px-8 h-[560px]">
         <section class="mb-[3rem] mt-[3rem]">
            <div class="flex space-x-3 items-center font-semibold pl-[9rem]">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 7.756a4.5 4.5 0 100 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                 </svg>

                <h1 class="text-xl">Depôt </h1>
            </div>
         </section>
         
         <?php include("incl/tab_depot.php"); ?>


        
     </main>

     <?php include("incl/footer.php"); ?>


    
</body>
</html>