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
    <title>Demo géocodage</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $leafLetCSS;?>" />
    <script src="<?php echo $leafLetJS ;?>"></script>
    <script src="<?php echo $jquery ;?>"></script>
    <script src="./js/geocode.js"></script>
    <script>
        function init() {
            loadMap({
                lat: 48.4908995954145,
                lng: 2.190828323364258,
                zoom : 14
            });  
        }
    </script>    
</head>
<body onload="init()">
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
