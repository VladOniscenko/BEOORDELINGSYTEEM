<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  require_once 'session.inc.php';
  require 'config.php';

  if(isset($_POST['vrijeStudent'])){
    $klas= $_SESSION['klas'];
    $student_ID = $_POST['vrijeStudent'];

    $query = "UPDATE tabel_leerlingen SET klas = $klas WHERE leerlingnummer = $student_ID";
    //Voer de query uit en vang het 'resultaat' op
    //LET OP: het resultaat geeft aan of het wel of niet is gelukt ('true'/'false')
    $result = mysqli_query($mysqli,$query);

    $query2 = "UPDATE `tabel_beoordelingen` SET `klas`= $klas WHERE `ID_leerling` = $student_ID";
    $result2 = mysqli_query($mysqli,$query2);

    //Controleer of het is gelukt
    if($result){
      header("location:../home.php");
    }
    else{
        echo "FOUT bij toevoegen<br/>";
        echo $query . "<br/>"; // de query tonen
        echo mysqli_error($mysqli); //de foutmelding tonen
    }
  }else{
    header("location:../home.php?message=Geen student gevonden!");
  }
?>