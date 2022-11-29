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
                
                echo "
                    <div>
                        <div>bent u zeker om student `Naam` uit klas `naam klas` verwijderen?</div>
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