<?php
    $leafLetJS = 'http://localhost/libs/leaflet/0.7.1/leaflet-src.js';
    $leafLetCSS = 'http://localhost/libs/leaflet/0.7.1/leaflet.css';
    $jquery = 'http://localhost/libs/jQuery/1.10.2/jquery-1.10.2.js';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Demo géocodage</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $leafLetCSS;?>" />
    <script src="<?php echo $leafLetJS ;?>"></script>
    <script src="<?php echo $jquery ;?>"></script>
    <script src="map.js"></script>
</head>
<body onload="loadMap()">
    <h2>Démo géocodage Nominatim - OSM - JQuery</h2>
    <fieldset>
        <legend>Géocodage</legend>
        <form>
            Adresse : <input type="text" name="adresse" id="adresse" value="Paris France" /> <br />
            <button onclick="geocode(); return false;">Valider</button>
        </form>
    </fieldset>
    
    <div id="result"></div>
    
    <div id="map" style="width: 600px; height: 400px"></div>
</body>
</html>
