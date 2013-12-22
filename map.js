var map;
var marker;
function loadMap() {
  	map = new L.Map('map', {zoomControl: true});

  	var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    	osmAttribution = 'Map data &copy; 2012 <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
    	osm = new L.TileLayer(osmUrl, {maxZoom: 18, attribution: osmAttribution});

	map.setView(new L.LatLng(48.4930895, 2.1909175), 16).addLayer(osm);

}

function geocode() {
	address = $('#adresse').val();
	
	console.log($('#result').html('coucou'));
	
	$.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=1&polygon_geojson=1&q=' + address, function(datas) {

	
	console.log(datas);
	
	data = datas[0];
	console.log(data);
	
	$('#result').empty();
	
    $('<p>', { html: data.display_name }).appendTo('#result');
    
    lat = data.lat;
    lon = data.lon;

    if (marker) {
    	map.removeLayer(marker);
    	map.removeLayer(polygon);
    }
    
    map.setView([lat, lon]);
    
    map.fitBounds([
	    [data.boundingbox[0], data.boundingbox[2]],
	    [data.boundingbox[1], data.boundingbox[3]]
	]);

	
	marker = L.marker([lat, lon]).addTo(map).bindPopup(data.display_name).openPopup();

	polygon = L.geoJson(data.geojson).addTo(map);
	
	return 0;
	

    });
}