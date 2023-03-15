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
    <title>Budget</title>
    <link href="../dist/output.css" rel="stylesheet">
    <?php require_once("incl/Link.php"); ?>
</head>
<body>
     <?php include("incl/header.php"); ?>

     <main class="px-8">
        <br><!---Saut de ligne-->
         <section class="  bg-slate-100 h-[90px]">
            <div class="text-center ">
                <h1 class="text-4xl font-semibold ">Gestion de budget </h1>
            </div>
         </section>
         <br><!---Saut de ligne-->

         <section class="flex justify-around">

           <div class="w-[25%]">
                <section>
                    <h1 class="text-3xl text-center font-semibold mb-3">Mes dépenses</h1>
                </section>

                <section>
                   <?php include("incl/graphique/pie.php"); ?>
                   
                   <div>
                       <h2 class="text-center text-xl font-bold mt-3 mb-3">Dépenses par catégories</h2>
                   </div>
                </section>
           </div>

           <div class="w-[25%]">
                 <section>
                    <h1 class="text-3xl text-center font-semibold mb-3">Mes revenus</h1>
                 </section>

                 <section>
                    <?php include("incl/graphique/doughnut.php"); ?>

                    <div>
                        <h2 class="text-center  text-xl font-bold mt-3 mb-3">Revenus par catégories</h2>
                    </div>
                 </section>

           </div>

         </section>

        
     </main>

     <?php include("incl/footer.php"); ?>


    
</body>
</html>