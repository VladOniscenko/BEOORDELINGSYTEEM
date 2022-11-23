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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="h-100 d-flex align-items-center justify-content-center bg-dark">
        <div class="wrapper bg-light">
            <h1 class="p-4 mb-3">Registreren</h1>
            <form action="./toDB/registrVerwerk.php" method="post" class="p-4">

                <div class="mb-4">
                    <label for="gebruikersnaam" class="form-label">Gebruikersnaam</label>
                    <input type="text" name="gebruikersnaam" required min="5" max="50" placeholder="Gebruikersnaam" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" required max="50" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                        placeholder="E-mail" class="form-control">
                </div>


                <div class="mb-4">
                    <label for="wachtwoord" class="form-label">Wachtwoord</label>
                    <input type="password" name="wachtwoord" required min="5" max="50" placeholder="Wachtwoord" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="wachtwoordRepeat" class="form-label">Wachtwoord nogmaals</label>
                    <input type="password" name="wachtwoordRepeat" required min="5" max="50"
                        placeholder="Wachtwoord nogmaals" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="voornaam" class="form-label">Voornaam</label>
                    <input type="text" name="voornaam" required min="3" max="50" placeholder="Voornaam" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="achternaam" class="form-label">Achternaam</label>
                    <input type="text" name="achternaam" required min="3" max="50" placeholder="Achternaam" class="form-control">
                </div>

                <div class="mb-5">
                    <label for="geboorte" class="form-label">Geboortedatum</label>
                    <input type="date" name="geboorte" required placeholder="Geboortedatum" class="form-control">
                </div>


                <div class="btn-toolbar justify-content-between">
                    <a href="./index.php" class="btn btn-secondary">Terug naar inlog</a>
                    <input type="submit" name="verzend" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>



</body>

</html>