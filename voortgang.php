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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Charts.css">
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
        <canvas id="myChart" width="400" height="150"></canvas>
    </main>

    <!-- FOOTER -->
    <footer>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
    <script type="text/javascript">
        let ctx = document.getElementById("myChart");
        new Chart(ctx, {
            type: 'doughnut',
            data: {
            labels: ['Huiswerk gemaakt', 'Maaltijd opgegeten', 'Speelgoed opgeruimd', 'Goed gedragen', 'Iets anders positief', 'Huiswerk niet gemaakt', 'Maaltijd niet opgegeten', 'Speelgoed niet opgeruimd', 'Niet goed gedragen', 'Iets anders negatief'],
            datasets: [{
                label: '# of Votes',
                data: [<?php echo "$huiswerkGemaakt, $maaltijdOpgegeten, $speelgoedOpgeruimd, $goedGedragen, $ietsAndersP, $huiswerkNietGemaakt, $maaltijdNietOpgegeten, $speelgoedNietOpgeruimd, $goedNietGedragen, $ietsAndersN" ?>],
                borderWidth: 1
            }]
            },
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
    </script>
</body>
</html>