<?php
    //sessie -->
    require_once './toDB/session.inc.php';

    //error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student toevoegen - het Glrtje</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- HEADER -->
    <header>
        <img src="./media/logo.png" alt="logo">
        <a href="./toDB/loguit.php?message=U bent uitgelogd!">Uitlogen</a>
    </header>
    <a href='./home.php'>Terug naar overzicht</a>
    
    <?php
        require './toDB/config.php';

        $query = "SELECT * FROM tabel_leerlingen WHERE klas = 0";
        $result = mysqli_query($mysqli,$query);

        if(!$result){
            echo "<p>FOUT:</p>";
            echo "<p>" . $query . "</p>";
            echo "<p>" . mysqli_error($mysqli) . "</p>";
            exit;
        }

            //Als er records zijn...
        if(mysqli_num_rows($result) > 0){
            //maak een select-item
            echo "<p>Studenten zonder klas</p>";
            echo "<form method='post' action='./toDB/toevoegVerwerk.php'>";
            echo "<select class='vrijeStudenten' name='vrijeStudent'>";
            echo "<option selected disabled>Kies een student</option>";
            //zolang er items uit te lezen zijn...
            while($item = mysqli_fetch_assoc($result)){
                //toon de gegevens van het item in een tabelrij
                echo "<option class='student' value='".$item['leerlingnummer']."'>".$item['voornaam']." ". $item['achternaam'] . " " . date('d-m-Y', strtotime($item['geboortedatum'])). "</option>";
            }
            echo "</select><br>";
            echo "<input type='submit' class='submit' name='submit' value='Student toevoegen'/>";
            echo "</form>";
        }
        //Als er geen records zijn...
        else
        {
            echo "<p>Geen student zonder klas gevonden in het systeem!</p>";
            //echo $klas ."<br>";
            //echo $id . "<br>";
        }
    ?>
</body>
</html>