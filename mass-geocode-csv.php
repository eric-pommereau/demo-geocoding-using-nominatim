<?php

    require_once('php/class/CSVReader.php');
    require_once('php/class/CSVWriter.php');
    require_once('php/class/NominatimGeocoder.php');
    
    session_start();    
    session_regenerate_id();
    
    echo htmlHeader();

    ob_flush();
    flush();
    
    try {
        $dir = 'php/upload/'.session_id();
        $result = mkdir($dir);
        if($result == FALSE) throw new Exception(fprintf("Le répertoire [%s] ne peut être créé", $dir), 1);
    
        // Gérer l'upload
    
        move_uploaded_file($_FILES['csv']['tmp_name'], $dir . '/1-input.csv');
    
        $oCSVreader = new MassGeocodeCSVReader($dir . "/1-input.csv");
        
        printf('<div class="info">Lecture du CSV : %s lignes</div>', $oCSVreader->getCountLines());
        
        $oCSVwriter = new MassGeocodeCSVWriter($dir . '/2-done.csv');
        $oCSVwriterReject = new MassGeocodeCSVWriter($dir . '/3-reject.csv');
        
        $oCSVwriterReject->addHeader(array('adresse'));
        $oCSVwriter->addHeader(array('adresse', 'geocoded', 'lat', 'lon', 'importance'));
        $oGeocoder = new MassGeocodeNominatimGeocoder();
        
        
        foreach ($oCSVreader->getLines() as $aRow) {
            $q = $aRow[0] . " " . $aRow[1];
            $aResult = $oGeocoder->geocode($q);
            
            if(count($aResult) > 0) {
                $firstResult = $aResult[0];
                printf('<div class="geocode-line success">Requête : %s --> %s</div>', $q, $firstResult->display_name);
                
                $oCSVwriter->addLine(array($q, $firstResult->display_name, $firstResult->lat, $firstResult->lon, $firstResult->importance));
                 
            }else {
                printf('<div class="geocode-line error">Requête : %s </div>', $q);
                $oCSVwriterReject->addLine(array($q));
            }
            
            ob_flush();
            flush();
            
            sleep(1);
            
        }
        
        $oCSVwriter->write();
        $oCSVwriterReject->write(); 
    
        printf('<div class="result">Fichier original : <a href="php/upload/%s/1-input.csv">1-input.csv</a></div>', session_id());
        printf('<div class="result">Réussis : <a href="php/upload/%s/1-done.csv">2-done.csv</a></div>', session_id());
        printf('<div class="result">Echoués : <a href="php/upload/%s/1-reject.csv">3-reject.csv</a></div>', session_id());
                
    }catch (Exception $ex) {
        echo $ex->getMessage();
    }
    
    echo htmlFooter();
    
    
    function htmlHeader() {
        $out = <<<EOF
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <title>Geocodage en masse CSV</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="">
                <meta name="author" content="">
        
                <link href="resources/css/geocode.css" rel="stylesheet" media="screen">
                <link href="resources/js/geocode.js" rel="stylesheet" media="screen">
            </head>
            <html>
                <body>
EOF;
    return $out;
    }
    
    function htmlFooter() {
        $out = <<<EOF
            </body>
        </html>
        return $out;
EOF;
    }
    

    
    
    
