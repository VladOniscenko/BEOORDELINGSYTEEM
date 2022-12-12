<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once 'session.inc.php';
    require 'config.php';

    if(isset($_POST['IDLeerling']) && isset($_POST['sleutelwoord']) && isset($_POST['beschrijving']) && isset($_POST['datum'])){
        $IDLeerling = $_POST['IDLeerling'];
        $klas = $_SESSION['klas'];
        $sleutelwoord = $_POST['sleutelwoord'];
        $beschrijving = $_POST['beschrijving'];
        $datum = $_POST['datum'];

        // echo $id . "<br />";
        // echo $IDLeerling . "<br />";
        echo $klas . "<br />";
        // echo $sleutelwoord . "<br />";
        // echo $beschrijving . "<br />";
        // echo $datum . "<br />";

        $query = "INSERT INTO `tabel_beoordelingen` VALUES (NULL,$IDLeerling,$klas,'$beschrijving','$sleutelwoord','$datum')";
        $result = mysqli_query($mysqli,$query);

        if($sleutelwoord == "Huiswerk gemaakt" || $sleutelwoord == "Maaltijd opgegeten" || $sleutelwoord == "Speelgoed opgeruimd" || $sleutelwoord == "Goed gedragen" || $sleutelwoord == "Iets anders positief"){
            $query2 = "UPDATE `tabel_leerlingen` SET `pluspunten_leerling` = `pluspunten_leerling` + 1 WHERE `leerlingnummer` = $IDLeerling";
        }
        elseif($sleutelwoord == "Huiswerk niet gemaakt" || $sleutelwoord == "Maaltijd niet opgegeten" || $sleutelwoord == "Speelgoed niet opgeruimd" || $sleutelwoord == "Niet goed gedragen" || $sleutelwoord == "Iets anders negatief"){
            $query2 = "UPDATE `tabel_leerlingen` SET `minpunten_leerling` = `minpunten_leerling` + 1 WHERE `leerlingnummer` = $IDLeerling";
        }

        $result2 = mysqli_query($mysqli,$query2); 

        if($result && $result2){
            header("location:../studentInformatie.php?id=$IDLeerling");
        }
        else{
            header("location:../studentInformatie.php?id=$IDLeerling&message=Er is een fout opgetreden bij het verwerken van uw verzoek.</br> Probeer het later nogmaals!");
            echo $query . "<br/>"; // de query tonen
            echo mysqli_error($mysqli); //de foutmelding tonen
        }
    }
?>

<!-- UPDATE `tabel_leerlingen` SET `minpunten_leerling` = `minpunten_leerling` - 1 WHERE `leerlingnummer` = 1;
UPDATE `tabel_leerlingen` SET `minpunten_leerling` = `minpunten_leerling` + 1 WHERE `leerlingnummer` = 1;

UPDATE `tabel_leerlingen` SET `pluspunten_leerling` = `pluspunten_leerling` - 1 WHERE `leerlingnummer` = 1;
UPDATE `tabel_leerlingen` SET `pluspunten_leerling` = `pluspunten_leerling` + 1 WHERE `leerlingnummer` = 1; -->