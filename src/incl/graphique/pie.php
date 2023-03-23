<?php 

$compte=GET_COMPTE_ID($_SESSION["id"]);
$id=$compte->fetch()["compte_id"];


$aliment=GET_MONTANT("alimentaire");
$vetement=GET_MONTANT("vetement");
$Loyer=GET_MONTANT("loyer");
$transfert_arg=GET_MONTANT("transfert_argent");



?>
<div class="mb-3">
  <canvas id="depenses" ></canvas>
</div>

<script>

  let aliment="<?=$aliment?>";
  let vetement="<?=$vetement?>";
  let loyer="<?=$Loyer?>";
  let transfert_argent="<?=$transfert_arg?>";
  


  const ctx = document.getElementById('depenses');

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Alimentaire', 'Vetement', 'Logement', 'Transfert d\'argent'],
      datasets: [{
        label: 'Dépenses',
        data: [aliment, vetement, loyer, transfert_argent],
        backgroundColor: [
           '#70E014',
           '#E01802',
           '#297FE1',
           '#E1B20B'
         ],
         hoverOffset: 5
      }]
    },
  });
</script>
