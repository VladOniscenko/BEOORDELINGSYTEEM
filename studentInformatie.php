<!-- Hier komt een pagina waar je gegevens/beoordelingen kunt inzien van een student. -->
<?php
    //sessie -->
    require_once './toDB/session.inc.php';

    //error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>
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
    
    <div class='container'>

    <!-- STUDENT INFO -->
    <?php
        //Als er records zijn...
        if(mysqli_num_rows($result) > 0){
            //zolang er items uit te lezen zijn...
            while($item = mysqli_fetch_assoc($result)){

                $avatar = $item['avatar_leerling'];
                $leerlingnummer = $item['leerlingnummer'];
                $naamLeer = $item['voornaam'];
                $achternaamLe = $item['achternaam'];
                $gebDatum = date("d-m-Y",strtotime($item['geboortedatum']));
                $plusP = $item['pluspunten_leerling'];
                $minP = $item['minpunten_leerling'];

                $naamOuders = $item['Naam_Verzorger'];
                $emailuders = $item['Email_Verzorger'];
                $telOuders = $item['Tel_Verzorger'];

                //Tonen van data's van student op het scherm
                echo "
                    <div class='student'>
                        <img class='avatar' src='./avatars/$avatar'>
                        <div><a href='./studentAanpas.php?id=$leerlingnummer'>Gegevens aanpassen</a></div>
                        <div><a href='./studentBeoordeling.php?id=$leerlingnummer'>Beoordeling toevoegen</a></div>

                        <div class='leerlingnummer'>Leerlingnummer: $leerlingnummer</div>
                        
                        <div class='voornaam'>Voornaam: $naamLeer</div>
                        <div class='achternaam'>Achternaam: $achternaamLe</div>
                        
                        <div class='geboortedatum'>Geboortedatum $gebDatum</div>
                        <div class='groepsnaam'>Groepsnaam: $groepsnaam</div>

                        <div class='pluspunten'>Aantal pluspunten: $plusP</div>
                        <div class='pluspunten'>Aantal minpunten: $minP</div>

                        <h3>Gegevens van de verzorger</h3>

                        <div class='naamVerzorger'>Naam Verzorger: $naamOuders</div>
                        
                        <div class='emailVerzorger'>E-mail Verzorger: $emailuders</div>
                        <div class='telVerzorger'>Telefoonnummer Verzorger: $telOuders</div>
                        
                    </div>
                ";
            }
            
        }
        else
        {
            echo "<p>Geen items gevonden!</p>";
            echo $klas ."<br>";
            echo $id . "<br>";
        }
    ?>

    <!-- TABELLEN POSITIEVE BE -->
    <?php
        if(mysqli_num_rows($result3) > 0){
            //TONEN VAN POSITIEVE BEOORDELINGEN IN DE TABEL
            echo "
                <h3>Positieve Beoordelingen</h3>
                <table border='1px'>
                    <tr>
                        <th>Beschrijving beoordeling</th>
                        <th>Type beoordeling</th>
                        <th>Datum beoordeling</th>
                        <th>Beoordeling aanpassen</th>
                        <th>Beoordeling verwijderen</th>
                    </tr>
            ";
            while($item = mysqli_fetch_assoc($result3)){
                $IDBe = $item['ID'];
                $beschBe = $item['beschrijving_beoordeling'];
                $sleutelBe = $item['sleutelwoord_beoordeling'];
                $datumBe = date('d-m-Y',strtotime($item['datum_beoordeling']));

                echo "
                    <tr>
                        <td>$beschBe</td>
                        <td>$sleutelBe</td>
                        <td>$datumBe</td>
                        <td><a href='./toDB/beoordelingAanpas.php.php?id=$IDBe&studentID=$id'>Aanpassen</a></td>
                        <td><a href='./toDB/verwijderVraag.php?id=$IDBe&studentID=$id'>Verwijderen</a></td>
                    </tr>
                ";  
            }
            echo "</table>";
        }
        //Als er geen positieve beoordeling op staat, toon deze:
        else{
            echo "<div>Er is geen positieve beoordeling gevonden in het systeem. </div>";
        }

    ?>

    <!-- TABELLEN NEGATIVE BE -->
    <?php
        if(mysqli_num_rows($result4) > 0){
            

            //TONEN VAN POSITIEVE BEOORDELINGEN IN DE TABEL
            echo "
                <h3>Negatieve Beoordelingen</h3>
                <table border='1px'>
                    <tr>
                        <th>Beschrijving beoordeling</th>
                        <th>Type beoordeling</th>
                        <th>Datum beoordeling</th>
                        <th>Beoordeling aanpassen</th>
                        <th>Beoordeling verwijderen</th>
                    </tr>
            ";

            while($item = mysqli_fetch_assoc($result4)){
                $NIDBe = $item['ID'];
                $NbeschBe = $item['beschrijving_beoordeling'];
                $NsleutelBe = $item['sleutelwoord_beoordeling'];
                $NdatumBe = date('d-m-Y',strtotime($item['datum_beoordeling']));

                echo "
                    <tr>
                        <td>$NbeschBe</td>
                        <td>$NsleutelBe</td>
                        <td>$NdatumBe</td>
                        <td><a href='./toDB/beoordelingAanpas.php.php?id=$NIDBe&studentID=$id'>Aanpassen</a></td>
                        <td><a href='./toDB/verwijderVraag.php?id=$NIDBe&studentID=$id'>Verwijderen</a></td>
                    </tr>
                ";  
            }
            echo "</table>";
        }
        //Als er geen negatieve beoordeling op staat, toon deze:
        else{
            echo "<div>Er is geen negatieve beoordeling gevonden in het systeem. </div>";
        }
    ?>
</body>
</html>

