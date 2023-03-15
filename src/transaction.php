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
</head>
<body>
     <?php include("incl/header.php"); ?>

     <main class="px-8">
         <section class="mb-[3rem] mt-[3rem]">
            <div class="">
                <h1 class="text-4xl font-semibold pl-[9rem] ">Transaction <?php echo $_GET["id"]; ?> </h1>
            </div>
         </section>



        
     </main>

     <?php include("incl/footer.php"); ?>


    
</body>
</html>