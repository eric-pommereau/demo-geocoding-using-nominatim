<?php
    class MassGeocodeCSVWriter {
        private $aHead;
        private $aLines = array();
        private $fileName;
        
        public function __construct($fileName) {
            try {
                $handle = fopen($fileName, 'w');
                if($handle == false) throw new Exception("Impossible d'ouvrir le fichier", 1);
                fclose($handle);
                $this->fileName = $fileName;
            }catch(Exception $ex) {
                throw $ex;
            }
        }
        
        public function addHeader($aFields) {
            $this->aHead = $aFields;
        }
        
        public function addLine($aLine) {
            // Contrôler le nombre d'éléments
            $this->aLines[] = $aLine;
        }
        
        public function write() {
            $handle = fopen($this->fileName, 'w');

            fputcsv($handle, $this->aHead);
            
            foreach ($this->aLines as $aRow) {
                fputcsv($handle, $aRow);    
            }
            
            fclose($handle);
        }
    }