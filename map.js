/**
 * For global accession
 */

var map;
var marker;


/**
 * Loading map after dom ready
 */

function loadMap() {
  	map = new L.Map('map', {zoomControl: true});

  	var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    	osmAttribution = 'Map data &copy; 2012 <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
    	osm = new L.TileLayer(osmUrl, {maxZoom: 18, attribution: osmAttribution});

	map.setView(new L.LatLng(48.4930895, 2.1909175), 16).addLayer(osm);

}

/**
 * Geocoding
 * Takes adress from form
 * Get json
 * Display location on map
 */

function geocode() {
	address = $('#adresse').val();
	
	$.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=1&polygon_geojson=1&q=' + address, function(datas) {

	data = datas[0];
	
	$('#result').empty();
	
    $('<p>', { html: data.display_name }).appendTo('#result');
    
    if (marker) {
    	map.removeLayer(marker);
    	map.removeLayer(polygon);
    }
    
    map.setView([data.lat, data.lon]);
    
    map.fitBounds([
	    [data.boundingbox[0], data.boundingbox[2]],
	    [data.boundingbox[1], data.boundingbox[3]]
	]);
	
	marker = L.marker([data.lat, data.lon]).addTo(map).bindPopup(data.display_name).openPopup();

	polygon = L.geoJson(data.geojson).addTo(map);
	
	return 0;
	

    });
}