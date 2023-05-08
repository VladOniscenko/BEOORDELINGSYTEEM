<!-- Hier komt een registratie form. -->
<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registratie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="loginPage">
    
    <form action="./toDB/registrVerwerk.php" method="post" class="loginContainer">
        <?php
            if (isset($_GET['message'])) {
                $res = $_GET['message'];
                echo "<div>$res</div>";
            }
        ?>
        <fieldset>
            <legend><h1>Registreren</h1></legend>

            <label for="gebruikersnaam">Gebruikersnaam</label>
            <input type="text" name="gebruikersnaam" required min="5" max="50" placeholder="Gebruikersnaam">
            
            <label for="email">Email</label>
            <input type="email" name="email" required max="50" placeholder="E-mail">
            
            <label for="wachtwoord">Wachtwoord</label>
            <input type="password" name="wachtwoord" required  min="5" max="50" placeholder="Wachtwoord">
            
            <label for="wachtwoordRepeat">Wachtwoord nogmaals</label>
            <input type="password" name="wachtwoordRepeat" required  min="5" max="50" placeholder="Wachtwoord nogmaals">
            
            <label for="voornaam">Voornaam</label>
            <input type="text" name="voornaam" required min="3" max="50" placeholder="Voornaam">
            
            <label for="achternaam">Achternaam</label>
            <input type="text" name="achternaam" required min="3" max="50" placeholder="Achternaam">
            
            <label for="geboorte">Geboortedatum</label>
            <input type="date" name="geboorte" required placeholder="Geboortedatum">
            
            <div class="twoButtonContainer">
                <a href="./index.php">Terug naar inlog</a>
                <input type="submit" name="verzend">
            </div>
        
        </fieldset>


    </form>
</body>
</html>