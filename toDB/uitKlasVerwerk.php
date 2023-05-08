<?php
    require_once 'session.inc.php';
    require 'config.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "UPDATE `tabel_leerlingen` SET `klas`= 0 WHERE `leerlingnummer` = $id";
        $result = mysqli_query($mysqli,$query);

        $query = "UPDATE `tabel_beoordelingen` SET `klas`= 0 WHERE `ID_leerling` = $id";
        $result = mysqli_query($mysqli,$query);

        if($result){
            header("location:../home.php");
        }
        else{
            echo "FOUT bij aanpassen:<br/>";
            echo $query . "<br/>";
            echo mysqli_error($mysqli); 
        }     
    }
?>