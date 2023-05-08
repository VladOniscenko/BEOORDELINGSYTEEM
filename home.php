<!-- Hier komt een overzicht van groep. -->
<?php
    //sessie -->
    require_once './toDB/session.inc.php';

    //error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $klas = $_SESSION['klas'];
    require './toDB/config.php';
    if($klas != NULL){
        $query = "SELECT * FROM tabel_leerlingen WHERE klas = '$klas'";
        $result = mysqli_query($mysqli,$query);

        $query2 = "SELECT * FROM tabel_groepen WHERE ID = '$klas'";
        $result2 = mysqli_query($mysqli,$query2);
        $item2 = mysqli_fetch_assoc($result2);
        $klas_naam = $item2['naam_klas'];        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klasoverzicht - GLRtje</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="script.js"></script>
</head>
<body>
    <!-- HEADER -->
    <header>
        <img src="./media/logo.png" alt="logo">
        <a href="./toDB/loguit.php?message=U bent uitgelogd!" class="material-symbols-outlined logout">logout</a>       
    </header>
    <?php 
    
        if($klas == NULL || $klas == 0){
            echo "<h1>Er is nog geen klas aan u toegewezen!</h1>";
            echo "<h1>Neem contact op met uw ICT-afdeling voor meer informatie.</h1>";
        }else{

    ?>

    <!-- MAIN -->
    <main>
        <div class="twoItemContainer">
            <div class="groupContainer">
            <span class="material-symbols-outlined groupIcon">
                groups
            </span>
                <div>Groep <?php echo $klas_naam?></div>
            </div>
            <div class="btn-group">
                <a href="./home.php" class="selected">Klas</a>
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
                    echo "<div class='naam'>" . $item['voornaam'].' '. $item['achternaam']." "."</div>";
                    echo "</div>";
                    echo "<div class='twoButtonContainer'>";
                    echo "<a href='studentInformatie.php?id=".$item['leerlingnummer']."'>Info</a>";
                    echo "<a href='studentAanpas.php?id=".$item['leerlingnummer']."'>Aanpassen</a>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            }
            else
            {
                echo "<h1>U heeft nog geen leerlingen toegevoegd aan uw klas!</h1>";
            }

            if(isset($_GET['message'])){
                $message = $_GET['message'];
                echo "<h1>$message</h1>";
            }
        ?>
        <button class="buttonRound" href="./studentToevoeg.php" id="studentToevoegKnop"  onclick="hideToevoegContainer(0)">
            <span class="material-symbols-outlined">
                add
            </span>
        </button>
    </main>
    <?php
        require './toDB/config.php';

        $query = "SELECT * FROM tabel_leerlingen WHERE klas = 0";
        $result = mysqli_query($mysqli,$query);

    echo "<div class='hiddenContainer'>";
    echo "<button onclick='hideToevoegContainer(0)' class='closebtn'>
            <span class='material-symbols-outlined'>
                close
            </span>
        </button>";
        if(!$result){
            echo "<p>FOUT:</p>";
            echo "<p>" . $query . "</p>";
            echo "<p>" . mysqli_error($mysqli) . "</p>";
            exit;
        }

            //Als er records zijn...
        if(mysqli_num_rows($result) > 0){
            //maak een select-item
            echo "<h3>Studenten zonder klas</h3>";
            echo "<form method='post' action='./toDB/toevoegVerwerk.php'>";
            echo "<select class='vrijeStudenten' name='vrijeStudent'>";
            echo "<option selected disabled>Kies een student</option>";
            //zolang er items uit te lezen zijn...
            while($item = mysqli_fetch_assoc($result)){
                //toon de gegevens van het item in een tabelrij
                echo "<option class='student' value='".$item['leerlingnummer']."'>".$item['voornaam']." ". $item['achternaam'] . " " . date('d-m-Y', strtotime($item['geboortedatum'])). "</option>";
            }
            echo "</select><br>";
            echo "<input type='submit' class='submit button' name='submit' value='Student toevoegen'/>";
            echo "</form>";
        }
        //Als er geen records zijn...
        else
        {
            echo "<p>Geen student zonder klas gevonden in het systeem!</p>";
            //echo $klas ."<br>";
            //echo $id . "<br>";
        }
    echo "</div>";
    ?>
    <!-- FOOTER -->
    <footer>

    </footer>

    <?php }?>
</body>
</html>
