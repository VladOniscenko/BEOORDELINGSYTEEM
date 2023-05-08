<?php
    require_once 'session.inc.php';
    require 'config.php';
    
    if(isset($_GET['id']) && isset($_GET['studentID']) && isset($_GET['sleutel'])){
        $id = $_GET['id'];
        $studentID = $_GET['studentID'];
        $sleutelwoord = $_GET['sleutel'];

        $query = "DELETE FROM `tabel_beoordelingen` WHERE ID = $id";
        $result = mysqli_query($mysqli,$query);

        if($sleutelwoord == "Huiswerk gemaakt" || $sleutelwoord == "Maaltijd opgegeten" || $sleutelwoord == "Speelgoed opgeruimd" || $sleutelwoord == "Goed gedragen" || $sleutelwoord == "Iets anders positief"){
            $query2 = "UPDATE `tabel_leerlingen` SET `pluspunten_leerling` = `pluspunten_leerling` - 1 WHERE `leerlingnummer` = $studentID";
        }
        elseif($sleutelwoord == "Huiswerk niet gemaakt" || $sleutelwoord == "Maaltijd niet opgegeten" || $sleutelwoord == "Speelgoed niet opgeruimd" || $sleutelwoord == "Niet goed gedragen" || $sleutelwoord == "Iets anders negatief"){
            $query2 = "UPDATE `tabel_leerlingen` SET `minpunten_leerling` = `minpunten_leerling` - 1 WHERE `leerlingnummer` = $studentID";
        }

        $result2 = mysqli_query($mysqli,$query2); 

        if($result && $result2){
            header("location:../studentInformatie.php?id=$studentID");
        }
        else{
            echo "FOUT bij aanpassen:<br/>";
            echo $query . "<br/>"; // de query tonen
            echo mysqli_error($mysqli); // de foutmelding tonen
        }     
    }
?>