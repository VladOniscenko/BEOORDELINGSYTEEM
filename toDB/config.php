<?php
    //db_login
    $db_hostname = 'localhost';
    $db_username = 'basischool';
    $db_password = 'Theta_123456';
    $db_database = 'basisschool';

    $mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

    if(!$mysqli){
        echo "FOUT: geen connectie naar batabase. <br/>";
        echo "Error: " . mysqli_connect_error() . "<br/>";
        exit;
    }

?>