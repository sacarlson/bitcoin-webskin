<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/

// Communicate with bitcoind via JSON RPC calls:

define('USERNAME', 	'test');
define('PASSWORD', 	'test');
define('SCHEME',	'http');        // http  or https  
define('HOST',     	'127.0.0.1');   
define('PORT',     	'8332');        // Bitcoin standard port: 8332

define('SERVER_NETWORK', 'Bitcoin');     // Display name of the network


// Interface for bitcoin protocol:

define('TUBE', 		'bitcoin-php'); // use bitcoin-php library plugin
define('CERTIFICATE_PATH', '');         // used for bitcoin-php library

// Windows Localhost Server

define('SERVER_LOCALHOST', 		true);   // is server on localhost?
define('SERVER_LOCALHOST_TYPE', 'windows');  // type:  windows, linux
define('WINDOWS_TASKLIST', 		'C:\Windows\System32\tasklist.exe');

define('SERVER',         		'C:\tmp\bitcoin\bitcoind.exe');  // full pathname to bitcoind executable
define('SERVER_NAME',    		'bitcoind.exe'); // name only of bitcoind executable
define('SERVER_TESTNET',    	true); // use testnet?  true / false
define('SERVER_DATADIR', 		'C:\tmp\bitcoin-testnet-datadir');  // location of data dir
define('SERVER_CONF',    		'C:\tmp\bitcoin-testnet-datadir\tenset.conf'); // location of conf file
