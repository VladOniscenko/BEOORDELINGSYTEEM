<?php
require 'config.php';
if(isset($_GET['id'])&&isset($_GET['studentID'])){
    $id = $_GET['id'];
    $studentID = $_GET['studentID'];
    $query = "DELETE FROM tabel_beoordelingen WHERE ID = $id";
    $result = mysqli_query($mysqli,$query);

    if($result){
        header("location:../studentInformatie.php?id=$studentID");
    }
    else{
        echo "FOUT bij aanpassen:<br/>";
        echo $query . "<br/>"; // de query tonen
        echo mysqli_error($mysqli); // de foutmelding tonen
    }     
}


?>