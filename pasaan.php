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
    <title>Gegevens aanpassen</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    

    <form id="formPasAan" name="agendaFormulier" action="./aanpasVerwerk.php" method="post">

        <a id="terugKnopDetails" href="./toonagenda.php">Terug</a>
        <h1 id="detailKop">Taak bewerken</h1>
        
        <?php
            if(isset($_GET['id'])){
                require 'config.php';
                $id = $_GET['id'];

                $query = "SELECT * FROM crud_agenda WHERE ID = '$id'";
                $result = mysqli_query($mysqli, $query);
                if(!$result){
                    echo "<p>FOUT!</p>";
                    echo "<p>" . $query . "</p>";
                    echo "<p>" . mysqli_error($mysqli) . "</p>";
                    exit;
                }
            }else{
                echo "ID niet gevonden!";
            }
            if(mysqli_num_rows($result) > 0){
                while($item = mysqli_fetch_array($result)){
                    $ID = $item['ID'];
                    $Onderwerp = $item['Onderwerp'];
                    $Inhoud = $item['Inhoud'];
                    $Begindatum = $item['Begindatum'];
                    $Einddatum = $item['Einddatum'];
                    $Prioriteit = $item['Prioriteit'];
                    $Status = $item['Status'];
                    $middle = strtotime ($Begindatum);
                    $new_date = date('Y-m-d', $middle);
                
                    echo "
                    <div id=details>
                        <div><span>Onderwerp:</span> $Onderwerp</div>
                        <div><span>Inhoud:</span> $Inhoud</div>
                        <div><span>Begindatum:</span> $Begindatum</div>
                        <div><span>Einddatum:</span> $Einddatum</div>
                        <div><span>Prioriteit:</span> $Prioriteit</div>
                        <div><span>Status:</span> $Status</div>
                    </div>";
                                
                }
            }
            else{
                echo "<p>Geen items gevonden!</p>";
            }
        ?>

        <div id="contentFormPasAan">

            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">

            <input type="hidden" name="idVeld" value="<?php echo $ID ?>">
            <label for="onderwerpVeld">Onderwerp: </label>
            <input type="text" name="onderwerpVeld" max="30" value="<?php echo $Onderwerp ?>" required>

            <label for="inhoudVeld">Inhoud: </label>
            <textarea name="inhoudVeld" cols="1" max="200" rows="5" required><?php echo $Inhoud ?></textarea>
            
            <label for="begindatumVeld">Begindatum: </label>
            <input type="date" name="begindatumVeld" value="<?php echo $new_date ?>" required>
            
            <label for="einddatumVeld">Einddatum: </label>
            <input type="date" name="einddatumVeld" required value="<?php echo $Einddatum ?>">

            <label for="prioriteitVeld">Prioriteit: </label>
            <input type="number" name="prioriteitVeld" min="1" max="5" value="<?php echo $Prioriteit ?>" required>

            <label for="statusVeld">Status: </label>
            <select name="statusVeld">
                <option value="n" <?=$Status == 'n' ? ' selected="selected"' : ''?>>Niet begonen</option>
                <option value="b" <?=$Status == 'b' ? ' selected="selected"' : ''?>>Begonen</option>
                <option value="a" <?=$Status == 'a' ? ' selected="selected"' : ''?>>Afgerond</option>
            </select>

            <input type="submit" name="verzend">
        </div>
        
    </form>
</body>
</html>