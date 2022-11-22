<?php
require_once './toDB/session.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student toevoegen - het Glrtje</title>
</head>
<body>
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
    //maak een hoofdDiv
    echo "<select class='vrijeStudenten'>";
    //zolang er items uit te lezen zijn...
    while($item = mysqli_fetch_assoc($result)){
        //toon de gegevens van het item in een tabelrij
        echo "<option class='student' value='".$item['leerlingnummer']."'>".$item['voornaam']." ". $item['achternaam'] . " " . date('d-m-Y', strtotime($item['geboortedatum'])). "</option>";
    }
    echo "</select>";
}
//Als er geen records zijn...
else
{
    echo "<p>Geen items gevonden!</p>";
    echo $klas ."<br>";
    echo $id . "<br>";
}
    ?>
</body>
</html>