<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>

<?php
    require_once './session.inc.php';
?>

<?php
    if(isset($_POST['IDLeerling']) && isset($_POST['klas']) && isset($_POST['sleutelwoord']) && isset($_POST['beoordeling']) && isset($_POST['beschrijving'])){
        
        require 'config.php';

        $username = $_POST['username'];
        $password = $_POST['password'];

    }
?>