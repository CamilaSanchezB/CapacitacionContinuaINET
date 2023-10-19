<?php
function dibujarGrafico($datosAGraficar, $titulo, $idChart)
{


  ?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Valoración', 'Cantidad'],
        <?php
        for ($i = 1; $i < count($datosAGraficar); $i++) {
          echo "['" . $datosAGraficar[$i][0] . "', " . $datosAGraficar[$i][1] . "]" . (count($datosAGraficar) - 1 != $i ? "," : "");
        }
        ?>
      ]);

      var options = {
        title: '<?php echo $titulo ?>',
        pieHole: 0.4,
        chartArea:{left: 0, right: 0}
      };

      var chart = new google.visualization.PieChart(document.getElementById('<?php echo $idChart;?>'));
      chart.draw(data, options);
    }
  </script>
  <?php
}

?>