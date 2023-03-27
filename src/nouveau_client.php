<?php
include("function/db.php");
include("function/Auth.php");
include("function/session.php");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau compte client</title>
    <link href="../dist/output.css" rel="stylesheet">
    
</head>
<body>
     <?php #include("incl/header.php"); ?>

     <main>
        <?php include("incl/tab_newCompte.php"); ?>
     </main>

     <?php #include("incl/footer.php"); ?>
     <script src="asset/js/jquery-git.min.js"></script>
     <script src="asset/js/newCompte.js"></script>
     <script src="asset/js/modale_premier_depot.js"></script>


    
</body>
</html>