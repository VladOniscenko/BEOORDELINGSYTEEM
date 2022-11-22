<!-- Hier komt een groeps voortgang pagina. -->
<?php
    require_once './toDB/session.inc.php';
?>
<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voortgang</title>
</head>
<body>
    <!-- HEADER -->
    <header>
        <h1>Voortgang</h1>
        <a href="./toDB/loguit.php?message=U bent uitgelogd!">Uitlogen</a>
        <a href="./voortgang.php">Voortgang</a>
        <a href="./home.php">Klas</a>
    </header>

    <!-- MAIN -->
    <main>
        <?php
            require './toDB/config.php';
            $klas = $_SESSION['klas'];
            
            $query = "SELECT * FROM tabel_beoordelingen WHERE klas = '$klas'";
            $result = mysqli_query($mysqli,$query);

            //POSITIEVE
            $huiswerkGemaakt = 0;
            $maaltijdOpgegeten = 0;
            $speelgoedOpgeruimd = 0;
            $goedGedragen = 0;
            $ietsAndersP = 0;
            
            //NEGATIEVE
            $huiswerkNietGemaakt = 0;
            $maaltijdNietOpgegeten = 0;
            $speelgoedNietOpgeruimd = 0;
            $goedNietGedragen = 0;
            $ietsAndersN = 0;
            

            if(mysqli_num_rows($result) > 0){
                while($item = mysqli_fetch_assoc($result)){
                    // $id = $item['ID'];
                    // $id_leerling = $item['ID_leerling'];
                    $sleutel = $item['sleutelwoord_beoordeling'];

                    //POSITIEF
                    if($sleutel == "Huiswerk gemaakt"){ $huiswerkGemaakt++; }
                    elseif($sleutel == "Maaltijd opgegeten"){ $maaltijdOpgegeten++; }
                    elseif($sleutel == "Speelgoed opgeruimd"){ $speelgoedOpgeruimd++; }
                    elseif($sleutel == "Goed gedragen"){ $goedGedragen++; }
                    elseif($sleutel == "Iets anders positief"){ $ietsAndersP++; }
                    
                    //NEGATIEF
                    elseif($sleutel == "Huiswerk niet gemaakt"){ $huiswerkNietGemaakt++; }
                    elseif($sleutel == "Maaltijd niet opgegeten"){ $maaltijdNietOpgegeten++; }
                    elseif($sleutel == "Speelgoed niet opgeruimd"){ $speelgoedNietOpgeruimd++; }
                    elseif($sleutel == "Niet goed gedragen"){ $goedNietGedragen++; }
                    elseif($sleutel == "Iets anders negatief"){ $ietsAndersN++; }
                }
            }
            else
            {
                echo "<p>U heeft nog geen beoordelingen toegevoegd!</p>";
            }

            $aantalPositief = $huiswerkGemaakt + $maaltijdOpgegeten + $speelgoedOpgeruimd + $goedGedragen + $ietsAndersP;
            $aantalNegatief = $huiswerkNietGemaakt + $maaltijdNietOpgegeten + $speelgoedNietOpgeruimd + $goedNietGedragen + $ietsAndersN;

            $aantalBeoordelingen = $aantalPositief + $aantalNegatief;

            $gemPerBeordeling = 100 / $aantalBeoordelingen;

            $gemPositief = $gemPerBeordeling * $aantalPositief;
            $totaal = number_format((double)$gemPositief, 2, '.', '');
            
            echo "<div>$totaal%</div><br>";
        ?>
        <!-- DOOR HEIGHT VAN CANVAS BEPAAL JE HOE GROOT CIRKEL WORD -->
        <div><canvas id="myChart" width="400" height="500"></canvas></div>
    </main>

    <!-- FOOTER -->
    <footer>
    </footer>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let ctx = document.getElementById("myChart");

        

    // setup 
    const data = {
        labels: ['Huiswerk gemaakt', 'Maaltijd opgegeten', 'Speelgoed opgeruimd', 'Goed gedragen', 'Iets anders positief', 'Huiswerk niet gemaakt', 'Maaltijd niet opgegeten', 'Speelgoed niet opgeruimd', 'Niet goed gedragen', 'Iets anders negatief'],
      datasets: [{
        label: 'Weekly Sales',
        data: [<?php echo "$huiswerkGemaakt, $maaltijdOpgegeten, $speelgoedOpgeruimd, $goedGedragen, $ietsAndersP, $huiswerkNietGemaakt, $maaltijdNietOpgegeten, $speelgoedNietOpgeruimd, $goedNietGedragen, $ietsAndersN" ?>],
        backgroundColor: [
          'rgb(153, 230, 30, 0.5)',
          'rgb(153, 230, 30, 0.5)',
          'rgb(153, 230, 30, 0.5)',
          'rgb(153, 230, 30, 0.5)',
          'rgb(153, 230, 30, 0.5)',
          'rgb(230, 46, 46, 0.5)',
          'rgb(230, 46, 46, 0.5)',
          'rgb(230, 46, 46, 0.5)',
          'rgb(230, 46, 46, 0.5)',
          'rgb(230, 46, 46, 0.5)',
        ],
        borderColor: [
            'rgb(153, 230, 30)',
            'rgb(153, 230, 30)',
            'rgb(153, 230, 30)',
            'rgb(153, 230, 30)',
            'rgb(153, 230, 30)',
            'rgb(230, 46, 46)',
            'rgb(230, 46, 46)',
            'rgb(230, 46, 46)',
            'rgb(230, 46, 46)',
            'rgb(230, 46, 46)',
        ],
        borderWidth: 1,
        cutout: '80%',
        borderRadius: 20,
      }]
    };

    // const doughnutLabelsLine = {
    //     id: 'doughnutLabelsLine',
    //     afterDraw(chart, args, options){
    //         const{ ctx, chartArea: {top, bottom, left, right, width, height}} = chart;

    //         chart.data.datasets.foreach((dataset, i) =>{
                
    //             chart.getDatasetMeta(i).data.foreach((datapoint, index) =>{
    //                 const[x, y] = datapoint.tooltipPosition();
    //                 ctx.fillStyle = dataset.borderColor[index];
    //                 ctx.fill();
    //                 ctx.fillRect(x,y, 10, 10);

    //                 // const halfwidth = width / 2;
    //                 // const halfheight = height / 2;

    //                 // const xLine = x >= halfwidth ? x + 15 : x -15;
    //                 // const yLine = y >= halfheight ? y + 15 : y -15;
    //                 // const extraLine = x >= halfwidth ? 15 : -15;

    //                 // ctx.beginPath();
    //                 // ctx.moveTo(x, y);
    //                 // ctx.lineTo(xLine, y);
    //                 // ctx.strokeStyle = dataset.borderColor[index];
    //                 // ctx.stroke();
    //             })

                
    //         })
    //     }
    // }

    // config 
    const config = {
        type: 'doughnut',
        data,
        options: {
            layout:{
                padding: 20
            },
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
                },
            plugins: {
                legend: {
                    display: false
                }
            }
        },
        //plugins: [doughnutLabelsLine]
    };

    

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
    </script>
</body>
</html>