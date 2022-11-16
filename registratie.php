<!-- Hier komt een registratie form. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registratie</title>
</head>
<body>
    <form action="./toDB/registrVerwerk.php" method="post">

        <input type="text" name="username" required max="50" placeholder="Gebruikersnaam">
        <input type="password" name="password" required max="30" placeholder="Wachtwoord">
        <input type="password" name="passwordRepeat" required max="30" placeholder="Wachtwoord nogmaals">
        <input type="text" name="Voornaam" required max="50" placeholder="Gebruikersnaam">
        <input type="text" name="Achternaam" required max="50" placeholder="Gebruikersnaam">
        <input type="date" name="Geboorte" required max="50" placeholder="Gebruikersnaam">

        <input type="submit" name="verzend">

    </form>
</body>
</html>