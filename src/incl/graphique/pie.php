<div>
  <canvas id="depenses" ></canvas>
</div>

<script>
  const ctx = document.getElementById('depenses');

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Alimentaire', 'Vetement', 'Voiture', 'Autres'],
      datasets: [{
        label: 'Dépenses',
        data: [276, 199, 180, 600],
        backgroundColor: [
           'rgb(255, 99, 132)',
           'rgb(54, 162, 235)',
           'rgb(255, 205, 86)'
         ],
         hoverOffset: 4
      }]
    },
  });
</script>
