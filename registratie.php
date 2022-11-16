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
</head>
<body>
    <a href="./index.php">Terug naar inlog</a>
    <form action="./toDB/registrVerwerk.php" method="post">

        <input type="text" name="gebruikersnaam" required min="5" max="50" placeholder="Gebruikersnaam">
        <input type="password" name="wachtwoord" required  min="5" max="50" placeholder="Wachtwoord">
        <input type="password" name="wachtwoordRepeat" required  min="5" max="50" placeholder="Wachtwoord nogmaals">
        <input type="text" name="voornaam" required min="3" max="50" placeholder="Voornaam">
        <input type="text" name="achternaam" required min="3" max="50" placeholder="Achternaam">
        <input type="date" name="geboorte" required placeholder="Geboortedatum">
        <input type="email" name="email" required max="50" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="E-mail">

        <input type="submit" name="verzend">

    </form>
</body>
</html>