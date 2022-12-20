<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>
<?php
    if(isset($_POST['username']) && isset($_POST['password'])){
        
        require 'config.php';

        $username = strtolower($_POST['username']);
        $password = $_POST['password'];

        $password = SHA1($password);
        
        if(strlen($username) > 0 && strlen($password) > 0){
         
            $query = "SELECT * FROM inlog_docent WHERE `gebruikersnaam` = '$username' AND `wachtwoord` = '$password'";
            $result = mysqli_query($mysqli, $query);

            if(mysqli_num_rows($result) == 1){
                $item = mysqli_fetch_assoc($result);
                $klas = $item['klas'];
                
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['klas'] = $klas;

                header("Location:../home.php");
            }
            else{
                header("location:../index.php?message=Naam en/of wachtwoord zijn fout.");
            }
        }
    }
?>