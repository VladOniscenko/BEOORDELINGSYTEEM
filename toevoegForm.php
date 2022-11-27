<?php
    session_start();
    $token = bin2hex(openssl_random_pseudo_bytes(32));
    $_SESSION['token'] = $token;
?>
<?php
    require_once 'session.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toevoegen</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    
    <form id="formPasAan" action="./toevoegVerwerk.php" method="post">

        <a id="terugKnopDetails" href="./toonagenda.php">Terug</a>
        <h1 id="detailKop">Taak toevoegen</h1>

        <div id="contentFormPasAan">
            
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
            
            <label for="onderwerpVeld">Onderwerp: </label>
            <input type="text" name="onderwerpVeld" placeholder="Mijn kamer schoonmaken." min="5" max="30" required>

            <label for="inhoudVeld">Inhoud: </label>
            <textarea name="inhoudVeld" cols="1" rows="5" placeholder="Stofzuigen , dweilen, vuilnis weggooien" min="15" max="200" required></textarea>
            
            <label for="begindatumVeld">Begindatum: </label>
            <input type="date" name="begindatumVeld" value="<?php echo date('Y-m-d'); ?>" required>
            
            <label for="einddatumVeld">Einddatum: </label>
            <input type="date" name="einddatumVeld" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" required>

            <label for="prioriteitVeld">Prioriteit: </label>
            <input type="number" name="prioriteitVeld" placeholder="1 - 5" min="1" max="5" value="3" required>

            <label for="statusVeld">Status: </label>
            <select name="statusVeld">
                <option value="n">Niet begonen</option>
                <option value="b">Begonen</option>
                <option value="a">Afgerond</option>
            </select>
            <input id="submitToevoeg" type="submit" name="verzend">
        </div>
           
    </form>
</body>
</html>