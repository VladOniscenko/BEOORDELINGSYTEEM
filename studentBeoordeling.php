<!-- Hier komt een pagina waar je een beoordeling kunt geven aan een student. -->
<?php
    //sessie -->
    require_once './toDB/session.inc.php';

    //error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beoordeling</title>
</head>
<body>
    <a href="./studentInformatie.php?id=<?php echo $id?>">terug</a>
    <form action="./toDB/beoordelingVerwerk.php" method="post">
        <!-- id = null -->

        <!-- IDLeerling -->
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

        <input type="submit" value="Verzenden">
    </form>
</body>
</html>

<!-- UPDATE `tabel_leerlingen` SET `minpunten_leerling` = `minpunten_leerling` - 1 WHERE `leerlingnummer` = 1;
UPDATE `tabel_leerlingen` SET `minpunten_leerling` = `minpunten_leerling` + 1 WHERE `leerlingnummer` = 1;

UPDATE `tabel_leerlingen` SET `minpunten_leerling` = `pluspunten_leerling` - 1 WHERE `leerlingnummer` = 1;
UPDATE `tabel_leerlingen` SET `minpunten_leerling` = `pluspunten_leerling` + 1 WHERE `leerlingnummer` = 1; -->