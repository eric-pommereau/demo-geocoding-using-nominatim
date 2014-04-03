<?php 

    class MassGeocodeNominatimGeocoder {
        private $nominatimUrl = 'http://nominatim.openstreetmap.org/search';
        private $params = array();
        
        public function __construct ($params=null){
            // Ajouter les paramètres souhaités ici
            $this->params['format'] = 'json';
        }
        
        public function geocode($address) {
            $this->params['q'] = $address; 
            
            /*
            $aParams = array();
            
            foreach ($this->params as $key => $value) {
                $aParams[] = $key . '=' . urlencode($value);
            }
            */
            
            $uri = $this->nominatimUrl . '?' . http_build_query($this->params);
    
            $json_result = file_get_contents($uri);
            
            return json_decode($json_result);
        }
    }
    