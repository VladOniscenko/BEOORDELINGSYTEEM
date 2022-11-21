<!-- Hier komt een overzicht van groep. -->
<?php
    require_once './toDB/session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klasoverzicht - GLRtje</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="./toDB/loguit.php">Uitlogen</a>
    <h1>Klasoverzicht</h1>
    <a class="toevoegen" href="">Voeg een nieuw student toe</a>
</body>
</html>

<?php
   $klas = $_SESSION['klas'];
   

//Voeg de database-verbinding toe
require './toDB/config.php';

$klas = $_SESSION['klas'];
//Maak de query
$query = "SELECT * FROM tabel_leerlingen WHERE klas = '$klas'";

//Voer de query uit en vang het resultaat op
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
    echo "<div class='container'>";
    //zolang er items uit te lezen zijn...
    while($item = mysqli_fetch_assoc($result)){
        //toon de gegevens van het item in een tabelrij
        echo "<div class='student'>";
        // echo "<td>" . $item['ID'] . "</td>";
        echo "<img class='avatar' src='" . $item['avatar_leerling'] . "' width='75' height = '90'>";
        echo "<div class='naam'>" . $item['voornaam']." "."</div>";
        echo "<div class='naam'>". $item['achternaam']."</div>";
        echo "<a href='studentInformatie.php?id=".$item['leerlingnummer']."'>Info</a>";
        // echo "<td>" . $item['Begindatum']. "</td>";
        // echo "<td>" . $item['Einddatum']. "</td>";
        // echo "<td>" . $item['Prioriteit'] . "</td>";
        // echo "<td>" . $item['Status'] . "</td>";
        echo "</div>";
    }
    //sluit de tabel af
    echo "</div>";
}
//Als er geen records zijn...
else
{
    echo "<p>Geen items gevonden!</p>";
}
?>