<?php
    require_once 'session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teogevoegd</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div id="bodyVerwijder">
        <a id="terugKnopDetails" href="./toonagenda.php">Terug</a><br><br>
        <?php
            session_start();
            if(isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrf_token"]){
                if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] == "https://85153.stu.sd-lab.nl/GLR/BASIS/P1/crud/toevoegForm.php"){
                    if(isset($_POST['verzend']) && isset($_POST['onderwerpVeld']) && isset($_POST['inhoudVeld']) && isset($_POST['begindatumVeld']) && isset($_POST['einddatumVeld']) && isset($_POST['prioriteitVeld']) && isset($_POST['statusVeld'])){
                        require 'config.php';

                        $Err = [];

                        $ond = $_POST['onderwerpVeld'];
                        if(empty($ond)){
                            array_push($Err, "Onderwerp mag niet leeg zijn!");
                        }
                        if(strlen($ond) > 30 && strlen($ond) < 0){
                            array_push($Err, "Onderwerp mag niet leeg zijn! En groter dan 30 karakters!");
                        }

                        $inh = $_POST['inhoudVeld'];
                        if(empty($inh)){
                            array_push($Err, "Inhoud mag niet leeg zijn!");
                        }
                        if(strlen($inh) > 200){
                            array_push($Err, "Inhoud mag niet groter zijn dan 200 karakters!");
                        }
                       
                        $begin = $_POST['begindatumVeld'];
                        $beginToDate = strtotime($begin);
                        $goede_datum_b = date('Y-m-d', $beginToDate);
                        if(empty($begin)){
                            array_push($Err, "Begindatum mag niet leeg zijn!");
                        }
                        if(!$begin == $goede_datum_b){
                            array_push($Err, "Begindatum komt niet overheen! $begin");
                        }
                        
                        $eind = $_POST['einddatumVeld'];
                        $eindToDate = strtotime($eind);
                        $goede_datum_e = date('Y-m-d', $eindToDate);
                        if(empty($eind)){
                            array_push($Err, "Einddatum mag niet leeg zijn!");
                        }
                        if(!$eind == $goede_datum_e){
                            array_push($Err, "Begindatum komt niet overheen! $eind");
                        }

                        $prior = $_POST['prioriteitVeld'];
                        if(empty($prior)){
                            array_push($Err, "Prioriteit mag niet leeg zijn!");
                        }
                        if(is_numeric($prior) && $prior < 1 && $prior > 5){
                            array_push($Err, "Prioriteit mag niet kleiner zijn dan 1 en groter dan 5!");
                        }

                        $stat = $_POST['statusVeld'];
                        if(empty($stat)){
                            array_push($Err, "Status mag niet leeg zijn!");
                        }
                        if($stat != "a" && $stat != "n" && $stat != "b"){
                            array_push($Err, "Status is niet bekend probeer nogmaals! |$stat|");
                        }

                        if(empty($Err)){
                            $query = "INSERT INTO `crud_agenda`(`Onderwerp`, `Inhoud`, `Begindatum`, `Einddatum`, `Prioriteit`, `Status`) VALUES ('{$ond}','{$inh}','{$begin}','{$eind}', {$prior},'{$stat}')";
                            $result = mysqli_query($mysqli, $query);

                            if($result){

                                echo "Het item is <span id='itemIsVerwijders'> toegevoegd!</span><br/>";

                            }else{

                                echo "FOUT bij toevoegen";
                                echo $query . "<br/>";
                                echo mysqli_error($mysqli);

                            }
                        }else{
                            for($i = 0; $i <= sizeof($Err)-1; $i++){
                                echo $Err[$i] . "</br></br>";
                            }
                        }

                    }else{
                        echo "HET FORMULIER IS NIET (GOED) VERSTUURD<br/>";
                    }
                }else{
                    echo "2 ER IS IETS MIS GEGAAN BIJ HET VERSTUREN VAN FORMULIER! PROBEER HET NOG MAALS<br/>";
                }
            }else{
                echo "1 ER IS IETS MIS GEGAAN BIJ HET VERSTUREN VAN FORMULIER! PROBEER HET NOG MAALS<br/>";
            }
            
        ?>
    </div>
</body>
</html>