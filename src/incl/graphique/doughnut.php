<?php 

$salaire=GET_MONTANT_REVENU("transfert_argent");
$caf=GET_MONTANT_REVENU("vetement");
$location=GET_MONTANT_REVENU("loyer");



?>
<div class="mb-3">
  <canvas id="revenus" ></canvas>
</div>


<script>

let salaire="<?= $salaire?>";
let CAF="<?= $caf ?>";
let LOCATION="<?= $location?>";



  const ctx2 = document.getElementById('revenus');

  new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['Salaire', 'CAF', 'Location'],
      datasets: [{
        label: 'Revenus',
        data: [salaire, CAF, LOCATION],
        backgroundColor: [
           '#06B2E0',
           '#1F5261',
           '#AC28E0'
         ],
         hoverOffset: 4
      }]
    },
  });
</script>
