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
    <form action="./toDB/inlogVerwerk.php" method="post">

    <h1><a href="inlog.php">Inlogen</a></h1>

    <?php
        if(isset($_GET['result'])){
            $res = $_GET['result'];
            echo "<div>$res</div>";
        }
    ?>
    <div id="contentFormPasAan">

        <input type="text" name="username" required max="50" placeholder="Username">
        <input type="password" name="password" required max="30" placeholder="Password">
        
        <input id="submitToevoeg" type="submit" name="verzend">
    </div>
    
    </form>
</body>
</html>