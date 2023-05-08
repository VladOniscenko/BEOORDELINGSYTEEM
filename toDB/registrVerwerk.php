<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>

<?php
// LATER VERWERKEN!
// if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] == "https://85153.stu.sd-lab.nl/GLR/BASIS/P1/crud/toevoegForm.php"){}
        require 'config.php';
        $err = [];

        if(isset($_POST['gebruikersnaam']) == false || empty($_POST['gebruikersnaam'])){
            array_push($err, "Gebruikersnaam is niet goed verzonden!");
        }

        if(isset($_POST['wachtwoord']) == false || empty($_POST['wachtwoord'])){
            array_push($err, "Wachtwoord is niet goed verzonden!");
        }

        if(isset($_POST['wachtwoordRepeat']) == false || empty($_POST['wachtwoordRepeat'])){
            array_push($err, "WachtwoordRepeat is niet goed verzonden!");
        }
        
        if(isset($_POST['voornaam']) == false || empty($_POST['voornaam'])){
            array_push($err, "Voornaam is niet goed verzonden!");
        }

        if(isset($_POST['achternaam']) == false || empty($_POST['achternaam'])){
            array_push($err, "Achternaam is niet goed verzonden!");
        }

        if(isset($_POST['geboorte']) == false || $_POST['geboorte'] != date('Y-m-d', strtotime($_POST['geboorte']))){
            array_push($err, "Geboorte datum is niet goed verzonden!");
        }

        if(isset($_POST['email']) == false || empty($_POST['email'])){
            array_push($err, "Email adres is niet goed verzonden!");
        }

        if($_POST['wachtwoord'] != $_POST['wachtwoordRepeat']){
            header("location:../registratie.php?message=Wachtwoord komt niet overheen");
        }

        //CONTROLE OP ERRORS
        if(!empty($err)){
            header("location:../registratie.php?message=$err");
        }
        //ALS ER GEEN ERRORS ZIJN CONTROLEER IK OF ER GEEN DEZELFDE USERNAME IS
        else{
            $usernameToCheck = $_POST['gebruikersnaam'];
            $query = "SELECT * FROM inlog_docent WHERE `gebruikersnaam` = '$usernameToCheck'";
            $result = mysqli_query($mysqli, $query);
            
           //ALS ER DEZELFDE USERNAME BESTAAT GEEFT DIE EEN ERROR AAN
            if(mysqli_num_rows($result) > 0){

                header("location:../registratie.php?message=Gebruikersnaam is al in gebruik!");
            }
            else{

                $userN = strtolower($_POST['gebruikersnaam']);
                $getPass = $_POST['wachtwoord'];
                $passW = SHA1($getPass);
                $voorN = strtolower($_POST['voornaam']);
                $achterN = strtolower($_POST['achternaam']);
                $geboorteD = $_POST['geboorte'];
                $eMail = strtolower($_POST['email']);


                $insertQuery = "INSERT INTO `inlog_docent`(`ID`, `gebruikersnaam`, `wachtwoord`, `voornaam_docent`, `achternaam_docent`, `geboortedatum_docent`, `email_docent`) VALUES (NULL,'$userN','$passW','$voorN','$achterN','$geboorteD','$eMail')";
                $insertResult = mysqli_query($mysqli, $insertQuery);

                if($insertResult){
                    header("location:../index.php?message=Uw account is succsesvol aangemaakt!");
                }else{
                    $delQuery = "DELETE FROM `inlog_docent` WHERE `gebruikersnaam` = '$userN'";
                    $delResult = mysqli_query($mysqli, $delQuery);

                    header("location:../index.php?message=Uw account is niet aangemaakt probeer later nog maals!");
                }
            }
        }
?>