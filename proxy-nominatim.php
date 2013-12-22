<?php

    try {
        $nominatimURL = 'http://nominatim.openstreetmap.org/search';
        $address = isset($_REQUEST['address']) ? $_REQUEST['address']: null;
        $format = 'json';
        
        // http://nominatim.openstreetmap.org/search?q=135+pilkington+avenue,+birmingham&format=json&polygon=1&addressdetails=1
        $params = array(
            'q' => $address,
            'format' => $format
        );
        
        $encodedURL = $nominatimURL . '?' . http_build_query($params);
        
        if(is_null($address)) {
            throw new Exception("Pas d'adresse --> ['address']", 1);
        }
        
        echo file_get_contents($encodedURL);
        
    }catch(Exception $ex) {
        echo json_encode(array('error' => true, 'message' => $ex->getMessage()));
    }
    
?>