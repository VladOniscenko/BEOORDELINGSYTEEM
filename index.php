<!-- Hier komt een inlog form. -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inlog</title>
</head>
<body>
    
    <a href="index.php">Inlogen</a>

    <form action="./toDB/inlogVerwerk.php" method="post">

        <?php
            if(isset($_GET['result'])){
                $res = $_GET['result'];
                echo "<div>$res</div>";
            }
        ?>

        <input type="text" name="username" required max="50" placeholder="Username">
        <input type="password" name="password" required max="30" placeholder="Password">
        <input type="submit" name="verzend">
        
    </form>

    <a href="registratie.php">Een nieuwe account aanmaken</a>

</body>
</html>