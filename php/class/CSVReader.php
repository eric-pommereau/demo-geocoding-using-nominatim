<?php
    
    class MassGeocodeCSVReader {
        
        private $aHead;
        private $aLines;
        
        public function __construct($fileName) {
            try {
                $this->aLines = array();
                
                // ouverture du fichier
                $handle = fopen($fileName, 'r');

                if($handle == false) throw new Exception(fprintf("Fichier %s non trouvé",$fileName));
                
                $isHeadLine = TRUE;
    
                // parcours du fichier ------------------------------------
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if($isHeadLine == FALSE) $this->aLines[] = $data;
                    else {
                        $this->aHead = $data;
                        $isHeadLine = FALSE;
                    }
                    
                }
                
                @fclose($handle);
                
            }catch(Exception $ex) {
                throw $ex;
            }
        }
        
        public function getLines() {
            return $this->aLines;
        }
        
        public function getCountLines() {
            return count($this->aLines);
        }
        
        public function getHead() {
            return $this->aHead;
        }
    }