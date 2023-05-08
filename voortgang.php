<!-- Hier komt een groeps voortgang pagina. -->
<?php
    //sessie -->
    require_once './toDB/session.inc.php';

    //error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $klas = $_SESSION['klas'];
    require './toDB/config.php';
    if($klas != NULL){
        $query2 = "SELECT * FROM tabel_groepen WHERE ID = '$klas'";
        $result2 = mysqli_query($mysqli,$query2);
        $item2 = mysqli_fetch_assoc($result2);
        $klas_naam = $item2['naam_klas'];        
    }
?>
<!-- //code -->
<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voortgang</title>
    <link rel="stylesheet" href="./style.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script type="text/javascript" defer src="./scripts/chart.js"></script>
</head>
<body>
        <!-- HEADER -->
        <header>
        <img src="./media/logo.png" alt="logo">
        <a href="./toDB/loguit.php?message=U bent uitgelogd!" class="material-symbols-outlined logout">logout</a>       
    </header>
    <div class="twoItemContainer">
            <div class="groupContainer">
            <span class="material-symbols-outlined groupIcon">
                groups
            </span>
                <div>Groep <?php echo $klas_naam?></div>
            </div>
            <div class="btn-group">
                <a href="./home.php">Klas</a>
                <a href="./voortgang.php">Voortgang</a>
            </div>
        </div>
    <input id="mijnData" type="hidden" value="<?php echo "[$huiswerkGemaakt, $maaltijdOpgegeten, $speelgoedOpgeruimd, $goedGedragen, $ietsAndersP, $huiswerkNietGemaakt, $maaltijdNietOpgegeten, $speelgoedNietOpgeruimd, $goedNietGedragen, $ietsAndersN]"; ?>">
    <input type="hidden" id="totaal" value="<?php echo $totaal ?>">


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