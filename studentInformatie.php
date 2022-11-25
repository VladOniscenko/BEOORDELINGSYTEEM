<!-- Hier komt een pagina waar je gegevens/beoordelingen kunt inzien van een student. -->
<?php
require_once './toDB/session.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informatie</title>
</head>
<body>
    <a href="./home.php">Terug</a>
    <?php
    require './toDB/config.php';
      $id = $_GET['id'];
      $klas = $_SESSION['klas'];

//Maak de query
$query = "SELECT * FROM tabel_leerlingen WHERE klas = '$klas' AND leerlingnummer = $id";
$query2 = "SELECT * FROM tabel_groepen WHERE ID = $klas";
$query3 = "SELECT * FROM `tabel_beoordelingen` WHERE`ID_leerling` = $id AND (`sleutelwoord_beoordeling` = 'Huiswerk gemaakt' OR `sleutelwoord_beoordeling` = 'Maaltijd opgegeten' OR `sleutelwoord_beoordeling` = 'Speelgoed opgeruimd' OR `sleutelwoord_beoordeling` = 'Goed gedragen' OR `sleutelwoord_beoordeling` = 'Iets anders positief');";
$query4 = "SELECT * FROM `tabel_beoordelingen` WHERE `ID_leerling` = $id AND( `sleutelwoord_beoordeling` = 'Huiswerk niet gemaakt' OR `sleutelwoord_beoordeling` = 'Maaltijd niet opgegeten' OR `sleutelwoord_beoordeling` = 'Speelgoed niet opgeruimd' OR `sleutelwoord_beoordeling` = 'Niet goed gedragen' OR `sleutelwoord_beoordeling` = 'Iets anders negatief');";

//Voer de query uit en vang het resultaat op
$result = mysqli_query($mysqli,$query);
$result2 = mysqli_query($mysqli,$query2);
$result3 = mysqli_query($mysqli,$query3);
$result4 = mysqli_query($mysqli,$query4);

if(!$result){
    echo "<p>FOUT:</p>";
    echo "<p>" . $query . "</p>";
    echo "<p>" . mysqli_error($mysqli) . "</p>";
    exit;
}

if(!$result2){
    echo "<p>FOUT:</p>";
    echo "<p>" . $query . "</p>";
    echo "<p>" . mysqli_error($mysqli) . "</p>";
    exit;
}

if(!$result3){
    echo "<p>FOUT:</p>";
    echo "<p>" . $query . "</p>";
    echo "<p>" . mysqli_error($mysqli) . "</p>";
    exit;
}


if(mysqli_num_rows($result2) > 0){
$item = mysqli_fetch_assoc($result2);
$groepsnaam = $item['naam_klas'];
}


//Als er records zijn...
if(mysqli_num_rows($result) > 0){
    //maak een hoofdDiv
    echo "<div class='container'>";
    //zolang er items uit te lezen zijn...
    while($item = mysqli_fetch_assoc($result)){
        //toon de gegevens van het item in een tabelrij
        echo "<div class='student'>";
        
        echo "<img class='avatar' src='./avatars/" . $item['avatar_leerling'] . "'>";
        echo "<div class='leerlingnummer'>Leerlingnummer: ".$item['leerlingnummer']."</div>";
        
        echo "<div class='voornaam'>Voornaam: " . $item['voornaam']."</div>";
        echo "<div class='achternaam'>Achternaam: ". $item['achternaam']."</div>";
        
        echo "<div class='geboortedatum'>Geboortedatum " . date("d-m-Y",strtotime($item['geboortedatum'])) . "</div>";
        echo "<div class='groepsnaam'>Groepsnaam: $groepsnaam</div>";

        echo "<div style='color: green;' class='pluspunten'>Aantal pluspunten: " . $item['pluspunten_leerling']."</div>";
        echo "<div style='color: red;' class='pluspunten'>Aantal minpunten: " . $item['pluspunten_leerling']."</div><br>";

        echo "<h3>Gegevens van de verzorger</h3>";
        echo "<div class='naamVerzorger'>Naam Verzorger: ". $item['Naam_Verzorger']."</div>";
        echo "<div class='emailVerzorger'>E-mail Verzorger: ". $item['Email_Verzorger']."</div>";
        echo "<div class='telVerzorger'>Telefoonnummer Verzorger: ". $item['Tel_Verzorger']."</div>";
        echo "</div><br>";
        
        echo "<a href='studentAanpas?id=".$item['leerlingnummer']."'>Gegevens aanpassen</a>";
    }
    //sluit de tabel af
    echo "</div>";
    
}
//Als er geen records zijn...
else
{
    echo "<p>Geen items gevonden!</p>";
    echo $klas ."<br>";
    echo $id . "<br>";
}
if(mysqli_num_rows($result3) > 0){
    
    echo "<h3>Positieve Beoordelingen</h3>";
    echo "<table border='1px'><tr><th>Beschrijving beoordeling</th><th>Type beoordeling</th><th>Datum beoordeling</th></tr>";
    while($item = mysqli_fetch_assoc($result3)){
    echo "<tr>";

    echo "<td>" .$item['beschrijving_beoordeling']."</td>";
    echo "<td>" .$item['sleutelwoord_beoordeling']."</td>";
    echo "<td>" .date('d-m-Y',strtotime($item['datum_beoordeling']))."</td>";
    echo "<td><a href='aanpasBeoordeling.php?id=".$item['ID']."'>Aanpassen</a></td></tr>";    
}
    echo "</table><br><br>";
}
else{
    echo "Er is geen positieve beoordeling gevonden in het systeem. <br>";
}
if(mysqli_num_rows($result4) > 0){
    echo "<h3>Negatieve Beoordelingen</h3>";
    echo "<table border='1px'><tr><th>Beschrijving beoordeling</th><th>Type beoordeling</th><th>Datum beoordeling</th></tr>";
    while($item = mysqli_fetch_assoc($result4)){
    echo "<tr>";

    echo "<td>" .$item['beschrijving_beoordeling']."</td>";
    echo "<td>" .$item['sleutelwoord_beoordeling']."</td>";
    echo "<td>" .date('d-m-Y',strtotime($item['datum_beoordeling']))."</td>";
    echo "<td><a href='aanpasBeoordeling.php?id=".$item['ID']."'>Aanpassen</a></td></tr>";
    }
    echo "</table>";
}
else{
    echo "Er is geen negatieve beoordeling gevonden in het systeem. <br>";
}

    ?>
    <a href="./studentAanpas.php"></a>
</body>
</html>