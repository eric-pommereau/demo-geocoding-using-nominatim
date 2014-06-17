<?php
	phpinfo();
	
	curl_init()
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, "http://nominatim.openstreetmap.org/sear … rycodes=CZ" );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $ch, CURLOPT_TIMEOUT, 40 ); 
	$result = curl_exec( $ch );