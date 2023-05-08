<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once 'session.inc.php';
    require 'config.php';

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sleutelwoord_beoordeling = $_POST['sleutelwoord_beoordeling'];
        $datum = $_POST['datum'];
        $beschrijving_beoordeling = $_POST['beschrijving_beoordeling'];
        $leerlingnummer = $_POST['leerlingnummer'];


        $query = "UPDATE `tabel_beoordelingen` SET `beschrijving_beoordeling`='$beschrijving_beoordeling',`sleutelwoord_beoordeling`='$sleutelwoord_beoordeling',`datum_beoordeling`='$datum' WHERE `ID` = $id";
        $result = mysqli_query($mysqli,$query);

        if($result){
            header("location:../studentInformatie.php?id=$leerlingnummer");
        }else{
            header("location:../studentInformatie.php?id=$leerlingnummer&message=Er is een fout opgetreden bij het verwerken van uw verzoek.</br> Probeer het later nogmaals!");
        }
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

</body>
</html>