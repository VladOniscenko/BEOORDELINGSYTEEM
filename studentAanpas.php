<!-- Hier komt een pagina waar je gegevens kunt aanpassen van een student en avatar tovoegen/aanpassen. -->
<?php
    //sessie -->
    require_once './toDB/session.inc.php';

    //error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);








    if(isset($_GET['id'])){
        require './toDB/config.php';
        $id = $_GET['id'];

        $query = "SELECT * FROM tabel_leerlingen WHERE leerlingnummer = '$id'";
        $result = mysqli_query($mysqli, $query);
        if(!$result){
            echo "<p>FOUT!</p>";
            echo "<p> $query </p>";
            echo "<p>" . mysqli_error($mysqli) . "</p>";
            exit;
        }
    }else{
        echo "ID niet gevonden!";
    }
    if(mysqli_num_rows($result) > 0){
        $item = mysqli_fetch_array($result);

        $leerlingnummer = $item['leerlingnummer'];
        $voornaam = $item['voornaam'];
        $achternaam = $item['achternaam'];
        $geboortedatum = date('Y-m-d', strtotime ($item['geboortedatum']));
        $avatar = $item['avatar_leerling'];
        $Naam_Verzorger = $item['Naam_Verzorger'];
        $Email_Verzorger = $item['Email_Verzorger'];
        $Tel_Verzorger = $item['Tel_Verzorger'];
        $klas = $item['klas'];
    }
    else{
        echo "<p>Geen items gevonden!</p>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Bewerken</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <a href="./studentInformatie.php?id=<?php echo $id ?>">terug</a>
    <form action="./toDB/aanpasVerwerk.php" method="post">
        
        <div id="contentFormPasAan">
            <input type="hidden" value="<?php echo $leerlingnummer?>" name="leerlingnummer">

            <input type="text" name="voornaam" value="<?php echo $voornaam ?>">
            <input type="text" name="achternaam" value="<?php echo $achternaam ?>">
            <input type="date" name="geboortedatum" value="<?php echo $geboortedatum ?>">

            <input type="text" name="Naam_Verzorger" value="<?php echo $Naam_Verzorger ?>">
            <input type="email" name="Email_Verzorger" value="<?php echo $Email_Verzorger ?>">
            <input type="number" name="Tel_Verzorger" value="<?php echo $Tel_Verzorger ?>">

            
        </div>
        
        <input type="submit" value="verzenden">
    </form>
    <button><a href="./toDB/uitKlas.php?id=<?php echo $id ?>">Leerling verwijderen uit de klas</a></button>
</body>
</html>