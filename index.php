<!-- Hier komt een inlog form. -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inlog</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="loginPage">



    <form action="./toDB/inlogVerwerk.php" method="post" class="loginContainer">
        <fieldset>
            <legend>
                <h1>Inloggen</h1>
            </legend>

            <?php
                if (isset($_GET['message'])) {
                    $res = $_GET['message'];
                    echo "<div>$res</div>";
                }
            ?>
            <label for="username">Username</label>
            <input type="text" name="username" required max="50" placeholder="Username">
            <label for="password">Password</label>
            <input type="password" name="password" required max="30" placeholder="Password" class="mb90px">
            <div class="twoButtonContainer">
                <a href="registratie.php">Registreren</a>
                <input type="submit" name="verzend" value="inloggen" class="button">
            </div>

        </fieldset>


    </form>



</body>

</html>