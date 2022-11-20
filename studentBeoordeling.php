<!-- Hier komt een pagina waar je een beoordeling kunt geven aan een student. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beoordeling</title>
</head>
<body>
    <a href="./home.php">terug naar info leerling</a>
    <form action="">
        <!-- id = null -->

        <!-- IDLeerling -->
        <input type="hidden" value="3" name="IDLeerling" id="IDLeerling">

        <!-- klas -->
        <input type="hidden" value="alpha" name="klas" id="klas">

        <!-- sleutelwoord // Onderwerp -->
        <select name="sleutelwoord" id="sleutelwoord">
            <option value="huiswerk">Huiswerk</option>
            <option value="ontbijt">Ontbijt</option>
            <option value="speeltijd">Speeltijd</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="iets anders.">iets anders.</option>
        </select>

        <!-- soort beoordeling -->
        <select name="beoordeling" id="beoordeling">
            <option value="positief">Positief</option>
            <option value="negatief">Negatief</option>
        </select>

        <!-- beschrijving -->
        <textarea name="beschrijving" id="beschrijving" cols="30" rows="10" maxlength="300"></textarea>

        
        <input type="submit" value="Verzenden">
    </form>
</body>
</html>