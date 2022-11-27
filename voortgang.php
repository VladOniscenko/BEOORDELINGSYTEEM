<!-- Hier komt een groeps voortgang pagina. -->
<?php
    //sessie -->
    require_once './toDB/session.inc.php';

    //error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>
<!-- //code -->
<?php require './toDB/config.php';
$klas = $_SESSION['klas'];
$query = "SELECT * FROM tabel_beoordelingen WHERE klas = '$klas'";
$result = mysqli_query($mysqli, $query);
$huiswerkGemaakt = 0;
$maaltijdOpgegeten = 0;
$speelgoedOpgeruimd = 0;
$goedGedragen = 0;
$ietsAndersP = 0;
$huiswerkNietGemaakt = 0;
$maaltijdNietOpgegeten = 0;
$speelgoedNietOpgeruimd = 0;
$goedNietGedragen = 0;
$ietsAndersN = 0;
if (mysqli_num_rows($result) > 0)
{
    while ($item = mysqli_fetch_assoc($result))
    {
        $sleutel = $item['sleutelwoord_beoordeling'];
        if ($sleutel == "Huiswerk gemaakt")
        {
            $huiswerkGemaakt++;
        }
        elseif ($sleutel == "Maaltijd opgegeten")
        {
            $maaltijdOpgegeten++;
        }
        elseif ($sleutel == "Speelgoed opgeruimd")
        {
            $speelgoedOpgeruimd++;
        }
        elseif ($sleutel == "Goed gedragen")
        {
            $goedGedragen++;
        }
        elseif ($sleutel == "Iets anders positief")
        {
            $ietsAndersP++;
        }
        elseif ($sleutel == "Huiswerk niet gemaakt")
        {
            $huiswerkNietGemaakt++;
        }
        elseif ($sleutel == "Maaltijd niet opgegeten")
        {
            $maaltijdNietOpgegeten++;
        }
        elseif ($sleutel == "Speelgoed niet opgeruimd")
        {
            $speelgoedNietOpgeruimd++;
        }
        elseif ($sleutel == "Niet goed gedragen")
        {
            $goedNietGedragen++;
        }
        elseif ($sleutel == "Iets anders negatief")
        {
            $ietsAndersN++;
        }
    }
}

$aantalPositief = $huiswerkGemaakt + $maaltijdOpgegeten + $speelgoedOpgeruimd + $goedGedragen + $ietsAndersP;
$aantalNegatief = $huiswerkNietGemaakt + $maaltijdNietOpgegeten + $speelgoedNietOpgeruimd + $goedNietGedragen + $ietsAndersN;
$aantalBeoordelingen = $aantalPositief + $aantalNegatief;

if($aantalBeoordelingen <=0){
    $gemPerBeordeling = 0;
}else{
    $gemPerBeordeling = 100 / $aantalBeoordelingen;
}

$gemPositief = $gemPerBeordeling * $aantalPositief;
$totaal = number_format((double)$gemPositief, 1, '.', '');
if ($totaal >= 50)
{
    $fontTotaal = 'rgb(153, 230, 30)';
}
else
{
    $fontTotaal = 'rgb(230, 46, 46)';
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voortgang</title>
    <link rel="stylesheet" href="./style.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <script type="text/javascript" defer src="./scripts/chart.js"></script>
</head>
<body>
    <input id="mijnData" type="hidden" value="<?php echo "[$huiswerkGemaakt, $maaltijdOpgegeten, $speelgoedOpgeruimd, $goedGedragen, $ietsAndersP, $huiswerkNietGemaakt, $maaltijdNietOpgegeten, $speelgoedNietOpgeruimd, $goedNietGedragen, $ietsAndersN]"; ?>">
    <input type="hidden" id="totaal" value="<?php echo $totaal ?>">
    
    <!-- HEADER -->
    <header>
        <h1>Voortgang</h1>
        <a href="./toDB/loguit.php?message=U bent uitgelogd!">Uitlogen</a>
        <a href="./voortgang.php">Voortgang</a>
        <a href="./home.php">Klas</a>
    </header>

    <!-- MAIN -->
    <main>
        <div id="dump"></div>
        <!-- DOOR HEIGHT VAN CANVAS BEPAAL JE HOE GROOT CIRKEL WORD -->
        <div id="mijnCanvas"><canvas width="600px" id="myChart"></canvas></div>
    </main>

    <!-- FOOTER -->
    <footer>

    </footer>


</body>
</html>