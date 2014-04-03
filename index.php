<?php
    /*
    $leafLetJS = 'http://localhost/libs/leaflet/0.7.1/leaflet-src.js';
    $leafLetCSS = 'http://localhost/libs/leaflet/0.7.1/leaflet.css';
    $jquery = 'http://localhost/libs/jQuery/1.10.2/jquery-1.10.2.js';
    */
    $leafLetJS =    'http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.1/leaflet.js';
    $leafLetCSS =   'http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.1/leaflet.css';
    $jquery =       'http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.js';    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nominatim geocode</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body onload="init()">
    <h2>Démos géocodage Nominatim</h2>
    <fieldset>
        <legend>Test géocodage simple</legend>
        <a href="simple-geocode.php">simple-geocode.php</a>
    </fieldset> 
    <fieldset>
        <legend>Test géocodage 4 adresses</legend>
        <a href="mass-geocode.php">mass-geocode.php</a>
    </fieldset>    
    <fieldset>
        <legend>Géocodage CSV</legend>
        <div>1 fichier CSV : 
            <ul>
                <li>Champ 1 : l'adresse</li>
                <li>Champ 2 : le pays</li>
                <li>Séparateur : ','</li>
            </ul>
        </div>
        <form action="mass-geocode-csv.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <input type="file" name="csv" />
            <input type="submit">
        </form>
        <br />
        <div>
            Télécharger un fichier exemple : <a href="php/addresses.csv">ici</a>
        </div>
    </fieldset>    
</body>
</html>
    