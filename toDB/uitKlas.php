<?php
    require_once 'session.inc.php';
    require 'config.php';

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- //HEADER -->
    <header></header>
    
    <!-- //MAIN -->
    <main>
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $query = "SELECT * FROM tabel_leerlingen WHERE leerlingnummer = $id";
                $result = mysqli_query($mysqli,$query);
                $item = mysqli_fetch_assoc($result);
                $st_naam = $item['voornaam'];
                $achternaam = $item['achternaam'];
                $klas_nr = $item['klas'];
                $query2 = "SELECT * FROM tabel_groepen WHERE ID = $klas_nr";
                $result2 = mysqli_query($mysqli,$query2);
                $item2 = mysqli_fetch_assoc($result2);
                $klas_naam = $item2['naam_klas'];
                
                echo "
                    <div>
                        <div>Wenst u om student `$st_naam $achternaam` uit klas `$klas_naam` verwijderen?</div>
                        <div><a href='./uitKlasVerwerk.php?id=$id'>Ja</a></div>
                        <div><a href='../studentInformatie.php?id=$id'>Nee</a></div>
                    </div
                 ";
            }
        ?>
    </main>
    <!-- //FOOTER -->
    <footer></footer>
</body>
</html>