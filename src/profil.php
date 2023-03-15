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
</head>
<body>
     <?php include("incl/header.php"); ?>

     <main class="px-8 h-[200px]">
        <section class="mb-[3rem] mt-[3rem]">
            <div class="">
                <h1 class="text-4xl font-semibold pl-[9rem] ">Profil </h1>
            </div>
         </section>

        <?php include("incl/tab_profil.php"); ?>

        
     </main>

     <?php #include("incl/footer.php"); ?>


    
</body>
</html>