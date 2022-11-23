<!-- Hier komt een inlog form. -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inlog</title>
    <link rel="stylesheet" href="style.sass">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
<div class="h-100 d-flex align-items-center justify-content-center bg-dark">
    <div class="wrapper bg-light border-3">
        <h1 class="p-4 mb-3">Inloggen</h1>
        <form action="./toDB/inlogVerwerk.php" method="post" class="p-4">
            <?php
                if (isset($_GET['message'])) {
                    $res = $_GET['message'];
                    echo "<div>$res</div>";
                }
                ?>

            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" required max="50" placeholder="Username" class="form-control">
            </div>    
            <div class="mb-5">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" required max="30" placeholder="Password" class="form-control">
            </div>

            <div class="btn-toolbar justify-content-between">
                <a href="registratie.php" class="btn btn-secondary">Registreren</a>
                <input type="submit" name="verzend" value="inloggen" class="btn btn-primary">
            </div>


        </form>
    </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>