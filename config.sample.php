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
define('SERVER_TESTNET', true);          // Using Testnet?  true / false

// Interface for bitcoin protocol:

define('TUBE', 		'bitcoin-php'); // use bitcoin-php library plugin
define('CERTIFICATE_PATH', '');         // used for bitcoin-php library

