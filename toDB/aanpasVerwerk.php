<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require_once 'session.inc.php';
    require 'config.php';
    if(isset($_POST['leerlingnummer']) && isset($_POST['voornaam']) && isset($_POST['achternaam']) && isset($_POST['geboortedatum']) && isset($_POST['Naam_Verzorger']) && isset($_POST['Email_Verzorger']) && isset($_POST['Tel_Verzorger'])){
        $leerlingnummer = $_POST['leerlingnummer'];
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $geboortedatum = $_POST['geboortedatum'];
        $Naam_Verzorger = $_POST['Naam_Verzorger'];
        $Email_Verzorger = $_POST['Email_Verzorger'];
        $Tel_Verzorger = $_POST['Tel_Verzorger'];


        $query = "UPDATE `tabel_leerlingen` SET `voornaam`='$voornaam',`achternaam`='$achternaam',`geboortedatum`='$geboortedatum',`Naam_Verzorger`='$Naam_Verzorger',`Email_Verzorger`='$Email_Verzorger',`Tel_Verzorger`='$Tel_Verzorger' WHERE `leerlingnummer` = $leerlingnummer";
        $result = mysqli_query($mysqli,$query);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aanpas</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php
        if($result){
            echo "
                
                <h1>Aanpassing is verwerkt!</h1>
                <h1><a href='../studentInformatie.php?id=$leerlingnummer'>terug</a></h1>
            ";
        }
        else{
            echo "
                <h1>Aanpassing is niet verwerkt! Probeer later nogmaals!</h1>
                <h1><a href='../studentInformatie.php?id=$leerlingnummer'>terug</a></h1>
            ";
        }
    ?>
</body>
</html>