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
    <title>Studentinformatie - het GLRtje</title>
</head>
<body>
    

   <a href="./home.php">Terug</a>
    
    
    <?php
    require './toDB/config.php';
      $id = $_GET['id'];
      $klas = $_SESSION['klas'];


//Maak de query's
$query = "SELECT * FROM tabel_leerlingen WHERE klas = '$klas' AND leerlingnummer = $id";
$query2 = "SELECT * FROM tabel_groepen WHERE ID = $klas";

$query3 = "SELECT * FROM `tabel_beoordelingen` WHERE`ID_leerling` = $id AND (`sleutelwoord_beoordeling` = 'Huiswerk gemaakt' OR `sleutelwoord_beoordeling` = 'Maaltijd opgegeten' OR `sleutelwoord_beoordeling` = 'Speelgoed opgeruimd' OR `sleutelwoord_beoordeling` = 'Goed gedragen' OR `sleutelwoord_beoordeling` = 'Iets anders positief');";
$query4 = "SELECT * FROM `tabel_beoordelingen` WHERE `ID_leerling` = $id AND( `sleutelwoord_beoordeling` = 'Huiswerk niet gemaakt' OR `sleutelwoord_beoordeling` = 'Maaltijd niet opgegeten' OR `sleutelwoord_beoordeling` = 'Speelgoed niet opgeruimd' OR `sleutelwoord_beoordeling` = 'Niet goed gedragen' OR `sleutelwoord_beoordeling` = 'Iets anders negatief');";

//Voer de query's uit en vang de resultaten op
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
        //Tonen van data's van student op het scherm
        echo "<div class='student'>";
        
        //AVATAR EN LEERLINGNUMMER
        echo "<img class='avatar' src='./avatars/" . $item['avatar_leerling'] . "'>";
        echo "<div class='leerlingnummer'>Leerlingnummer: " . $item['leerlingnummer']."</div>";
        
        //VOORNAAM EN ACHTERNAAM
        echo "<div class='voornaam'>Voornaam: " . $item['voornaam'] . "</div>";
        echo "<div class='achternaam'>Achternaam: " . $item['achternaam'] . "</div>";
        
        //GEBOORTEDATUM EN NAAM VAN DE KLAS
        echo "<div class='geboortedatum'>Geboortedatum " . date("d-m-Y",strtotime($item['geboortedatum'])) . "</div>";
        echo "<div class='groepsnaam'>Groepsnaam: $groepsnaam</div>";

        //AANTAL MIN- EN PLUSPUNTEN
        echo "<div style='color: green;' class='pluspunten'>Aantal pluspunten: " . $item['pluspunten_leerling'] . "</div>";
        echo "<div style='color: red;' class='pluspunten'>Aantal minpunten: " . $item['minpunten_leerling'] . "</div><br>";

        //GEGEVENS VAN DE VERZORGER TONEN
        echo "<h3>Gegevens van de verzorger</h3>";

        //NAAM
        echo "<div class='naamVerzorger'>Naam Verzorger: " . $item['Naam_Verzorger'] . "</div>";
        
        //E-MAIL EN TELEFOONNUMMER
        echo "<div class='emailVerzorger'>E-mail Verzorger: ". $item['Email_Verzorger'] . "</div>";
        echo "<div class='telVerzorger'>Telefoonnummer Verzorger: " . $item['Tel_Verzorger'] . "</div>";
        
        echo "</div><br>";
        echo "<a href='studentAanpas?id=" . $item['leerlingnummer'] . "'>Gegevens aanpassen</a>";
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
    //TONEN VAN POSITIEVE BEOORDELINGEN IN DE TABEL
    echo "<h3>Positieve Beoordelingen</h3>";
    echo "<table border='1px'><tr><th>Beschrijving beoordeling</th><th>Type beoordeling</th><th>Datum beoordeling</th></tr>";
    while($item = mysqli_fetch_assoc($result3)){
    echo "<tr>";

    echo "<td>" . $item['beschrijving_beoordeling'] . "</td>";
    echo "<td>" . $item['sleutelwoord_beoordeling'] . "</td>";

    echo "<td>" . date('d-m-Y',strtotime($item['datum_beoordeling'])) . "</td>";

    echo "<td><a href='../beoordeel/toDB/verwijderVraag.php?id=" . $item['ID'] . "&studentID=$id'>Verwijderen</a></td></tr>";  
}
    echo "</table><br><br>";
}
//Als er geen positieve beoordeling op staat, toon deze:
else{
    echo "<br>Er is geen positieve beoordeling gevonden in het systeem. <br>";
}
if(mysqli_num_rows($result4) > 0){
    //TONEN VAN POSITIEVE BEOORDELINGEN IN DE TABEL
    echo "<h3>Negatieve Beoordelingen</h3>";
    echo "<table border='1px'><tr><th>Beschrijving beoordeling</th><th>Type beoordeling</th><th>Datum beoordeling</th></tr>";

    while($item = mysqli_fetch_assoc($result4)){
    echo "<tr>";

    echo "<td>" . $item['beschrijving_beoordeling'] . "</td>";
    echo "<td>" . $item['sleutelwoord_beoordeling'] . "</td>";

    echo "<td>" . date('d-m-Y',strtotime($item['datum_beoordeling'])) . "</td>";

    //LINK NAAR verwijderBeoordeling.php PAGINA met twee parameters (ID van beoordeling en studentID)
    echo "<td><a href='../beoordeel/toDB/verwijderVraag.php?id=" . $item['ID'] . "&studentID=$id'>Verwijderen</a></td></tr>";
    }
    echo "</table>";
}
//Als er geen negatieve beoordeling op staat, toon deze:
else{
    echo "<br>Er is geen negatieve beoordeling gevonden in het systeem. <br>";
}

    ?>
    <a href="./studentAanpas.php"></a>
</body>
</html>