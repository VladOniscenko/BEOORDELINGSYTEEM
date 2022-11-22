<!-- Hier komt een overzicht van groep. -->
<?php
    require_once './toDB/session.inc.php';
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
        <h1>Klasoverzicht</h1>
        <a href="./toDB/loguit.php?message=U bent uitgelogd!">Uitlogen</a>
        <a href="./voortgang.php">Voortgang</a>
        <a href="./home.php">Klas</a>
        <a class="toevoegen" href="">Voeg een nieuw student toe</a>        
    </header>

    <!-- MAIN -->
    <main>
        <?php
            $klas = $_SESSION['klas'];
            require './toDB/config.php';
            $query = "SELECT * FROM tabel_leerlingen WHERE klas = '$klas'";
            $result = mysqli_query($mysqli,$query);

            if(!$result){
                echo "<p>FOUT:</p>";
                echo "<p>" . $query . "</p>";
                echo "<p>" . mysqli_error($mysqli) . "</p>";
                exit;
            }

            if(mysqli_num_rows($result) > 0){
                // DIT IS WAT OP PAGINA KOMT
                echo "<div class='container'>";
                while($item = mysqli_fetch_assoc($result)){
                    echo "<div class='student'>";
                    echo "<img class='avatar' src='" . $item['avatar_leerling'] . "' width='75' height = '90'>";
                    echo "<div class='naam'>" . $item['voornaam']." "."</div>";
                    echo "<div class='achternaam'>". $item['achternaam']."</div>";
                    echo "<a href='studentInformatie.php?id=".$item['leerlingnummer']."'>Info</a>";
                    echo "</div>";
                }
                echo "</div>";
            }
            else
            {
                echo "<p>U heeft nog geen leerlingen toegevoegd aan uw klas!</p>";
            }
        ?>
    </main>

    <!-- FOOTER -->
    <footer>

    </footer>
</body>
</html>
