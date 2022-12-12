<?php
    //sessie -->
    require_once './session.inc.php';

    //error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if(isset($_GET['id'])){
        require './config.php';
        $id = $_GET['id'];
        $studentID = $_GET['studentID'];

        $query = "SELECT * FROM `tabel_beoordelingen` WHERE ID = '$id'";
        $result = mysqli_query($mysqli, $query);
        if(!$result){
            header("location:../studentInformatie.php?id=$studentID&message=Er is een fout opgetreden bij het verwerken van uw verzoek.</br> Probeer het later nogmaals!");
            echo "<p> $query </p>";
            echo "<p>" . mysqli_error($mysqli) . "</p>";
            exit;
        }
    }else{
        echo "ID niet gevonden!";
    }

    if(mysqli_num_rows($result) > 0){
        $item = mysqli_fetch_array($result);

        $sleutelwoord_beoordeling = $item['sleutelwoord_beoordeling'];
        $beschrijving_beoordeling = $item['beschrijving_beoordeling'];
        
    }
    else{
        echo "<p>Geen items gevonden!</p>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Bewerken</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="./scripts/image-picker.scss">
</head>
<body class="loginPage">
    <form action="./beoordelingAanpasVerwerk.php" method="post" class="loginContainer">
        
        <fieldset>
            <legend>
                <h1>Pas beoordelingsysteem aan</h1>
            </legend>
            <input type="hidden" value="<?php echo $id; ?>" name="id">
            <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="datum">
            <input type="hidden" value="<?php echo $studentID; ?>" name="leerlingnummer">
            <label for="sleutelwoord_beoordeling">Soort beoordeling:</label>
            <select name="sleutelwoord_beoordeling" id="sleutelwoord" required>
                <optgroup label="Positieve beoordelingen">
                    <option value="Huiswerk gemaakt" <?=$sleutelwoord_beoordeling == 'Huiswerk gemaakt' ? ' selected="selected"' : ''?>>Huiswerk gemaakt</option>
                    <option value="Maaltijd opgegeten" <?=$sleutelwoord_beoordeling == 'Maaltijd opgegeten' ? ' selected="selected"' : ''?>>Maaltijd opgegeten</option>
                    <option value="Speelgoed opgeruimd" <?=$sleutelwoord_beoordeling == 'Speelgoed opgeruimd' ? ' selected="selected"' : ''?>>Speelgoed opgeruimd</option>
                    <option value="Goed gedragen" <?=$sleutelwoord_beoordeling == 'Goed gedragen' ? ' selected="selected"' : ''?>>Goed gedragen</option>
                    <option value="Iets anders positief" <?=$sleutelwoord_beoordeling == 'Iets anders positief' ? ' selected="selected"' : ''?>>Iets anders positief</option>
                </optgroup>

                <optgroup label="Negatieve beoordelingen">
                    <option value="Huiswerk niet gemaakt" <?=$sleutelwoord_beoordeling == 'Huiswerk niet gemaakt' ? ' selected="selected"' : ''?>>Huiswerk niet gemaakt</option>
                    <option value="Maaltijd niet opgegeten" <?=$sleutelwoord_beoordeling == 'Maaltijd niet opgegeten' ? ' selected="selected"' : ''?>>Maaltijd niet opgegeten</option>
                    <option value="Speelgoed niet opgeruimd" <?=$sleutelwoord_beoordeling == 'Speelgoed niet opgeruimd' ? ' selected="selected"' : ''?>>Speelgoed niet opgeruimd</option>
                    <option value="Niet goed gedragen" <?=$sleutelwoord_beoordeling == 'Niet goed gedragen' ? ' selected="selected"' : ''?>>Niet goed gedragen</option>
                    <option value="Iets anders negatief" <?=$sleutelwoord_beoordeling == 'Iets anders negatief' ? ' selected="selected"' : ''?>>Iets anders negatief</option>
                </optgroup>
            </select>
            <label for="beschrijving_beoordeling">Beschrijving:</label>
            <textarea name="beschrijving_beoordeling" cols="30" rows="10" maxlength="300" required><?php echo $beschrijving_beoordeling ?></textarea>
            <input type="submit" value="verzenden" class="button">
        </fieldset>
    </form>
    
</body>
</html>