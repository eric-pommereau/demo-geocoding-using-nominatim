Demo geocoding : Nominatim/Leaflet/JQuery
==============================

Demo source code for geocoding with nominatim usin leaftlet and jQuery Libraries

Three main files

- simple-geocode.php
- mass-geocode.php
- mass-geocode-csv.php


##Simple Geocode

Geocode and display location on map

- Read address from input field
- Geocode with nominatim (JSon output)
- Add a marker and polygon/line (selected area/road)
- Zoom on map

##Mass Geocode

Geododing some addresses and display locations on map

- Read input fields
- Geocode with nominatim each address (JSon output)
- Add marker for each item
- Zoom on map according to all locations

##Mass Geocode CSV

Geododing some addresses in CSV file

- Upload CSV file
- Output each geododed lines
- Create 2 files : done.csv and reject.csv (and original file)

Le répertoire php/uload doit être accessible en écriture par www-data


## Enhancements 
- OOP (JQuery or Leaflet class ??).
-
