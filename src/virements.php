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
    <title>Virements</title>
    <link href="../dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
     <?php include("incl/header.php"); ?>

     <main class="px-8 h-[560px]">
         <section class="mb-[3rem] mt-[3rem]">
            <div class="">
                <h1 class="text-xl font-semibold pl-[9rem]  ">Comptes/ Virement/ </h1>
            </div>
         </section>

         <?php include("incl/tab_compte.php"); ?>

        
     </main>

     <?php include("incl/footer.php"); ?>


    
</body>
</html>