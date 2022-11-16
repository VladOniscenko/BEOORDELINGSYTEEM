<?php
    require_once 'session.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <header>
        <a href="toonagenda.php">Home</a>
        <a href="loguit.php">Uitlogen</a>
    </header>
    <header>
        <a href="./toonagenda.php">Alle</a>
        <a href="./toonagenda.php?sortPrior=1">Prioriteit 1</a>
        <a href="./toonagenda.php?sortPrior=2">Prioriteit 2</a>
        <a href="./toonagenda.php?sortPrior=3">Prioriteit 3</a>
        <a href="./toonagenda.php?sortPrior=4">Prioriteit 4</a>
        <a href="./toonagenda.php?sortPrior=5">Prioriteit 5</a>
    </header>
    <table id="toonAgendaTable">
        <thead>
            <tr>
            <th>Detailas</th>
            <th><a href="./toonagenda.php?sort=Prioriteit">Prioriteit &dArr;</a></th>
            <th><a href="./toonagenda.php?sort=Onderwerp">Onderwerp &dArr;</a></th>
            <th><a href="./toonagenda.php?sort=Einddatum">Deadline &dArr;</a></th>
            <th>Bewerken</a></th>
            <th>Verwijderen</a></th>
        </tr>
        </thead>

        <tbody>
            <?php
                if(isset($_GET['sort'])){
                    $sorteerOp = $_GET['sort'];
                    $query = "SELECT * FROM `crud_agenda` ORDER BY `{$sorteerOp}`";
                }
                
                elseif(isset($_GET['sortPrior'])){
                    $sortPrior = $_GET['sortPrior'];
                    $query = "SELECT * FROM `crud_agenda` WHERE prioriteit = $sortPrior";
                }
                
                else{
                    $query = "SELECT * FROM `crud_agenda`";
                }
                require 'config.php';
                //$query = "SELECT * FROM `crud_agenda` ORDER BY `Prioriteit`";
                
                $result = mysqli_query($mysqli, $query);
                if(!$result){
                    echo "<p>FOUT!</p>";
                    echo "<p>" . $query . "</p>";
                    echo "<p>" . mysqli_error($mysqli) . "</p>";
                    exit;
                }
                $mysqli->close();

                if(mysqli_num_rows($result) > 0){
                    while($item = mysqli_fetch_array($result)){
                        $ID = $item['ID'];
                        $Onderwerp = $item['Onderwerp'];
                        $Inhoud = $item['Inhoud'];
                        $Begindatum = $item['Begindatum'];
                        $Einddatum = $item['Einddatum'];
                        $Prioriteit = $item['Prioriteit'];
                        $Status = $item['Status'];
            
                        echo 
                        "<tr>
                            <td><a id='detaillls' href='detail.php?id=$ID'>Details &lAarr;</a></td>
                            <td>$Prioriteit</td>
                            <td>$Onderwerp</td>
                            <td>$Einddatum</td>
                            <td><a id='bewerken' href='pasaan.php?id=$ID'>Bewerken</a></td>
                            <td><a id='verwijderen' href='verwijder.php?id=$ID'>Verwijderen</a></td>
                        </tr>";
                    }
                }
                else{
                    echo "<p>Geen items gevonden!</p>";
                }
            ?>
        </tbody>

        <tfoot>
            <td id="mijnTFoot" colspan="7"><a id="knopToevoegTFoot" href="./toevoegForm.php">Toevoegen</a></td>
        </tfoot>
    </table>
</body>
</html>