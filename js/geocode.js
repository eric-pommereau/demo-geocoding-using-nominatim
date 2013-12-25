/**
 * For global accessing
 */

var map;
var marker;
var featureGroup = null;
var ctrAddress = 0;

/**
 * Loading map after dom ready
 */

function loadMap(latLngZoom) {
  	map = new L.Map('map', {zoomControl: true});
	
  	var osmUrl = 'http://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',
    	osmAttribution = 'Map data &copy; 2012 <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
    	osm = new L.TileLayer(osmUrl, {maxZoom: 18, attribution: osmAttribution});

	map.setView(new L.LatLng(latLngZoom.lat, latLngZoom.lng), latLngZoom.zoom).addLayer(osm);

}
/**
 * Called after button click
 */

function doMassGeocoding() {

    // list all input 
	var inputList = $("form .frm-adress input" );
	// Init adresses (value and div ID)
	var aAddresses = [];
	
	$.each(inputList, function(key, item) {
	  	aAddresses.push({'address': item.value, 'inputId': item.id});
	  	$('#'+item.id).css({
            border: '3px solid grey'
        });
	});
	
	// launching mass geocode ----
	massGeocode(aAddresses);
}


function massGeocode(addressList) {
	ctrAddress = addressList.length;
	
	if(featureGroup !== null) {
	    // 
	    featureGroup.eachLayer(function(l) {
	        console.log(l);
	        featureGroup.removeLayer(l); 
        });
        featureGroup.clearLayers();
        featureGroup = null;
	};
    
    
    var aPlaces = [];
    	
	$.each(addressList, function(key, item) {		
	  	$.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=1&polygon_geojson=1&q=' + item.address, function(datas) {

            data = datas[0];
	  		
            if(data === undefined) {
                $("form #" + item.inputId).css({
                    border: '3px solid red'
                });
                ctrAddress--;
                return 0;
            }
            
            $("form #" + item.inputId).css({
                border: '3px solid green'
            });

			var markerPlace = L.marker([data.lat, data.lon], {draggable:true}).bindPopup(data.display_name);
			aPlaces.push(markerPlace);
			ctrAddress--;
			
			if(ctrAddress == 0) {
				featureGroup = L.featureGroup(aPlaces).addTo(map);
				map.fitBounds(featureGroup.getBounds());
			}
		});
	});
	
	
	
}


/**
 * Geocoding
 *  - Takes adress from form
 *  - Get json
 *  - Display location on map
 */


function geocode(address) {
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