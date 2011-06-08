<?php
/*
	Bitcoin Webskin
	MtGox functions

	Copyright 2011 
	
	Version 0.0.1
*/


function mtgox_get_ticker() {
	global $ch;
	
	if( !mtgox_setup_curl('https://mtgox.com/code/data/ticker.php') ) {
		print("<br />MtGox plugin error: Unable to load ticker data" );
		return null_data_ticker();
	}
	
	try {
		$r = curl_exec($ch);		
		curl_close($ch);
	} catch( Exception $e ) {
		print("<br />MtGox plugin error: \nMessage: " . $e->getMessage() );
		return null_data_ticker();
	}
	
	if( !$r ) {
		print("<br />MtGox plugin error: Got null data set");
		return null_data_ticker();
	}

	return json_decode($r);
	
}
function null_data_ticker() {
	return json_decode('{"ticker":{"high":0,"low":0,"vol":0,"buy":0,"sell":0,"last":0}}');
}

function mtgox_get_depth() {
	global $ch;
	
	if( !mtgox_setup_curl('https://mtgox.com/code/data/getDepth.php') ) {
		print("<br />MtGox plugin error: Unable to load ticker data" );
		return null_data_depth();
	}
	
	try {
		$r = curl_exec($ch);		
		curl_close($ch);
	} catch( Exception $e ) {
		print("<br />MtGox plugin error: \nMessage: " . $e->getMessage() );
		return null_data_depth();
	}
	
	if( !$r ) {
		print("<br />MtGox plugin error: Got null data set");
		return null_data_depth();
	}

	return json_decode($r);
	
}
function null_data_depth() {
	return json_decode('{"asks":[[0.0,0.0]],"bids":[[0.0,0.0]]}');
}

function mtgox_get_trades() {
	global $ch;
	
	if( !mtgox_setup_curl('https://mtgox.com/code/data/getTrades.php') ) {
		print("<br />MtGox plugin error: Unable to load ticker data" );
		return null_data_trades();
	}
	
	try {
		$r = curl_exec($ch);		
		curl_close($ch);
	} catch( Exception $e ) {
		print("<br />MtGox plugin error: \nMessage: " . $e->getMessage() );
		return null_data_trades();
	}
	
	if( !$r ) {
		print("<br />MtGox plugin error: Got null data set");
		return null_data_trades();
	}

	return array_reverse( json_decode($r) );
	
}
function null_data_trades() {
	return json_decode('[{"date":1,"price":0,"amount":0,"tid":"0"}]');
}


function mtgox_setup_curl($url) {
	global $ch;
	try {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	} catch( Exception $e ) {
		print("<br />MtGox plugin error: \nMessage: " . $e->getMessage() );
		return false;
	}
	return true;
}

