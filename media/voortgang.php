<!-- Hier komt een groeps voortgang pagina. -->
<?php
    require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voortgang</title>
</head>
<body>
    <?php
        require 'config.php';
        $query = "SELECT * FROM `crud_agenda` ORDER BY `Prioriteit`";
        
        $result = mysqli_query($mysqli, $query);
        if(!$result){
            echo "<p>FOUT!</p>";
            echo "<p>" . $query . "</p>";
            echo "<p>" . mysqli_error($mysqli) . "</p>";
            exit;
        }
        $mysqli->close();

        if(mysqli_num_rows($result) > 0){
            while($item = mysqli_fetch_array($result)){
                $ID = $item['ID'];
                $ID_leerling = $item['Onderwerp'];
                $klas = $item['Inhoud'];
                $Begindatum = $item['Begindatum'];
                $Einddatum = $item['Einddatum'];
                $Prioriteit = $item['Prioriteit'];
                $Status = $item['Status'];
    
                echo 
                "<tr>
                    <td><a id='detaillls' href='detail.php?id=$ID'>Details &lAarr;</a></td>
                    <td>$Prioriteit</td>
                    <td>$Onderwerp</td>
                    <td>$Einddatum</td>
                    <td><a id='bewerken' href='pasaan.php?id=$ID'>Bewerken</a></td>
                    <td><a id='verwijderen' href='verwijder.php?id=$ID'>Verwijderen</a></td>
                </tr>";
            }
        }
        else{
            echo "<p>Geen items gevonden!</p>";
        }
    ?>
</body>
</html>