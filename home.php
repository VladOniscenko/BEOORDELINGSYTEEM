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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <!-- HEADER -->
    <header>
        <h1>Klasoverzicht</h1>
        <div>
            <a href="./toDB/loguit.php?message=U bent uitgelogd!">Uitlogen</a>
            <a href="./voortgang.php">Voortgang</a>
            <a href="./home.php">Klas</a>
            <a class="toevoegen" href="./studentToevoeg.php">Voeg een nieuw student toe</a>
        </div>        
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
                echo "<div class='row row-cols-1 row-cols-md-5 g-4'>";
                while($item = mysqli_fetch_assoc($result)){
                    echo "<div class='card'>";
                    echo "<img class='avatar card-img-top' src='./avatars/" . $item['avatar_leerling'] . "' width='100%'>";
                    echo "<h5 class='naam card-title'>" . $item['voornaam']." "."</h5>";
                    echo "<h6 class='achternaam card-subtitle'>". $item['achternaam']."</h6>";
                    echo "<a href='studentInformatie.php?id=".$item['leerlingnummer']."' class='btn btn-primary'>Info</a>";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
