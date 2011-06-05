<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/

// RPC/JSON access:

define('USERNAME', 	'test');
define('PASSWORD', 	'test');
define('SCHEME',	'http');
define('HOST',     	'127.0.0.1');
define('PORT',     	'8332');

// Interface setup:

//define('TUBE', 		'test');

define('TUBE', 		'bitcoin-php'); 
define('CERTIFICATE_PATH', '');


define('SERVER',         		'C:\bitcoind.exe');
define('SERVER_NAME',    		'bitcoind.exe');
define('SERVER_NETWORK',    	'Bitcoin');
define('SERVER_TESTNET',    	true);
define('SERVER_DATADIR', 		'C:\bitcoind-datadir');
define('SERVER_CONF',    		'C:\bitcoind-datadir\sample.conf');


/*
define('SERVER',         		'C:\namecoind.exe');
define('SERVER_NAME',    		'namecoind.exe');
define('SERVER_NETWORK',    	'Namecoin');
define('SERVER_TESTNET',    	true);
define('SERVER_DATADIR', 		'C:\namecoind-datadir');
define('SERVER_CONF',    		'C:\namecoind-datadir\sample.conf');
*/



// Localhost Server

define('SERVER_LOCALHOST', 		true);
define('SERVER_LOCALHOST_TYPE', 'windows');
define('WINDOWS_TASKLIST', 		'C:\Windows\System32\tasklist.exe');