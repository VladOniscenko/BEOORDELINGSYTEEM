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
        <input type="hidden" value="1" name="klas" id="klas">

        <!-- sleutelwoord // Onderwerp -->
        <select name="sleutelwoord" id="sleutelwoord">
            <option value="huiswerk">Huiswerk gemaakt</option>
            <option value="ontbijt">Maaltijd opgegeten</option>
            <option value="speeltijd">Speelgoed opgeruimd</option>
            <option value="gedrag">Goed gedragen</option>
            <option value="iets anders.">Iets anders positief</option>

            <option value="huiswerk">Huiswerk niet gemaakt</option>
            <option value="ontbijt">Maaltijd niet opgegeten</option>
            <option value="speeltijd">Speelgoed niet opgeruimd</option>
            <option value="gedrag">Niet goed gedragen</option>
            <option value="iets anders.">Iets anders negatief</option>
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