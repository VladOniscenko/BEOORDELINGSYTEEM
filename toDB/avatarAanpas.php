<?php
    //sessie -->
    require_once './session.inc.php';

    //error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        header('Location: ../home.php');
    }

    if(isset($_GET['avatar'])){
        require './config.php';
        $avatar = $_GET['avatar'];

        $query = "UPDATE `tabel_leerlingen` SET `avatar_leerling`='$avatar' WHERE `leerlingnummer` = $id";
        $result = mysqli_query($mysqli, $query);

        if($result){
            header("Location: ../studentAanpas.php?id=$id");
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avatar</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="containeravatars">
        <a href="avatarAanpas.php?avatar=avatar (1).png&id=<?php echo $id?>"><img src="../avatars/avatar (1).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (2).png&id=<?php echo $id?>"><img src="../avatars/avatar (2).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (3).png&id=<?php echo $id?>"><img src="../avatars/avatar (3).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (4).png&id=<?php echo $id?>"><img src="../avatars/avatar (4).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (5).png&id=<?php echo $id?>"><img src="../avatars/avatar (5).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (6).png&id=<?php echo $id?>"><img src="../avatars/avatar (6).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (7).png&id=<?php echo $id?>"><img src="../avatars/avatar (7).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (8).png&id=<?php echo $id?>"><img src="../avatars/avatar (8).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (9).png&id=<?php echo $id?>"><img src="../avatars/avatar (9).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (10).png&id=<?php echo $id?>"><img src="../avatars/avatar (10).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (11).png&id=<?php echo $id?>"><img src="../avatars/avatar (11).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (12).png&id=<?php echo $id?>"><img src="../avatars/avatar (12).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (13).png&id=<?php echo $id?>"><img src="../avatars/avatar (13).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (14).png&id=<?php echo $id?>"><img src="../avatars/avatar (14).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (15).png&id=<?php echo $id?>"><img src="../avatars/avatar (15).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (16).png&id=<?php echo $id?>"><img src="../avatars/avatar (16).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (17).png&id=<?php echo $id?>"><img src="../avatars/avatar (17).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (18).png&id=<?php echo $id?>"><img src="../avatars/avatar (18).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (19).png&id=<?php echo $id?>"><img src="../avatars/avatar (19).png" alt=""></a>
        <a href="avatarAanpas.php?avatar=avatar (20).png&id=<?php echo $id?>"><img src="../avatars/avatar (20).png" alt=""></a>        
    </div>

</body>
</html>