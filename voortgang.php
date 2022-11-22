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

            $aantalPositief = 0;
            $aantalNegatief = 0;

            

            if(mysqli_num_rows($result) > 0){
                while($item = mysqli_fetch_assoc($result)){
                    // $id = $item['ID'];
                    // $id_leerling = $item['ID_leerling'];
                    $categorie = $item['categorie_beoordeling'];
                    $sleutel = $item['sleutelwoord_beoordeling'];

                    if($categorie == "positief"){
                        $aantalPositief++;
                    }
                    elseif($categorie == "negatief"){
                        $aantalNegatief++;
                    }
                    

                }
            }
            else
            {
                echo "<p>U heeft nog geen leerlingen toegevoegd aan uw klas!</p>";
            }

            $aantalBeoordelingen = $aantalNegatief + $aantalPositief;
            $gemPerBeordeling = 100 / $aantalBeoordelingen;
            $gemPositief = $gemPerBeordeling * $aantalPositief;
            $totaal = number_format((float)$gemPositief, 2, '.', '');
            
            //echo "<div>$totaal</div><br>";
        ?>

    </main>

    <!-- FOOTER -->
    <footer>

    </footer>
</body>
</html>