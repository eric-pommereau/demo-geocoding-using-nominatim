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
    <script src="./js/map.js"></script>
    <script>
        function colorize () {
            var input = $( "form input:text" ).css({
              background: "yellow",
              border: "3px red solid"
            });
            
            $.each(input, function(key, item) {
                console.log(item);
            });
        }
    </script> 
</head>
<body onload="loadMap()">
    <h2>Démo géocodage en masse Nominatim - OSM - JQuery</h2>
    <fieldset>
        <legend>Géocodage en masse</legend>
        <form name="adresses">
            <div class="frm-adress" >
                Adresse 1 : <input type="text" name="adresse1" id="adresse1" value="Paris France" /> <br />    
            </div>
            <div class="frm-adress">
                Adresse 2 : <input type="text" name="adresse2" id="adresse2" value="Etrechy France" /> <br />
            </div>
            <div class="frm-adress">
                Adresse 3 : <input type="text" name="adresse3" id="adresse3" value="Marseille France" /> <br />
            </div>
            <div class="frm-adress">
                Adresse 4 : <input type="text" name="adresse4" id="adresse4" value="Lyon France" /> <br />
            </div>
            
            <button onclick="doMassGeocoding(); return false;">Valider</button>
        </form>
    </fieldset>
    
    <div id="result"></div>
    
    <div id="map" style="width: 600px; height: 400px"></div>
</body>
</html>
