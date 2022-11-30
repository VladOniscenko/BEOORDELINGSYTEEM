<!-- Hier komt een overzicht van groep. -->
<?php
    //sessie -->
    require_once './toDB/session.inc.php';

    //error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $klas = $_SESSION['klas'];
    require './toDB/config.php';
    $query = "SELECT * FROM tabel_leerlingen WHERE klas = '$klas'";
    $result = mysqli_query($mysqli,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klasoverzicht - GLRtje</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- HEADER -->
    <header>
        <img src="./media/logo.png" alt="logo">
        <a href="./toDB/loguit.php?message=U bent uitgelogd!">Uitlogen</a>       
    </header>

    <!-- MAIN -->
    <main>
        <div class="twoItemContainer">
            <div class="groupContainer">
                <img src='http://placekitten.com/50/50' alt='placeholder'>
                <div>Groep</div>
            </div>
            <div class="btn-group">
                <a href="./home.php">Klas</a>
                <a href="./voortgang.php">Voortgang</a>
            </div>
        </div>
        <?php
            if(mysqli_num_rows($result) > 0){
                // DIT IS WAT OP PAGINA KOMT
                echo "<div class='studentContainer'>";
                while($item = mysqli_fetch_assoc($result)){
                    echo "<div class='card'>";
                    echo "<img class='avatar' src='./avatars/" . $item['avatar_leerling'] . "' width='100%'>";
                    echo "<div>";
                    echo "<div class='naam'>" . $item['voornaam']." "."</div>";
                    echo "<div class='achternaam'>". $item['achternaam']."</div>";
                    echo "</div>";
                    echo "<div class='twoButtonContainer'>";
                    echo "<a href='studentInformatie.php?id=".$item['leerlingnummer']."'>Info</a>";
                    echo "<a href='studentInformatie.php?id=".$item['leerlingnummer']."'>Pas aan</a>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            }
            else
            {
                echo "<p>U heeft nog geen leerlingen toegevoegd aan uw klas!</p>";
            }
        ?>
        <a class="buttonRound" href="./studentToevoeg.php">+</a>
    </main>

    <!-- FOOTER -->
    <footer>

    </footer>
</body>
</html>
