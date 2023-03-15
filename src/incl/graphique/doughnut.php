<div>
  <canvas id="revenus" ></canvas>
</div>

<script>
  const ctx2 = document.getElementById('revenus');

  new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['Salaire', 'CAF', 'Location'],
      datasets: [{
        label: 'Revenus',
        data: [123, 78, 333],
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
