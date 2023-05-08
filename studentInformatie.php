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
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
<header>
        <img src="./media/logo.png" alt="logo">
        <a href="./home.php">Terug</a>   
    </header>

    <?php
                if (isset($_GET['message'])) {
                    $res = $_GET['message'];
                    echo "<h3 id='message'>$res</h3>";
                }
            ?>
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
                        <h2>Gegevens van de student</h2>

                        <div class='leerlingnummer'>Leerlingnummer: $leerlingnummer</div>
                        
                        <div class='voornaam'>Voornaam: $naamLeer</div>
                        <div class='achternaam'>Achternaam: $achternaamLe</div>
                        
                        <div class='geboortedatum'>Geboortedatum $gebDatum</div>
                        <div class='groepsnaam'>Groepsnaam: $groepsnaam</div>

                        <div class='pluspunten'>Positieve beoordelingen: $plusP</div>
                        <div class='pluspunten'>Negatieve beoordelingen: $minP</div>

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
        echo "<div>";
            echo "
                <h2>Positieve beoordelingen</h2>
                <table border='1px'>
                    <tr>
                        <th>Beschrijving beoordeling</th>
                        <th>Type beoordeling</th>
                        <th>Datum beoordeling</th>
                        <th>Beoordeling aanpassen</th>
                        <th>Beoordeling verwijderen</th>
                    </tr>
            ";
        if(mysqli_num_rows($result3) > 0){
            //TONEN VAN POSITIEVE BEOORDELINGEN IN DE TABEL
            
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
                        <td><a class='button' href='./toDB/beoordelingAanpas.php?id=$IDBe&studentID=$id'>Aanpassen</a></td>
                        <td><button type='button' class='button' onclick='confirmOnClick(&quot;toDB/verwijderBeoordeling.php?id=$IDBe&studentID=$id&sleutel=$sleutelBe&quot;)'>Verwijderen</button></td>
                    </tr>
                ";  
            }
            
        }else{
            echo "
                <tr>
                    <td colspan='5'>Er zijn geen beoordelingen gevonden.</td>
                </tr>
                ";  
        }
        echo "</table>";
    ?>

    <!-- TABELLEN NEGATIVE BE -->
    <?php
        echo "
            <h2>Negatieve beoordelingen</h2>
            <table border='1px' class='tableRed'>
                <tr>
                    <th>Beschrijving beoordeling</th>
                    <th>Type beoordeling</th>
                    <th>Datum beoordeling</th>
                    <th>Beoordeling aanpassen</th>
                    <th>Beoordeling verwijderen</th>
                </tr>
            ";
        if(mysqli_num_rows($result4) > 0){
            

            //TONEN VAN POSITIEVE BEOORDELINGEN IN DE TABEL
            

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
                        <td><a class='button' href='./toDB/beoordelingAanpas.php?id=$NIDBe&studentID=$id'>Aanpassen</a></td>
                        <td><button type='button' class='button' onclick='confirmOnClick(&quot;toDB/verwijderBeoordeling.php?id=$NIDBe&studentID=$id&sleutel=$NsleutelBe&quot;)'>Verwijderen</button></td>
                    </tr>
                ";  
            }
            
        }else{
            echo "
                <tr>
                    <td colspan='5'>Er zijn geen beoordelingen gevonden.</td>
                </tr>
                ";  
        }
        echo "</table>";
        //Als er geen negatieve beoordeling op staat, toon deze:
        
        echo "</div>";
    echo "                            <div class='twoButtonContainer gc-span2'>
    <a href='./studentAanpas.php?id=$leerlingnummer' class='button'>Gegevens aanpassen</a>
    <button onclick='hideToevoegContainer(0)' class='button'>Beoordeling toevoegen</button>
</div>";
    ?>
    <form action="./toDB/beoordelingVerwerk.php" method="post"  class="hiddenContainer">
        <!-- id = null -->

        <!-- IDLeerling -->
        <button onclick='hideToevoegContainer(0)' class='closebtn'>
            <span class='material-symbols-outlined'>
                close
            </span>
        </button>
    <h3>Beoordelingen toevoegen</h3>
        <input type="hidden" value="<?php echo $id ?>" name="IDLeerling" id="IDLeerling">

        <!-- sleutelwoord // Onderwerp -->
        <div>
            <select name="sleutelwoord" id="sleutelwoord" required>
                <optgroup label="Positieve beoordelingen">
                    <option value="Huiswerk gemaakt">Huiswerk gemaakt</option>
                    <option value="Maaltijd opgegeten">Maaltijd opgegeten</option>
                    <option value="Speelgoed opgeruimd">Speelgoed opgeruimd</option>
                    <option value="Goed gedragen">Goed gedragen</option>
                    <option value="Iets anders positief">Iets anders positief</option>
                </optgroup>

                <optgroup label="Negatieve beoordelingen">
                    <option value="Huiswerk niet gemaakt">Huiswerk niet gemaakt</option>
                    <option value="Maaltijd niet opgegeten">Maaltijd niet opgegeten</option>
                    <option value="Speelgoed niet opgeruimd">Speelgoed niet opgeruimd</option>
                    <option value="Niet goed gedragen">Niet goed gedragen</option>
                    <option value="Iets anders negatief">Iets anders negatief</option>
                </optgroup>
            </select>
        </div>
        <!-- beschrijving -->
        <div>
            <textarea name="beschrijving" id="beschrijving" cols="30" rows="10" maxlength="300" required></textarea>
        </div>

        <!-- DATUM -->
        <input type="hidden" name="datum" value="<?php echo date('Y-m-d'); ?>">

        <input type="submit" value="Verzenden" class="submit button">
    </form>
</body>
</html>

