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
    <title>Transaction</title>
    <link href="../dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
     <?php include("incl/header.php"); ?>

     <main class="px-8 h-[560px]">
         <section class="mb-[3rem] mt-[3rem]">
            <div class="flex space-x-3 items-center font-semibold pl-[9rem]">
                <h1 class="text-xl">Comptes/ Virement/</h1>
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 group-hover:stroke-yellow-500 -rotate-45">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                 </svg>

                <h1 class="text-xl">Transaction #<?php echo $_GET["id"]; ?> </h1>
            </div>
         </section>
         
         <?php include("incl/tab_transaction.php"); ?>


        
     </main>

     <?php include("incl/footer.php"); ?>


    
</body>
</html>