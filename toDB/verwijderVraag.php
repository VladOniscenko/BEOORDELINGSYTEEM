<?php
require_once 'session.inc.php';
require 'config.php';

if(isset($_GET['id'])&&isset($_GET['studentID'])){
    $id = $_GET['id'];
    $studentID = $_GET['studentID'];

    $query = "SELECT * FROM tabel_beoordelingen WHERE ID = $id";
    $result = mysqli_query($mysqli,$query);

    if(!$result){
        echo "<p>FOUT:</p>";
        echo "<p>" . $query . "</p>";
        
        echo "<p>" . mysqli_error($mysqli) . "</p>";
        exit;
    }
    
    if(mysqli_num_rows($result) > 0){
        echo "<h3>U heeft de volgende beoordeling gekozen:</h3>";
        echo "<table border='1px'><tr><th>Beschrijving beoordeling</th><th>Type beoordeling</th><th>Datum beoordeling</th></tr>";
        while($item = mysqli_fetch_assoc($result)){
            $sleutel = $item['sleutelwoord_beoordeling'];
        echo "<tr>";
    
        echo "<td>" .$item['beschrijving_beoordeling']."</td>";
        echo "<td>" .$item['sleutelwoord_beoordeling']."</td>";
        
        echo "<td>" .date('d-m-Y',strtotime($item['datum_beoordeling']))."</td>";
        }
        echo "</table><br><br>";
        echo "<strong>Wilt u beoordeling echt verwijderen?</strong> <br><br>";
        
        echo "<a href='verwijderBeoordeling.php?id=$id&studentID=$studentID&sleutel=$sleutel'>JA</a>";
        echo " --- ";
        
        echo "<a href='../studentInformatie.php?id=$studentID'>Nee</a>";
    }
    else{
        echo "Er is geen beoordeling gevonden met de meegestuurde id <br>";
    }
}

?>