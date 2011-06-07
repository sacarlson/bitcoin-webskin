<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/

class BitcoinPHPcontroler implements Bitcoin, Namecoin {

	// Control
	public function start() {  
		try { 
			$this->tube = new BitcoinClient(SCHEME, USERNAME, PASSWORD, HOST, PORT, CERTIFICATE_PATH, $debug=0);
			$this->info = $this->tube->getinfo();  
			return true;
		} catch( BitcoinClientException $e ) {
			$this->info['error'] = 'start() Error: ' . $e->getMessage();
			return false;
		}	
	}
	
	public function getprocess() {  // get info on server process
		return 'getprocess() not implemented';
	}
	public function kill() {  // kill the local server process
		return 'kill() not implemented';
	}
	
	// Accounts
    public function listaccounts( $minconf=1 ) { 
		try { 
			return $this->tube->query('listaccounts', (int)$minconf);
		} catch( BitcoinClientException $e ) {
			return 'listaccounts() Error: ' . $e->getMessage();
		}
	} // end listaccounts
	
    public function listreceivedbyaccount( $minconf=1, $includeempty=false ) { 
		try { 
			return $this->tube->listreceivedbyaccount( (int)$minconf, (bool)$includeempty);
		} catch( BitcoinClientException $e ) {
			return 'listreceivedbyaccount() Error: ' . $e->getMessage();
		}	
	} // end listreceivedbyaccount
	
    public function getaccountaddress( $account ) { 
		try { 
			return $this->tube->getaccountaddress( (string)$account );
		} catch( BitcoinClientException $e ) {
			return 'getaccountaddress() Error: ' . $e->getMessage();
		}	
	}

    public function getaddressesbyaccount( $account ) { 
		try { 
			return $this->tube->getaddressesbyaccount( (string)$account );
		} catch( BitcoinClientException $e ) {
			return 'getaddressesbyaccount() Error: ' . $e->getMessage();
		}
	}

    public function getreceivedbyaccount( $account, $minconf=1 ) { 
		try { 
			return $this->tube->getreceivedbyaccount( (string)$account, (int)$minconf );
		} catch( BitcoinClientException $e ) {
			return 'getreceivedbyaccount() Error: ' . $e->getMessage();
		}
	}

    public function getbalance( $account, $minconf=1 ) { 	
		try { 
			return $this->tube->getbalance( (string)$account, (int)$minconf );
		} catch( BitcoinClientException $e ) {
			return 'getbalance() Error: ' . $e->getMessage();
		}
	}
	
	// Transactions
    public function listtransactions( $account, $count=10 ) { 
		try { 
			return $this->tube->query('listtransactions', (string)$account, (int)$count);
		} catch( BitcoinClientException $e ) {
			return 'listtransactions() Error: ' . $e->getMessage();
		}
	} 
	
	public function gettransaction( $txid ) { 
		try { 
			return $this->tube->query('gettransaction', (string)$txid);
		} catch( BitcoinClientException $e ) {
			return 'gettransaction Error: ' . $e->getMessage();
		}
	} 
	
	// Addresses
	public function listreceivedbyaddress( $minconf=1, $includeempty=false ) { 
		try { 
			return $this->tube->listreceivedbyaddress( (int)$minconf, (bool)$includeempty );
		} catch( BitcoinClientException $e ) {
			return 'listreceivedbyaddress() Error: ' . $e->getMessage();
		}
	}

	public function getnewaddress( $account='' ) { 
 		try { 
			return $this->tube->getnewaddress( (string)$account );
		} catch( BitcoinClientException $e ) {
			return 'getnewaddress() Error: ' . $e->getMessage();
		}
	}

	public function getreceivedbyaddress( $address, $minconf=1 ) { 
 		try { 
			return $this->tube->getreceivedbyaddress( (string)$address, (int)$minconf );
		} catch( BitcoinClientException $e ) {
			return 'getreceivedbyaddress() Error: ' . $e->getMessage();
		}
	}

	public function getaccount( $address ) { 
		try { 
			return $this->tube->getaccount( (string)$address );
		} catch( BitcoinClientException $e ) {
			return 'getaccount() Error: ' . $e->getMessage();
		}
	}

	public function setaccount( $address, $account ) { 
		try { 
			return $this->tube->setaccount( (string)$address, (string)$account );
		} catch( BitcoinClientException $e ) {
			return 'setaccount() Error: ' . $e->getMessage();
		}
	}

	public function validateaddress( $address ) { 	
 		try { 
			return $this->tube->validateaddress( (string)$address );
		} catch( BitcoinClientException $e ) {
			return 'validateaddress() Error: ' . $e->getMessage();
		}
	}
	
	// Sending
    public function sendtoaddress( $address, $amount, $comment='', $comment_to='' ) { 	
		try { 
			return $this->tube->sendtoaddress( (string)$address, (float)$amount, (string)$comment, (string)$comment_to );
		} catch( BitcoinClientException $e ) {
			return 'sendtoaddress() Error: ' . $e->getMessage();
		}
	}

	public function sendfrom( $fromaccount, $toaddress, $amount, $minconf=1, $comment='', $comment_to='' ) { 
		try { 
			return $this->tube->sendfrom( 
				(string)$fromaccount,
				(string)$toaddress,
				(float)$amount, 
				(int)$minconf,
				(string)$comment, 
				(string)$comment_to
			);			
		} catch( BitcoinClientException $e ) {
			return 'sendfrom() Error: ' . $e->getMessage();
		}
	}

	public function sendmany( $fromaccount, $tomany, $minconf=1, $comment='') { 
 		try { 
			return $this->tube->sendmany( 
				(string)$fromaccount,
				(string)$tomany,
				(int)$minconf,
				(string)$comment
			);			
		} catch( BitcoinClientException $e ) {
			return 'sendmany() Error: ' . $e->getMessage();
		}
	}
	
	public function move( $fromaccount, $toaccount, $amount, $minconf=1, $comment='' ) { 
 		try { 
			return $this->tube->move( 
				(string)$fromaccount,
				(string)$toaccount,
				(float)$amount,			
				(int)$minconf,
				(string)$comment
			);			
		} catch( BitcoinClientException $e ) {
			return 'move() Error: ' . $e->getMessage();
		}
	}
	
	// Server
    public function getinfo() { 
		try { 
			return $this->tube->getinfo(); 
		} catch( BitcoinClientException $e ) {
			return 'getinfo() Error: ' . $e->getMessage();
		}	
	}

	public function getblockcount() { 
		try { 
			return $this->tube->getblockcount(); 
		} catch( BitcoinClientException $e ) {
			return 'getblockcount() Error: ' . $e->getMessage();
		}	
	}

	public function getblocknumber() { 
		try { 
			return $this->tube->getblocknumber(); 
		} catch( BitcoinClientException $e ) {
			return 'getblocknumber() Error: ' . $e->getMessage();
		}
	}

	public function getconnectioncount() { 
		try { 
			return $this->tube->getconnectioncount(); 	
		} catch( BitcoinClientException $e ) {
			return 'getconnectioncount() Error: ' . $e->getMessage();
		}
	}

	public function getdifficulty() { 
		try { 
			return $this->tube->getdifficulty(); 
		} catch( BitcoinClientException $e ) {
			return 'getdifficulty() Error: ' . $e->getMessage();
		}
	}

	public function getgenerate() { 
		try { 
			return $this->tube->getgenerate(); 
		} catch( BitcoinClientException $e ) {
			return 'getgenerate() Error: ' . $e->getMessage();
		}	
	}

	public function gethashespersec() { 
		try { 
			return $this->tube->gethashespersec(); 
		} catch( BitcoinClientException $e ) {
			return 'gethashespersec() Error: ' . $e->getMessage();
		}	
	}

	public function getwork( $data='' ) { 
		try { 
			return $this->tube->getwork( $data ); 
		} catch( BitcoinClientException $e ) {
			return 'getwork() Error: ' . $e->getMessage();
		}	
	}

	public function backupwallet( $destination ) { 
		try { 
			return $this->tube->backupwallet( (string)$destination ); 
		} catch( BitcoinClientException $e ) {
			return 'backupwallet() Error: ' . $e->getMessage();
		}	
	}	

	public function setgenerate( $generate, $genproclimit=-1 ) { 
		try { 
			return $this->tube->setgenerate( (bool)$generate, (int)$genproclimit ); 
		} catch( BitcoinClientException $e ) {
			return 'setgenerate() Error: ' . $e->getMessage();
		}	
	}

	public function help( $command='' ) { 
		try { 
			return htmlentities( $this->tube->help( $command ) ); 
		} catch( BitcoinClientException $e ) {
			return 'help() Error: ' . $e->getMessage();
		}	
	}
	
	public function stop() { 
		try { 
			return $this->tube->stop(); 
		} catch( BitcoinClientException $e ) {
			return 'stop() Error: ' . $e->getMessage();
		}	
	}

	// Namecoin
    public function name_list( $name ) { 
		try { 
			return $this->tube->query('name_list', (string)$name);
		} catch( BitcoinClientException $e ) {
			return 'name_list() Error: ' . $e->getMessage();
		}	
	}

    public function name_scan( $start_name='', $max_returned ) { 
		try { 
			return $this->tube->query('name_scan', (string)$start_name, (int)$max_returned);
		} catch( BitcoinClientException $e ) {
			return 'name_scan() Error: ' . $e->getMessage();
		}
	}

    public function name_new( $name ) { 
		try { 
			return $this->tube->query('name_new', (string)$name);
		} catch( BitcoinClientException $e ) {
			return 'name_new() Error: ' . $e->getMessage();
		}
	}

    public function name_firstupdate( $name, $rand, $tx, $value ) {
		try { 
			return $this->tube->query('name_firstupdate', 
				(string)$name,
				(string)$rand,
				(string)$tx,
				(string)$value
			);
		} catch( BitcoinClientException $e ) {
			return 'name_firstupdate() Error: ' . $e->getMessage();
		}
	}

    public function name_update( $name, $value, $toaddress='' ) { 
		try { 
			return $this->tube->query('name_update', (string)$name, (string)$value, (string)$toaddress);
		} catch( BitcoinClientException $e ) {
			return 'name_update() Error: ' . $e->getMessage();
		}
	}

	public function name_clean() { 
		try { 
			return $this->tube->query('name_clean');
		} catch( BitcoinClientException $e ) {
			return 'name_clean() Error: ' . $e->getMessage();
		}
	}

    public function deletetransaction( $txid ) { 
		try { 
			return $this->tube->query('deletetransaction', (string)$txid);
		} catch( BitcoinClientException $e ) {
			return 'deletetransaction() Error: ' . $e->getMessage();
		}
	}
	
} // end class BitcoinPHP

?><?php

/*
bitcoin-php
===========

A [Bitcoin][Bitcoin] library for [PHP](http://www.php.net/).

Documentation
-------------

Documentation can be found at [code.gogulski.com](http://code.gogulski.com/).

Requirements
------------

### PHP requirements:
* PHP5
* cURL support  
* SSL support (if you're using HTTPS to talk to bitcoind)

Donate
------

* Bitcoin payments: 1E3d6EWLgwisXY2CWXDcdQQP2ivRN7e9r9
* Gifts via other methods: <http://www.nostate.com/support-nostatecom/>

Authors
-------

* [Mike Gogulski](http://github.com/mikegogulski) -
  <http://www.nostate.com/> <http://www.gogulski.com/>

Credits
-------

bitcoin-php incorporates code from:

* [XML-RPC for PHP][XML-RPC-PHP] by Edd Dumbill (for JSON-RPC support)

License
-------

bitcoin-php is free and unencumbered public domain software. For more
information, see <http://unlicense.org/> or the accompanying UNLICENSE file.


[Bitcoin]:		http://www.bitcoin.org/
[XML-RPC-PHP]:	http://phpxmlrpc.sourceforge.net/

*/

// by Edd Dumbill (C) 1999-2002
// <edd@usefulinc.com>
// $Id: xmlrpc.inc,v 1.174 2009/03/16 19:36:38 ggiunta Exp $

// Copyright (c) 1999,2000,2002 Edd Dumbill.
// All rights reserved.
//
// Redistribution and use in source and binary forms, with or without
// modification, are permitted provided that the following conditions
// are met:
//
//    * Redistributions of source code must retain the above copyright
//      notice, this list of conditions and the following disclaimer.
//
//    * Redistributions in binary form must reproduce the above
//      copyright notice, this list of conditions and the following
//      disclaimer in the documentation and/or other materials provided
//      with the distribution.
//
//    * Neither the name of the "XML-RPC for PHP" nor the names of its
//      contributors may be used to endorse or promote products derived
//      from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
// "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
// LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
// FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
// REGENTS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
// INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
// (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
// SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
// HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
// STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
// ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
// OF THE POSSIBILITY OF SUCH DAMAGE.

////////////////////////////////////////////
	if(!function_exists('xml_parser_create'))
	{
		// For PHP 4 onward, XML functionality is always compiled-in on windows:
		// no more need to dl-open it. It might have been compiled out on *nix...
		if(strtoupper(substr(PHP_OS, 0, 3) != 'WIN'))
		{
			dl('xml.so');
		}
	}

	// G. Giunta 2005/01/29: declare global these variables,
	// so that xmlrpc.inc will work even if included from within a function
	// Milosch: 2005/08/07 - explicitly request these via $GLOBALS where used.
	$GLOBALS['xmlrpcI4']='i4';
	$GLOBALS['xmlrpcInt']='int';
	$GLOBALS['xmlrpcBoolean']='boolean';
	$GLOBALS['xmlrpcDouble']='double';
	$GLOBALS['xmlrpcString']='string';
	$GLOBALS['xmlrpcDateTime']='dateTime.iso8601';
	$GLOBALS['xmlrpcBase64']='base64';
	$GLOBALS['xmlrpcArray']='array';
	$GLOBALS['xmlrpcStruct']='struct';
	$GLOBALS['xmlrpcValue']='undefined';

	$GLOBALS['xmlrpcTypes']=array(
		$GLOBALS['xmlrpcI4']       => 1,
		$GLOBALS['xmlrpcInt']      => 1,
		$GLOBALS['xmlrpcBoolean']  => 1,
		$GLOBALS['xmlrpcString']   => 1,
		$GLOBALS['xmlrpcDouble']   => 1,
		$GLOBALS['xmlrpcDateTime'] => 1,
		$GLOBALS['xmlrpcBase64']   => 1,
		$GLOBALS['xmlrpcArray']    => 2,
		$GLOBALS['xmlrpcStruct']   => 3
	);

	$GLOBALS['xmlrpc_valid_parents'] = array(
		'VALUE' => array('MEMBER', 'DATA', 'PARAM', 'FAULT'),
		'BOOLEAN' => array('VALUE'),
		'I4' => array('VALUE'),
		'INT' => array('VALUE'),
		'STRING' => array('VALUE'),
		'DOUBLE' => array('VALUE'),
		'DATETIME.ISO8601' => array('VALUE'),
		'BASE64' => array('VALUE'),
		'MEMBER' => array('STRUCT'),
		'NAME' => array('MEMBER'),
		'DATA' => array('ARRAY'),
		'ARRAY' => array('VALUE'),
		'STRUCT' => array('VALUE'),
		'PARAM' => array('PARAMS'),
		'METHODNAME' => array('METHODCALL'),
		'PARAMS' => array('METHODCALL', 'METHODRESPONSE'),
		'FAULT' => array('METHODRESPONSE'),
		'NIL' => array('VALUE'), // only used when extension activated
		'EX:NIL' => array('VALUE') // only used when extension activated
	);

	// define extra types for supporting NULL (useful for json or <NIL/>)
	$GLOBALS['xmlrpcNull']='null';
	$GLOBALS['xmlrpcTypes']['null']=1;

	// Not in use anymore since 2.0. Shall we remove it?
	/// @deprecated
	$GLOBALS['xmlEntities']=array(
		'amp'  => '&',
		'quot' => '"',
		'lt'   => '<',
		'gt'   => '>',
		'apos' => "'"
	);

	// tables used for transcoding different charsets into us-ascii xml

	$GLOBALS['xml_iso88591_Entities']=array();
	$GLOBALS['xml_iso88591_Entities']['in'] = array();
	$GLOBALS['xml_iso88591_Entities']['out'] = array();
	for ($i = 0; $i < 32; $i++)
	{
		$GLOBALS['xml_iso88591_Entities']['in'][] = chr($i);
		$GLOBALS['xml_iso88591_Entities']['out'][] = '&#'.$i.';';
	}
	for ($i = 160; $i < 256; $i++)
	{
		$GLOBALS['xml_iso88591_Entities']['in'][] = chr($i);
		$GLOBALS['xml_iso88591_Entities']['out'][] = '&#'.$i.';';
	}

	/// @todo add to iso table the characters from cp_1252 range, i.e. 128 to 159?
	/// These will NOT be present in true ISO-8859-1, but will save the unwary
	/// windows user from sending junk (though no luck when reciving them...)
  /*
	$GLOBALS['xml_cp1252_Entities']=array();
	for ($i = 128; $i < 160; $i++)
	{
		$GLOBALS['xml_cp1252_Entities']['in'][] = chr($i);
	}
	$GLOBALS['xml_cp1252_Entities']['out'] = array(
		'&#x20AC;', '?',        '&#x201A;', '&#x0192;',
		'&#x201E;', '&#x2026;', '&#x2020;', '&#x2021;',
		'&#x02C6;', '&#x2030;', '&#x0160;', '&#x2039;',
		'&#x0152;', '?',        '&#x017D;', '?',
		'?',        '&#x2018;', '&#x2019;', '&#x201C;',
		'&#x201D;', '&#x2022;', '&#x2013;', '&#x2014;',
		'&#x02DC;', '&#x2122;', '&#x0161;', '&#x203A;',
		'&#x0153;', '?',        '&#x017E;', '&#x0178;'
	);
  */

	$GLOBALS['xmlrpcerr'] = array(
	'unknown_method'=>1,
	'invalid_return'=>2,
	'incorrect_params'=>3,
	'introspect_unknown'=>4,
	'http_error'=>5,
	'no_data'=>6,
	'no_ssl'=>7,
	'curl_fail'=>8,
	'invalid_request'=>15,
	'no_curl'=>16,
	'server_error'=>17,
	'multicall_error'=>18,
	'multicall_notstruct'=>9,
	'multicall_nomethod'=>10,
	'multicall_notstring'=>11,
	'multicall_recursion'=>12,
	'multicall_noparams'=>13,
	'multicall_notarray'=>14,

	'cannot_decompress'=>103,
	'decompress_fail'=>104,
	'dechunk_fail'=>105,
	'server_cannot_decompress'=>106,
	'server_decompress_fail'=>107
	);

	$GLOBALS['xmlrpcstr'] = array(
	'unknown_method'=>'Unknown method',
	'invalid_return'=>'Invalid return payload: enable debugging to examine incoming payload',
	'incorrect_params'=>'Incorrect parameters passed to method',
	'introspect_unknown'=>"Can't introspect: method unknown",
	'http_error'=>"Didn't receive 200 OK from remote server.",
	'no_data'=>'No data received from server.',
	'no_ssl'=>'No SSL support compiled in.',
	'curl_fail'=>'CURL error',
	'invalid_request'=>'Invalid request payload',
	'no_curl'=>'No CURL support compiled in.',
	'server_error'=>'Internal server error',
	'multicall_error'=>'Received from server invalid multicall response',
	'multicall_notstruct'=>'system.multicall expected struct',
	'multicall_nomethod'=>'missing methodName',
	'multicall_notstring'=>'methodName is not a string',
	'multicall_recursion'=>'recursive system.multicall forbidden',
	'multicall_noparams'=>'missing params',
	'multicall_notarray'=>'params is not an array',

	'cannot_decompress'=>'Received from server compressed HTTP and cannot decompress',
	'decompress_fail'=>'Received from server invalid compressed HTTP',
	'dechunk_fail'=>'Received from server invalid chunked HTTP',
	'server_cannot_decompress'=>'Received from client compressed HTTP request and cannot decompress',
	'server_decompress_fail'=>'Received from client invalid compressed HTTP request'
	);

	// The charset encoding used by the server for received messages and
	// by the client for received responses when received charset cannot be determined
	// or is not supported
	$GLOBALS['xmlrpc_defencoding']='UTF-8';

	// The encoding used internally by PHP.
	// String values received as xml will be converted to this, and php strings will be converted to xml
	// as if having been coded with this
	$GLOBALS['xmlrpc_internalencoding']='ISO-8859-1';

	$GLOBALS['xmlrpcName']='XML-RPC for PHP';
	$GLOBALS['xmlrpcVersion']='3.0.0.beta';

	// let user errors start at 800
	$GLOBALS['xmlrpcerruser']=800;
	// let XML parse errors start at 100
	$GLOBALS['xmlrpcerrxml']=100;

	// formulate backslashes for escaping regexp
	// Not in use anymore since 2.0. Shall we remove it?
	/// @deprecated
	$GLOBALS['xmlrpc_backslash']=chr(92).chr(92);

	// set to TRUE to enable correct decoding of <NIL/> and <EX:NIL/> values
	$GLOBALS['xmlrpc_null_extension']=false;

	// set to TRUE to enable encoding of php NULL values to <EX:NIL/> instead of <NIL/>
	$GLOBALS['xmlrpc_null_apache_encoding']=false;

	// used to store state during parsing
	// quick explanation of components:
	//   ac - used to accumulate values
	//   isf - used to indicate a parsing fault (2) or xmlrpcresp fault (1)
	//   isf_reason - used for storing xmlrpcresp fault string
	//   lv - used to indicate "looking for a value": implements
	//        the logic to allow values with no types to be strings
	//   params - used to store parameters in method calls
	//   method - used to store method name
	//   stack - array with genealogy of xml elements names:
	//           used to validate nesting of xmlrpc elements
	$GLOBALS['_xh']=null;

	/**
	* Convert a string to the correct XML representation in a target charset
	* To help correct communication of non-ascii chars inside strings, regardless
	* of the charset used when sending requests, parsing them, sending responses
	* and parsing responses, an option is to convert all non-ascii chars present in the message
	* into their equivalent 'charset entity'. Charset entities enumerated this way
	* are independent of the charset encoding used to transmit them, and all XML
	* parsers are bound to understand them.
	* Note that in the std case we are not sending a charset encoding mime type
	* along with http headers, so we are bound by RFC 3023 to emit strict us-ascii.
	*
	* @todo do a bit of basic benchmarking (strtr vs. str_replace)
	* @todo	make usage of iconv() or recode_string() or mb_string() where available
	*/
	function xmlrpc_encode_entitites($data, $src_encoding='', $dest_encoding='')
	{
		if ($src_encoding == '')
		{
			// lame, but we know no better...
			$src_encoding = $GLOBALS['xmlrpc_internalencoding'];
		}

		switch(strtoupper($src_encoding.'_'.$dest_encoding))
		{
			case 'ISO-8859-1_':
			case 'ISO-8859-1_US-ASCII':
				$escaped_data = str_replace(array('&', '"', "'", '<', '>'), array('&amp;', '&quot;', '&apos;', '&lt;', '&gt;'), $data);
				$escaped_data = str_replace($GLOBALS['xml_iso88591_Entities']['in'], $GLOBALS['xml_iso88591_Entities']['out'], $escaped_data);
				break;
			case 'ISO-8859-1_UTF-8':
				$escaped_data = str_replace(array('&', '"', "'", '<', '>'), array('&amp;', '&quot;', '&apos;', '&lt;', '&gt;'), $data);
				$escaped_data = utf8_encode($escaped_data);
				break;
			case 'ISO-8859-1_ISO-8859-1':
			case 'US-ASCII_US-ASCII':
			case 'US-ASCII_UTF-8':
			case 'US-ASCII_':
			case 'US-ASCII_ISO-8859-1':
			case 'UTF-8_UTF-8':
			//case 'CP1252_CP1252':
				$escaped_data = str_replace(array('&', '"', "'", '<', '>'), array('&amp;', '&quot;', '&apos;', '&lt;', '&gt;'), $data);
				break;
			case 'UTF-8_':
			case 'UTF-8_US-ASCII':
			case 'UTF-8_ISO-8859-1':
	// NB: this will choke on invalid UTF-8, going most likely beyond EOF
	$escaped_data = '';
	// be kind to users creating string xmlrpcvals out of different php types
	$data = (string) $data;
	$ns = strlen ($data);
	for ($nn = 0; $nn < $ns; $nn++)
	{
		$ch = $data[$nn];
		$ii = ord($ch);
		//1 7 0bbbbbbb (127)
		if ($ii < 128)
		{
			/// @todo shall we replace this with a (supposedly) faster str_replace?
			switch($ii){
				case 34:
					$escaped_data .= '&quot;';
					break;
				case 38:
					$escaped_data .= '&amp;';
					break;
				case 39:
					$escaped_data .= '&apos;';
					break;
				case 60:
					$escaped_data .= '&lt;';
					break;
				case 62:
					$escaped_data .= '&gt;';
					break;
				default:
					$escaped_data .= $ch;
			} // switch
		}
		//2 11 110bbbbb 10bbbbbb (2047)
		else if ($ii>>5 == 6)
		{
			$b1 = ($ii & 31);
			$ii = ord($data[$nn+1]);
			$b2 = ($ii & 63);
			$ii = ($b1 * 64) + $b2;
			$ent = sprintf ('&#%d;', $ii);
			$escaped_data .= $ent;
			$nn += 1;
		}
		//3 16 1110bbbb 10bbbbbb 10bbbbbb
		else if ($ii>>4 == 14)
		{
			$b1 = ($ii & 15);
			$ii = ord($data[$nn+1]);
			$b2 = ($ii & 63);
			$ii = ord($data[$nn+2]);
			$b3 = ($ii & 63);
			$ii = ((($b1 * 64) + $b2) * 64) + $b3;
			$ent = sprintf ('&#%d;', $ii);
			$escaped_data .= $ent;
			$nn += 2;
		}
		//4 21 11110bbb 10bbbbbb 10bbbbbb 10bbbbbb
		else if ($ii>>3 == 30)
		{
			$b1 = ($ii & 7);
			$ii = ord($data[$nn+1]);
			$b2 = ($ii & 63);
			$ii = ord($data[$nn+2]);
			$b3 = ($ii & 63);
			$ii = ord($data[$nn+3]);
			$b4 = ($ii & 63);
			$ii = ((((($b1 * 64) + $b2) * 64) + $b3) * 64) + $b4;
			$ent = sprintf ('&#%d;', $ii);
			$escaped_data .= $ent;
			$nn += 3;
		}
	}
				break;
/*
			case 'CP1252_':
			case 'CP1252_US-ASCII':
				$escaped_data = str_replace(array('&', '"', "'", '<', '>'), array('&amp;', '&quot;', '&apos;', '&lt;', '&gt;'), $data);
				$escaped_data = str_replace($GLOBALS['xml_iso88591_Entities']['in'], $GLOBALS['xml_iso88591_Entities']['out'], $escaped_data);
				$escaped_data = str_replace($GLOBALS['xml_cp1252_Entities']['in'], $GLOBALS['xml_cp1252_Entities']['out'], $escaped_data);
				break;
			case 'CP1252_UTF-8':
				$escaped_data = str_replace(array('&', '"', "'", '<', '>'), array('&amp;', '&quot;', '&apos;', '&lt;', '&gt;'), $data);
				/// @todo we could use real UTF8 chars here instead of xml entities... (note that utf_8 encode all allone will NOT convert them)
				$escaped_data = str_replace($GLOBALS['xml_cp1252_Entities']['in'], $GLOBALS['xml_cp1252_Entities']['out'], $escaped_data);
				$escaped_data = utf8_encode($escaped_data);
				break;
			case 'CP1252_ISO-8859-1':
				$escaped_data = str_replace(array('&', '"', "'", '<', '>'), array('&amp;', '&quot;', '&apos;', '&lt;', '&gt;'), $data);
				// we might as well replave all funky chars with a '?' here, but we are kind and leave it to the receiving application layer to decide what to do with these weird entities...
				$escaped_data = str_replace($GLOBALS['xml_cp1252_Entities']['in'], $GLOBALS['xml_cp1252_Entities']['out'], $escaped_data);
				break;
*/
			default:
				$escaped_data = '';
				error_log("Converting from $src_encoding to $dest_encoding: not supported...");
		}
		return $escaped_data;
	}

	/// xml parser handler function for opening element tags
	function xmlrpc_se($parser, $name, $attrs, $accept_single_vals=false)
	{
		// if invalid xmlrpc already detected, skip all processing
		if ($GLOBALS['_xh']['isf'] < 2)
		{
			// check for correct element nesting
			// top level element can only be of 2 types
			/// @todo optimization creep: save this check into a bool variable, instead of using count() every time:
			///       there is only a single top level element in xml anyway
			if (count($GLOBALS['_xh']['stack']) == 0)
			{
				if ($name != 'METHODRESPONSE' && $name != 'METHODCALL' && (
					$name != 'VALUE' && !$accept_single_vals))
				{
					$GLOBALS['_xh']['isf'] = 2;
					$GLOBALS['_xh']['isf_reason'] = 'missing top level xmlrpc element';
					return;
				}
				else
				{
					$GLOBALS['_xh']['rt'] = strtolower($name);
					$GLOBALS['_xh']['rt'] = strtolower($name);
				}
			}
			else
			{
				// not top level element: see if parent is OK
				$parent = end($GLOBALS['_xh']['stack']);
				if (!array_key_exists($name, $GLOBALS['xmlrpc_valid_parents']) || !in_array($parent, $GLOBALS['xmlrpc_valid_parents'][$name]))
				{
					$GLOBALS['_xh']['isf'] = 2;
					$GLOBALS['_xh']['isf_reason'] = "xmlrpc element $name cannot be child of $parent";
					return;
				}
			}

			switch($name)
			{
				// optimize for speed switch cases: most common cases first
				case 'VALUE':
					/// @todo we could check for 2 VALUE elements inside a MEMBER or PARAM element
					$GLOBALS['_xh']['vt']='value'; // indicator: no value found yet
					$GLOBALS['_xh']['ac']='';
					$GLOBALS['_xh']['lv']=1;
					$GLOBALS['_xh']['php_class']=null;
					break;
				case 'I4':
				case 'INT':
				case 'STRING':
				case 'BOOLEAN':
				case 'DOUBLE':
				case 'DATETIME.ISO8601':
				case 'BASE64':
					if ($GLOBALS['_xh']['vt']!='value')
					{
						//two data elements inside a value: an error occurred!
						$GLOBALS['_xh']['isf'] = 2;
						$GLOBALS['_xh']['isf_reason'] = "$name element following a {$GLOBALS['_xh']['vt']} element inside a single value";
						return;
					}
					$GLOBALS['_xh']['ac']=''; // reset the accumulator
					break;
				case 'STRUCT':
				case 'ARRAY':
					if ($GLOBALS['_xh']['vt']!='value')
					{
						//two data elements inside a value: an error occurred!
						$GLOBALS['_xh']['isf'] = 2;
						$GLOBALS['_xh']['isf_reason'] = "$name element following a {$GLOBALS['_xh']['vt']} element inside a single value";
						return;
					}
					// create an empty array to hold child values, and push it onto appropriate stack
					$cur_val = array();
					$cur_val['values'] = array();
					$cur_val['type'] = $name;
					// check for out-of-band information to rebuild php objs
					// and in case it is found, save it
					if (@isset($attrs['PHP_CLASS']))
					{
						$cur_val['php_class'] = $attrs['PHP_CLASS'];
					}
					$GLOBALS['_xh']['valuestack'][] = $cur_val;
					$GLOBALS['_xh']['vt']='data'; // be prepared for a data element next
					break;
				case 'DATA':
					if ($GLOBALS['_xh']['vt']!='data')
					{
						//two data elements inside a value: an error occurred!
						$GLOBALS['_xh']['isf'] = 2;
						$GLOBALS['_xh']['isf_reason'] = "found two data elements inside an array element";
						return;
					}
				case 'METHODCALL':
				case 'METHODRESPONSE':
				case 'PARAMS':
					// valid elements that add little to processing
					break;
				case 'METHODNAME':
				case 'NAME':
					/// @todo we could check for 2 NAME elements inside a MEMBER element
					$GLOBALS['_xh']['ac']='';
					break;
				case 'FAULT':
					$GLOBALS['_xh']['isf']=1;
					break;
				case 'MEMBER':
					$GLOBALS['_xh']['valuestack'][count($GLOBALS['_xh']['valuestack'])-1]['name']=''; // set member name to null, in case we do not find in the xml later on
					//$GLOBALS['_xh']['ac']='';
					// Drop trough intentionally
				case 'PARAM':
					// clear value type, so we can check later if no value has been passed for this param/member
					$GLOBALS['_xh']['vt']=null;
					break;
				case 'NIL':
				case 'EX:NIL':
					if ($GLOBALS['xmlrpc_null_extension'])
					{
						if ($GLOBALS['_xh']['vt']!='value')
						{
							//two data elements inside a value: an error occurred!
							$GLOBALS['_xh']['isf'] = 2;
							$GLOBALS['_xh']['isf_reason'] = "$name element following a {$GLOBALS['_xh']['vt']} element inside a single value";
							return;
						}
						$GLOBALS['_xh']['ac']=''; // reset the accumulator
						break;
					}
					// we do not support the <NIL/> extension, so
					// drop through intentionally
				default:
					/// INVALID ELEMENT: RAISE ISF so that it is later recognized!!!
					$GLOBALS['_xh']['isf'] = 2;
					$GLOBALS['_xh']['isf_reason'] = "found not-xmlrpc xml element $name";
					break;
			}

			// Save current element name to stack, to validate nesting
			$GLOBALS['_xh']['stack'][] = $name;

			/// @todo optimization creep: move this inside the big switch() above
			if($name!='VALUE')
			{
				$GLOBALS['_xh']['lv']=0;
			}
		}
	}

	/// Used in decoding xml chunks that might represent single xmlrpc values
	function xmlrpc_se_any($parser, $name, $attrs)
	{
		xmlrpc_se($parser, $name, $attrs, true);
	}

	/// xml parser handler function for close element tags
	function xmlrpc_ee($parser, $name, $rebuild_xmlrpcvals = true)
	{
		if ($GLOBALS['_xh']['isf'] < 2)
		{
			// push this element name from stack
			// NB: if XML validates, correct opening/closing is guaranteed and
			// we do not have to check for $name == $curr_elem.
			// we also checked for proper nesting at start of elements...
			$curr_elem = array_pop($GLOBALS['_xh']['stack']);

			switch($name)
			{
				case 'VALUE':
					// This if() detects if no scalar was inside <VALUE></VALUE>
					if ($GLOBALS['_xh']['vt']=='value')
					{
						$GLOBALS['_xh']['value']=$GLOBALS['_xh']['ac'];
						$GLOBALS['_xh']['vt']=$GLOBALS['xmlrpcString'];
					}

					if ($rebuild_xmlrpcvals)
					{
						// build the xmlrpc val out of the data received, and substitute it
						$temp = new xmlrpcval($GLOBALS['_xh']['value'], $GLOBALS['_xh']['vt']);
						// in case we got info about underlying php class, save it
						// in the object we're rebuilding
						if (isset($GLOBALS['_xh']['php_class']))
							$temp->_php_class = $GLOBALS['_xh']['php_class'];
						// check if we are inside an array or struct:
						// if value just built is inside an array, let's move it into array on the stack
						$vscount = count($GLOBALS['_xh']['valuestack']);
						if ($vscount && $GLOBALS['_xh']['valuestack'][$vscount-1]['type']=='ARRAY')
						{
							$GLOBALS['_xh']['valuestack'][$vscount-1]['values'][] = $temp;
						}
						else
						{
							$GLOBALS['_xh']['value'] = $temp;
						}
					}
					else
					{
						/// @todo this needs to treat correctly php-serialized objects,
						/// since std deserializing is done by php_xmlrpc_decode,
						/// which we will not be calling...
						if (isset($GLOBALS['_xh']['php_class']))
						{
						}

						// check if we are inside an array or struct:
						// if value just built is inside an array, let's move it into array on the stack
						$vscount = count($GLOBALS['_xh']['valuestack']);
						if ($vscount && $GLOBALS['_xh']['valuestack'][$vscount-1]['type']=='ARRAY')
						{
							$GLOBALS['_xh']['valuestack'][$vscount-1]['values'][] = $GLOBALS['_xh']['value'];
						}
					}
					break;
				case 'BOOLEAN':
				case 'I4':
				case 'INT':
				case 'STRING':
				case 'DOUBLE':
				case 'DATETIME.ISO8601':
				case 'BASE64':
					$GLOBALS['_xh']['vt']=strtolower($name);
					/// @todo: optimization creep - remove the if/elseif cycle below
					/// since the case() in which we are already did that
					if ($name=='STRING')
					{
						$GLOBALS['_xh']['value']=$GLOBALS['_xh']['ac'];
					}
					elseif ($name=='DATETIME.ISO8601')
					{
						if (!preg_match('/^[0-9]{8}T[0-9]{2}:[0-9]{2}:[0-9]{2}$/', $GLOBALS['_xh']['ac']))
						{
							error_log('XML-RPC: invalid value received in DATETIME: '.$GLOBALS['_xh']['ac']);
						}
						$GLOBALS['_xh']['vt']=$GLOBALS['xmlrpcDateTime'];
						$GLOBALS['_xh']['value']=$GLOBALS['_xh']['ac'];
					}
					elseif ($name=='BASE64')
					{
						/// @todo check for failure of base64 decoding / catch warnings
						$GLOBALS['_xh']['value']=base64_decode($GLOBALS['_xh']['ac']);
					}
					elseif ($name=='BOOLEAN')
					{
						// special case here: we translate boolean 1 or 0 into PHP
						// constants true or false.
						// Strings 'true' and 'false' are accepted, even though the
						// spec never mentions them (see eg. Blogger api docs)
						// NB: this simple checks helps a lot sanitizing input, ie no
						// security problems around here
						if ($GLOBALS['_xh']['ac']=='1' || strcasecmp($GLOBALS['_xh']['ac'], 'true') == 0)
						{
							$GLOBALS['_xh']['value']=true;
						}
						else
						{
							// log if receiveing something strange, even though we set the value to false anyway
							if ($GLOBALS['_xh']['ac']!='0' && strcasecmp($GLOBALS['_xh']['ac'], 'false') != 0)
								error_log('XML-RPC: invalid value received in BOOLEAN: '.$GLOBALS['_xh']['ac']);
							$GLOBALS['_xh']['value']=false;
						}
					}
					elseif ($name=='DOUBLE')
					{
						// we have a DOUBLE
						// we must check that only 0123456789-.<space> are characters here
						// NOTE: regexp could be much stricter than this...
						if (!preg_match('/^[+-eE0123456789 \t.]+$/', $GLOBALS['_xh']['ac']))
						{
							/// @todo: find a better way of throwing an error than this!
							error_log('XML-RPC: non numeric value received in DOUBLE: '.$GLOBALS['_xh']['ac']);
							$GLOBALS['_xh']['value']='ERROR_NON_NUMERIC_FOUND';
						}
						else
						{
							// it's ok, add it on
							$GLOBALS['_xh']['value']=(double)$GLOBALS['_xh']['ac'];
						}
					}
					else
					{
						// we have an I4/INT
						// we must check that only 0123456789-<space> are characters here
						if (!preg_match('/^[+-]?[0123456789 \t]+$/', $GLOBALS['_xh']['ac']))
						{
							/// @todo find a better way of throwing an error than this!
							error_log('XML-RPC: non numeric value received in INT: '.$GLOBALS['_xh']['ac']);
							$GLOBALS['_xh']['value']='ERROR_NON_NUMERIC_FOUND';
						}
						else
						{
							// it's ok, add it on
							$GLOBALS['_xh']['value']=(int)$GLOBALS['_xh']['ac'];
						}
					}
					//$GLOBALS['_xh']['ac']=''; // is this necessary?
					$GLOBALS['_xh']['lv']=3; // indicate we've found a value
					break;
				case 'NAME':
					$GLOBALS['_xh']['valuestack'][count($GLOBALS['_xh']['valuestack'])-1]['name'] = $GLOBALS['_xh']['ac'];
					break;
				case 'MEMBER':
					//$GLOBALS['_xh']['ac']=''; // is this necessary?
					// add to array in the stack the last element built,
					// unless no VALUE was found
					if ($GLOBALS['_xh']['vt'])
					{
						$vscount = count($GLOBALS['_xh']['valuestack']);
						$GLOBALS['_xh']['valuestack'][$vscount-1]['values'][$GLOBALS['_xh']['valuestack'][$vscount-1]['name']] = $GLOBALS['_xh']['value'];
					} else
						error_log('XML-RPC: missing VALUE inside STRUCT in received xml');
					break;
				case 'DATA':
					//$GLOBALS['_xh']['ac']=''; // is this necessary?
					$GLOBALS['_xh']['vt']=null; // reset this to check for 2 data elements in a row - even if they're empty
					break;
				case 'STRUCT':
				case 'ARRAY':
					// fetch out of stack array of values, and promote it to current value
					$curr_val = array_pop($GLOBALS['_xh']['valuestack']);
					$GLOBALS['_xh']['value'] = $curr_val['values'];
					$GLOBALS['_xh']['vt']=strtolower($name);
					if (isset($curr_val['php_class']))
					{
						$GLOBALS['_xh']['php_class'] = $curr_val['php_class'];
					}
					break;
				case 'PARAM':
					// add to array of params the current value,
					// unless no VALUE was found
					if ($GLOBALS['_xh']['vt'])
					{
						$GLOBALS['_xh']['params'][]=$GLOBALS['_xh']['value'];
						$GLOBALS['_xh']['pt'][]=$GLOBALS['_xh']['vt'];
					}
					else
						error_log('XML-RPC: missing VALUE inside PARAM in received xml');
					break;
				case 'METHODNAME':
					$GLOBALS['_xh']['method']=preg_replace('/^[\n\r\t ]+/', '', $GLOBALS['_xh']['ac']);
					break;
				case 'NIL':
				case 'EX:NIL':
					if ($GLOBALS['xmlrpc_null_extension'])
					{
						$GLOBALS['_xh']['vt']='null';
						$GLOBALS['_xh']['value']=null;
						$GLOBALS['_xh']['lv']=3;
						break;
					}
					// drop through intentionally if nil extension not enabled
				case 'PARAMS':
				case 'FAULT':
				case 'METHODCALL':
				case 'METHORESPONSE':
					break;
				default:
					// End of INVALID ELEMENT!
					// shall we add an assert here for unreachable code???
					break;
			}
		}
	}

	/// Used in decoding xmlrpc requests/responses without rebuilding xmlrpc values
	function xmlrpc_ee_fast($parser, $name)
	{
		xmlrpc_ee($parser, $name, false);
	}

	/// xml parser handler function for character data
	function xmlrpc_cd($parser, $data)
	{
		// skip processing if xml fault already detected
		if ($GLOBALS['_xh']['isf'] < 2)
		{
			// "lookforvalue==3" means that we've found an entire value
			// and should discard any further character data
			if($GLOBALS['_xh']['lv']!=3)
			{
				// G. Giunta 2006-08-23: useless change of 'lv' from 1 to 2
				//if($GLOBALS['_xh']['lv']==1)
				//{
					// if we've found text and we're just in a <value> then
					// say we've found a value
					//$GLOBALS['_xh']['lv']=2;
				//}
				// we always initialize the accumulator before starting parsing, anyway...
				//if(!@isset($GLOBALS['_xh']['ac']))
				//{
				//	$GLOBALS['_xh']['ac'] = '';
				//}
				$GLOBALS['_xh']['ac'].=$data;
			}
		}
	}

	/// xml parser handler function for 'other stuff', ie. not char data or
	/// element start/end tag. In fact it only gets called on unknown entities...
	function xmlrpc_dh($parser, $data)
	{
		// skip processing if xml fault already detected
		if ($GLOBALS['_xh']['isf'] < 2)
		{
			if(substr($data, 0, 1) == '&' && substr($data, -1, 1) == ';')
			{
				// G. Giunta 2006-08-25: useless change of 'lv' from 1 to 2
				//if($GLOBALS['_xh']['lv']==1)
				//{
				//	$GLOBALS['_xh']['lv']=2;
				//}
				$GLOBALS['_xh']['ac'].=$data;
			}
		}
		return true;
	}

	class xmlrpc_client
	{
		var $path;
		var $server;
		var $port=0;
		var $method='http';
		var $errno;
		var $errstr;
		var $debug=0;
		var $username='';
		var $password='';
		var $authtype=1;
		var $cert='';
		var $certpass='';
		var $cacert='';
		var $cacertdir='';
		var $key='';
		var $keypass='';
		var $verifypeer=true;
		var $verifyhost=1;
		var $no_multicall=false;
		var $proxy='';
		var $proxyport=0;
		var $proxy_user='';
		var $proxy_pass='';
		var $proxy_authtype=1;
		var $cookies=array();
		var $extracurlopts=array();

		/**
		* List of http compression methods accepted by the client for responses.
		* NB: PHP supports deflate, gzip compressions out of the box if compiled w. zlib
		*
		* NNB: you can set it to any non-empty array for HTTP11 and HTTPS, since
		* in those cases it will be up to CURL to decide the compression methods
		* it supports. You might check for the presence of 'zlib' in the output of
		* curl_version() to determine wheter compression is supported or not
		*/
		var $accepted_compression = array();
		/**
		* Name of compression scheme to be used for sending requests.
		* Either null, gzip or deflate
		*/
		var $request_compression = '';
		/**
		* CURL handle: used for keep-alive connections (PHP 4.3.8 up, see:
		* http://curl.haxx.se/docs/faq.html#7.3)
		*/
		var $xmlrpc_curl_handle = null;
		/// Wheter to use persistent connections for http 1.1 and https
		var $keepalive = false;
		/// Charset encodings that can be decoded without problems by the client
		var $accepted_charset_encodings = array();
		/// Charset encoding to be used in serializing request. NULL = use ASCII
		var $request_charset_encoding = '';
		/**
		* Decides the content of xmlrpcresp objects returned by calls to send()
		* valid strings are 'xmlrpcvals', 'phpvals' or 'xml'
		*/
		var $return_type = 'xmlrpcvals';
		/**
		* Sent to servers in http headers
		*/
		var $user_agent;

		/**
		* @param string $path either the complete server URL or the PATH part of the xmlrc server URL, e.g. /xmlrpc/server.php
		* @param string $server the server name / ip address
		* @param integer $port the port the server is listening on, defaults to 80 or 443 depending on protocol used
		* @param string $method the http protocol variant: defaults to 'http', 'https' and 'http11' can be used if CURL is installed
		*/
		function xmlrpc_client($path, $server='', $port='', $method='')
		{
			// allow user to specify all params in $path
			if($server == '' and $port == '' and $method == '')
			{
				$parts = parse_url($path);
				$server = $parts['host'];
				$path = isset($parts['path']) ? $parts['path'] : '';
				if(isset($parts['query']))
				{
					$path .= '?'.$parts['query'];
				}
				if(isset($parts['fragment']))
				{
					$path .= '#'.$parts['fragment'];
				}
				if(isset($parts['port']))
				{
					$port = $parts['port'];
				}
				if(isset($parts['scheme']))
				{
					$method = $parts['scheme'];
				}
				if(isset($parts['user']))
				{
					$this->username = $parts['user'];
				}
				if(isset($parts['pass']))
				{
					$this->password = $parts['pass'];
				}
			}
			if($path == '' || $path[0] != '/')
			{
				$this->path='/'.$path;
			}
			else
			{
				$this->path=$path;
			}
			$this->server=$server;
			if($port != '')
			{
				$this->port=$port;
			}
			if($method != '')
			{
				$this->method=$method;
			}

			// if ZLIB is enabled, let the client by default accept compressed responses
			if(function_exists('gzinflate') || (
				function_exists('curl_init') && (($info = curl_version()) &&
				((is_string($info) && strpos($info, 'zlib') !== null) || isset($info['libz_version'])))
			))
			{
				$this->accepted_compression = array('gzip', 'deflate');
			}

			// keepalives: enabled by default
			$this->keepalive = true;

			// by default the xml parser can support these 3 charset encodings
			$this->accepted_charset_encodings = array('UTF-8', 'ISO-8859-1', 'US-ASCII');

			// initialize user_agent string
			$this->user_agent = $GLOBALS['xmlrpcName'] . ' ' . $GLOBALS['xmlrpcVersion'];
		}

		/**
		* Enables/disables the echoing to screen of the xmlrpc responses received
		* @param integer $debug values 0, 1 and 2 are supported (2 = echo sent msg too, before received response)
		* @access public
		*/
		function setDebug($in)
		{
			$this->debug=$in;
		}

		/**
		* Add some http BASIC AUTH credentials, used by the client to authenticate
		* @param string $u username
		* @param string $p password
		* @param integer $t auth type. See curl_setopt man page for supported auth types. Defaults to CURLAUTH_BASIC (basic auth)
		* @access public
		*/
		function setCredentials($u, $p, $t=1)
		{
			$this->username=$u;
			$this->password=$p;
			$this->authtype=$t;
		}

		/**
		* Add a client-side https certificate
		* @param string $cert
		* @param string $certpass
		* @access public
		*/
		function setCertificate($cert, $certpass)
		{
			$this->cert = $cert;
			$this->certpass = $certpass;
		}

		/**
		* Add a CA certificate to verify server with (see man page about
		* CURLOPT_CAINFO for more details
		* @param string $cacert certificate file name (or dir holding certificates)
		* @param bool $is_dir set to true to indicate cacert is a dir. defaults to false
		* @access public
		*/
		function setCaCertificate($cacert, $is_dir=false)
		{
			if ($is_dir)
			{
				$this->cacertdir = $cacert;
			}
			else
			{
				$this->cacert = $cacert;
			}
		}

		/**
		* Set attributes for SSL communication: private SSL key
		* NB: does not work in older php/curl installs
		* Thanks to Daniel Convissor
		* @param string $key The name of a file containing a private SSL key
		* @param string $keypass The secret password needed to use the private SSL key
		* @access public
		*/
		function setKey($key, $keypass)
		{
			$this->key = $key;
			$this->keypass = $keypass;
		}

		/**
		* Set attributes for SSL communication: verify server certificate
		* @param bool $i enable/disable verification of peer certificate
		* @access public
		*/
		function setSSLVerifyPeer($i)
		{
			$this->verifypeer = $i;
		}

		/**
		* Set attributes for SSL communication: verify match of server cert w. hostname
		* @param int $i
		* @access public
		*/
		function setSSLVerifyHost($i)
		{
			$this->verifyhost = $i;
		}

		/**
		* Set proxy info
		* @param string $proxyhost
		* @param string $proxyport Defaults to 8080 for HTTP and 443 for HTTPS
		* @param string $proxyusername Leave blank if proxy has public access
		* @param string $proxypassword Leave blank if proxy has public access
		* @param int $proxyauthtype set to constant CURLAUTH_NTLM to use NTLM auth with proxy
		* @access public
		*/
		function setProxy($proxyhost, $proxyport, $proxyusername = '', $proxypassword = '', $proxyauthtype = 1)
		{
			$this->proxy = $proxyhost;
			$this->proxyport = $proxyport;
			$this->proxy_user = $proxyusername;
			$this->proxy_pass = $proxypassword;
			$this->proxy_authtype = $proxyauthtype;
		}

		/**
		* Enables/disables reception of compressed xmlrpc responses.
		* Note that enabling reception of compressed responses merely adds some standard
		* http headers to xmlrpc requests. It is up to the xmlrpc server to return
		* compressed responses when receiving such requests.
		* @param string $compmethod either 'gzip', 'deflate', 'any' or ''
		* @access public
		*/
		function setAcceptedCompression($compmethod)
		{
			if ($compmethod == 'any')
				$this->accepted_compression = array('gzip', 'deflate');
			else
				$this->accepted_compression = array($compmethod);
		}

		/**
		* Enables/disables http compression of xmlrpc request.
		* Take care when sending compressed requests: servers might not support them
		* (and automatic fallback to uncompressed requests is not yet implemented)
		* @param string $compmethod either 'gzip', 'deflate' or ''
		* @access public
		*/
		function setRequestCompression($compmethod)
		{
			$this->request_compression = $compmethod;
		}

		/**
		* Adds a cookie to list of cookies that will be sent to server.
		* NB: setting any param but name and value will turn the cookie into a 'version 1' cookie:
		* do not do it unless you know what you are doing
		* @param string $name
		* @param string $value
		* @param string $path
		* @param string $domain
		* @param int $port
		* @access public
		*
		* @todo check correctness of urlencoding cookie value (copied from php way of doing it...)
		*/
		function setCookie($name, $value='', $path='', $domain='', $port=null)
		{
			$this->cookies[$name]['value'] = urlencode($value);
			if ($path || $domain || $port)
			{
				$this->cookies[$name]['path'] = $path;
				$this->cookies[$name]['domain'] = $domain;
				$this->cookies[$name]['port'] = $port;
				$this->cookies[$name]['version'] = 1;
			}
			else
			{
				$this->cookies[$name]['version'] = 0;
			}
		}

		/**
		* Directly set cURL options, for extra flexibility
		* It allows eg. to bind client to a specific IP interface / address
		* @param $options array
		*/
		function SetCurlOptions( $options )
		{
			$this->extracurlopts = $options;
		}

		/**
		* Set user-agent string that will be used by this client instance
		* in http headers sent to the server
		*/
		function SetUserAgent( $agentstring )
		{
			$this->user_agent = $agentstring;
		}

		/**
		* Send an xmlrpc request
		* @param mixed $msg The message object, or an array of messages for using multicall, or the complete xml representation of a request
		* @param integer $timeout Connection timeout, in seconds, If unspecified, a platform specific timeout will apply
		* @param string $method if left unspecified, the http protocol chosen during creation of the object will be used
		* @return xmlrpcresp
		* @access public
		*/
		function& send($msg, $timeout=0, $method='')
		{
			// if user deos not specify http protocol, use native method of this client
			// (i.e. method set during call to constructor)
			if($method == '')
			{
				$method = $this->method;
			}

			if(is_array($msg))
			{
				// $msg is an array of xmlrpcmsg's
				$r = $this->multicall($msg, $timeout, $method);
				return $r;
			}
			elseif(is_string($msg))
			{
				$n = new xmlrpcmsg('');
				$n->payload = $msg;
				$msg = $n;
			}

			// where msg is an xmlrpcmsg
			$msg->debug=$this->debug;

			if($method == 'https')
			{
				$r =& $this->sendPayloadHTTPS(
					$msg,
					$this->server,
					$this->port,
					$timeout,
					$this->username,
					$this->password,
					$this->authtype,
					$this->cert,
					$this->certpass,
					$this->cacert,
					$this->cacertdir,
					$this->proxy,
					$this->proxyport,
					$this->proxy_user,
					$this->proxy_pass,
					$this->proxy_authtype,
					$this->keepalive,
					$this->key,
					$this->keypass
				);
			}
			elseif($method == 'http11')
			{
				$r =& $this->sendPayloadCURL(
					$msg,
					$this->server,
					$this->port,
					$timeout,
					$this->username,
					$this->password,
					$this->authtype,
					null,
					null,
					null,
					null,
					$this->proxy,
					$this->proxyport,
					$this->proxy_user,
					$this->proxy_pass,
					$this->proxy_authtype,
					'http',
					$this->keepalive
				);
			}
			else
			{
				$r =& $this->sendPayloadHTTP10(
					$msg,
					$this->server,
					$this->port,
					$timeout,
					$this->username,
					$this->password,
					$this->authtype,
					$this->proxy,
					$this->proxyport,
					$this->proxy_user,
					$this->proxy_pass,
					$this->proxy_authtype
				);
			}

			return $r;
		}

		/**
		* @access private
		*/
		function &sendPayloadHTTP10($msg, $server, $port, $timeout=0,
			$username='', $password='', $authtype=1, $proxyhost='',
			$proxyport=0, $proxyusername='', $proxypassword='', $proxyauthtype=1)
		{
			if($port==0)
			{
				$port=80;
			}

			// Only create the payload if it was not created previously
			if(empty($msg->payload))
			{
				$msg->createPayload($this->request_charset_encoding);
			}

			$payload = $msg->payload;
			// Deflate request body and set appropriate request headers
			if(function_exists('gzdeflate') && ($this->request_compression == 'gzip' || $this->request_compression == 'deflate'))
			{
				if($this->request_compression == 'gzip')
				{
					$a = @gzencode($payload);
					if($a)
					{
						$payload = $a;
						$encoding_hdr = "Content-Encoding: gzip\r\n";
					}
				}
				else
				{
					$a = @gzcompress($payload);
					if($a)
					{
						$payload = $a;
						$encoding_hdr = "Content-Encoding: deflate\r\n";
					}
				}
			}
			else
			{
				$encoding_hdr = '';
			}

			// thanks to Grant Rauscher <grant7@firstworld.net> for this
			$credentials='';
			if($username!='')
			{
				$credentials='Authorization: Basic ' . base64_encode($username . ':' . $password) . "\r\n";
				if ($authtype != 1)
				{
					error_log('XML-RPC: '.__METHOD__.': warning. Only Basic auth is supported with HTTP 1.0');
				}
			}

			$accepted_encoding = '';
			if(is_array($this->accepted_compression) && count($this->accepted_compression))
			{
				$accepted_encoding = 'Accept-Encoding: ' . implode(', ', $this->accepted_compression) . "\r\n";
			}

			$proxy_credentials = '';
			if($proxyhost)
			{
				if($proxyport == 0)
				{
					$proxyport = 8080;
				}
				$connectserver = $proxyhost;
				$connectport = $proxyport;
				$uri = 'http://'.$server.':'.$port.$this->path;
				if($proxyusername != '')
				{
					if ($proxyauthtype != 1)
					{
						error_log('XML-RPC: '.__METHOD__.': warning. Only Basic auth to proxy is supported with HTTP 1.0');
					}
					$proxy_credentials = 'Proxy-Authorization: Basic ' . base64_encode($proxyusername.':'.$proxypassword) . "\r\n";
				}
			}
			else
			{
				$connectserver = $server;
				$connectport = $port;
				$uri = $this->path;
			}

			// Cookie generation, as per rfc2965 (version 1 cookies) or
			// netscape's rules (version 0 cookies)
			$cookieheader='';
			if (count($this->cookies))
			{
				$version = '';
				foreach ($this->cookies as $name => $cookie)
				{
					if ($cookie['version'])
					{
						$version = ' $Version="' . $cookie['version'] . '";';
						$cookieheader .= ' ' . $name . '="' . $cookie['value'] . '";';
						if ($cookie['path'])
							$cookieheader .= ' $Path="' . $cookie['path'] . '";';
						if ($cookie['domain'])
							$cookieheader .= ' $Domain="' . $cookie['domain'] . '";';
						if ($cookie['port'])
							$cookieheader .= ' $Port="' . $cookie['port'] . '";';
					}
					else
					{
						$cookieheader .= ' ' . $name . '=' . $cookie['value'] . ";";
					}
				}
				$cookieheader = 'Cookie:' . $version . substr($cookieheader, 0, -1) . "\r\n";
			}

			$op= 'POST ' . $uri. " HTTP/1.0\r\n" .
				'User-Agent: ' . $this->user_agent . "\r\n" .
				'Host: '. $server . ':' . $port . "\r\n" .
				$credentials .
				$proxy_credentials .
				$accepted_encoding .
				$encoding_hdr .
				'Accept-Charset: ' . implode(',', $this->accepted_charset_encodings) . "\r\n" .
				$cookieheader .
				'Content-Type: ' . $msg->content_type . "\r\nContent-Length: " .
				strlen($payload) . "\r\n\r\n" .
				$payload;

			if($this->debug > 1)
			{
				print "<PRE>\n---SENDING---\n" . htmlentities($op) . "\n---END---\n</PRE>";
				// let the client see this now in case http times out...
				flush();
			}

			if($timeout>0)
			{
				$fp=@fsockopen($connectserver, $connectport, $this->errno, $this->errstr, $timeout);
			}
			else
			{
				$fp=@fsockopen($connectserver, $connectport, $this->errno, $this->errstr);
			}
			if($fp)
			{
				if($timeout>0 && function_exists('stream_set_timeout'))
				{
					stream_set_timeout($fp, $timeout);
				}
			}
			else
			{
				$this->errstr='Connect error: '.$this->errstr;
				$r=new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['http_error'], $this->errstr . ' (' . $this->errno . ')');
				return $r;
			}

			if(!fputs($fp, $op, strlen($op)))
			{
				fclose($fp);
				$this->errstr='Write error';
				$r=new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['http_error'], $this->errstr);
				return $r;
			}
			else
			{
				// reset errno and errstr on succesful socket connection
				$this->errstr = '';
			}
			// G. Giunta 2005/10/24: close socket before parsing.
			// should yeld slightly better execution times, and make easier recursive calls (e.g. to follow http redirects)
			$ipd='';
			do
			{
				// shall we check for $data === FALSE?
				// as per the manual, it signals an error
				$ipd.=fread($fp, 32768);
			} while(!feof($fp));
			fclose($fp);
			$r =& $msg->parseResponse($ipd, false, $this->return_type);
			return $r;

		}

		/**
		* @access private
		*/
		function &sendPayloadHTTPS($msg, $server, $port, $timeout=0, $username='',
			$password='', $authtype=1, $cert='',$certpass='', $cacert='', $cacertdir='',
			$proxyhost='', $proxyport=0, $proxyusername='', $proxypassword='', $proxyauthtype=1,
			$keepalive=false, $key='', $keypass='')
		{
			$r =& $this->sendPayloadCURL($msg, $server, $port, $timeout, $username,
				$password, $authtype, $cert, $certpass, $cacert, $cacertdir, $proxyhost, $proxyport,
				$proxyusername, $proxypassword, $proxyauthtype, 'https', $keepalive, $key, $keypass);
			return $r;
		}

		/**
		* Contributed by Justin Miller <justin@voxel.net>
		* Requires curl to be built into PHP
		* NB: CURL versions before 7.11.10 cannot use proxy to talk to https servers!
		* @access private
		*/
		function &sendPayloadCURL($msg, $server, $port, $timeout=0, $username='',
			$password='', $authtype=1, $cert='', $certpass='', $cacert='', $cacertdir='',
			$proxyhost='', $proxyport=0, $proxyusername='', $proxypassword='', $proxyauthtype=1, $method='https',
			$keepalive=false, $key='', $keypass='')
		{
			if(!function_exists('curl_init'))
			{
				$this->errstr='CURL unavailable on this install';
				$r=new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['no_curl'], $GLOBALS['xmlrpcstr']['no_curl']);
				return $r;
			}
			if($method == 'https')
			{
				if(($info = curl_version()) &&
					((is_string($info) && strpos($info, 'OpenSSL') === null) || (is_array($info) && !isset($info['ssl_version']))))
				{
					$this->errstr='SSL unavailable on this install';
					$r=new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['no_ssl'], $GLOBALS['xmlrpcstr']['no_ssl']);
					return $r;
				}
			}

			if($port == 0)
			{
				if($method == 'http')
				{
					$port = 80;
				}
				else
				{
					$port = 443;
				}
			}

			// Only create the payload if it was not created previously
			if(empty($msg->payload))
			{
				$msg->createPayload($this->request_charset_encoding);
			}

			// Deflate request body and set appropriate request headers
			$payload = $msg->payload;
			if(function_exists('gzdeflate') && ($this->request_compression == 'gzip' || $this->request_compression == 'deflate'))
			{
				if($this->request_compression == 'gzip')
				{
					$a = @gzencode($payload);
					if($a)
					{
						$payload = $a;
						$encoding_hdr = 'Content-Encoding: gzip';
					}
				}
				else
				{
					$a = @gzcompress($payload);
					if($a)
					{
						$payload = $a;
						$encoding_hdr = 'Content-Encoding: deflate';
					}
				}
			}
			else
			{
				$encoding_hdr = '';
			}

			if($this->debug > 1)
			{
				print "<PRE>\n---SENDING---\n" . htmlentities($payload) . "\n---END---\n</PRE>";
				// let the client see this now in case http times out...
				flush();
			}

			if(!$keepalive || !$this->xmlrpc_curl_handle)
			{
				$curl = curl_init($method . '://' . $server . ':' . $port . $this->path);
				if($keepalive)
				{
					$this->xmlrpc_curl_handle = $curl;
				}
			}
			else
			{
				$curl = $this->xmlrpc_curl_handle;
			}

			// results into variable
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

			if($this->debug)
			{
				curl_setopt($curl, CURLOPT_VERBOSE, 1);
			}
			curl_setopt($curl, CURLOPT_USERAGENT, $this->user_agent);
			// required for XMLRPC: post the data
			curl_setopt($curl, CURLOPT_POST, 1);
			// the data
			curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

			// return the header too
			curl_setopt($curl, CURLOPT_HEADER, 1);

			// will only work with PHP >= 5.0
			// NB: if we set an empty string, CURL will add http header indicating
			// ALL methods it is supporting. This is possibly a better option than
			// letting the user tell what curl can / cannot do...
			if(is_array($this->accepted_compression) && count($this->accepted_compression))
			{
				//curl_setopt($curl, CURLOPT_ENCODING, implode(',', $this->accepted_compression));
				// empty string means 'any supported by CURL' (shall we catch errors in case CURLOPT_SSLKEY undefined ?)
				if (count($this->accepted_compression) == 1)
				{
					curl_setopt($curl, CURLOPT_ENCODING, $this->accepted_compression[0]);
				}
				else
					curl_setopt($curl, CURLOPT_ENCODING, '');
			}
			// extra headers
			$headers = array('Content-Type: ' . $msg->content_type , 'Accept-Charset: ' . implode(',', $this->accepted_charset_encodings));
			// if no keepalive is wanted, let the server know it in advance
			if(!$keepalive)
			{
				$headers[] = 'Connection: close';
			}
			// request compression header
			if($encoding_hdr)
			{
				$headers[] = $encoding_hdr;
			}

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			// timeout is borked
			if($timeout)
			{
				curl_setopt($curl, CURLOPT_TIMEOUT, $timeout == 1 ? 1 : $timeout - 1);
			}

			if($username && $password)
			{
				curl_setopt($curl, CURLOPT_USERPWD, $username.':'.$password);
				if (defined('CURLOPT_HTTPAUTH'))
				{
					curl_setopt($curl, CURLOPT_HTTPAUTH, $authtype);
				}
				else if ($authtype != 1)
				{
					error_log('XML-RPC: '.__METHOD__.': warning. Only Basic auth is supported by the current PHP/curl install');
				}
			}

			if($method == 'https')
			{
				// set cert file
				if($cert)
				{
					curl_setopt($curl, CURLOPT_SSLCERT, $cert);
				}
				// set cert password
				if($certpass)
				{
					curl_setopt($curl, CURLOPT_SSLCERTPASSWD, $certpass);
				}
				// whether to verify remote host's cert
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $this->verifypeer);
				// set ca certificates file/dir
				if($cacert)
				{
					curl_setopt($curl, CURLOPT_CAINFO, $cacert);
				}
				if($cacertdir)
				{
					curl_setopt($curl, CURLOPT_CAPATH, $cacertdir);
				}
				// set key file (shall we catch errors in case CURLOPT_SSLKEY undefined ?)
				if($key)
				{
					curl_setopt($curl, CURLOPT_SSLKEY, $key);
				}
				// set key password (shall we catch errors in case CURLOPT_SSLKEY undefined ?)
				if($keypass)
				{
					curl_setopt($curl, CURLOPT_SSLKEYPASSWD, $keypass);
				}
				// whether to verify cert's common name (CN); 0 for no, 1 to verify that it exists, and 2 to verify that it matches the hostname used
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, $this->verifyhost);
			}

			// proxy info
			if($proxyhost)
			{
				if($proxyport == 0)
				{
					$proxyport = 8080; // NB: even for HTTPS, local connection is on port 8080
				}
				curl_setopt($curl, CURLOPT_PROXY, $proxyhost.':'.$proxyport);
				//curl_setopt($curl, CURLOPT_PROXYPORT,$proxyport);
				if($proxyusername)
				{
					curl_setopt($curl, CURLOPT_PROXYUSERPWD, $proxyusername.':'.$proxypassword);
					if (defined('CURLOPT_PROXYAUTH'))
					{
						curl_setopt($curl, CURLOPT_PROXYAUTH, $proxyauthtype);
					}
					else if ($proxyauthtype != 1)
					{
						error_log('XML-RPC: '.__METHOD__.': warning. Only Basic auth to proxy is supported by the current PHP/curl install');
					}
				}
			}

			// NB: should we build cookie http headers by hand rather than let CURL do it?
			// the following code does not honour 'expires', 'path' and 'domain' cookie attributes
			// set to client obj the the user...
			if (count($this->cookies))
			{
				$cookieheader = '';
				foreach ($this->cookies as $name => $cookie)
				{
					$cookieheader .= $name . '=' . $cookie['value'] . '; ';
				}
				curl_setopt($curl, CURLOPT_COOKIE, substr($cookieheader, 0, -2));
			}

			foreach ($this->extracurlopts as $opt => $val)
			{
				curl_setopt($curl, $opt, $val);
			}

			$result = curl_exec($curl);

			if ($this->debug > 1)
			{
				print "<PRE>\n---CURL INFO---\n";
				foreach(curl_getinfo($curl) as $name => $val)
					 print $name . ': ' . htmlentities($val). "\n";
				print "---END---\n</PRE>";
			}

			if(!$result) /// @todo we should use a better check here - what if we get back '' or '0'?
			{
				$this->errstr='no response';
				$resp=new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['curl_fail'], $GLOBALS['xmlrpcstr']['curl_fail']. ': '. curl_error($curl));
				curl_close($curl);
				if($keepalive)
				{
					$this->xmlrpc_curl_handle = null;
				}
			}
			else
			{
				if(!$keepalive)
				{
					curl_close($curl);
				}
				$resp =& $msg->parseResponse($result, true, $this->return_type);
			}
			return $resp;
		}

		/**
		* Send an array of request messages and return an array of responses.
		* Unless $this->no_multicall has been set to true, it will try first
		* to use one single xmlrpc call to server method system.multicall, and
		* revert to sending many successive calls in case of failure.
		* This failure is also stored in $this->no_multicall for subsequent calls.
		* Unfortunately, there is no server error code universally used to denote
		* the fact that multicall is unsupported, so there is no way to reliably
		* distinguish between that and a temporary failure.
		* If you are sure that server supports multicall and do not want to
		* fallback to using many single calls, set the fourth parameter to FALSE.
		*
		* NB: trying to shoehorn extra functionality into existing syntax has resulted
		* in pretty much convoluted code...
		*
		* @param array $msgs an array of xmlrpcmsg objects
		* @param integer $timeout connection timeout (in seconds)
		* @param string $method the http protocol variant to be used
		* @param boolean fallback When true, upon receiveing an error during multicall, multiple single calls will be attempted
		* @return array
		* @access public
		*/
		function multicall($msgs, $timeout=0, $method='', $fallback=true)
		{
			if ($method == '')
			{
				$method = $this->method;
			}
			if(!$this->no_multicall)
			{
				$results = $this->_try_multicall($msgs, $timeout, $method);
				if(is_array($results))
				{
					// System.multicall succeeded
					return $results;
				}
				else
				{
					// either system.multicall is unsupported by server,
					// or call failed for some other reason.
					if ($fallback)
					{
						// Don't try it next time...
						$this->no_multicall = true;
					}
					else
					{
						if (is_a($results, 'xmlrpcresp'))
						{
							$result = $results;
						}
						else
						{
							$result = new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['multicall_error'], $GLOBALS['xmlrpcstr']['multicall_error']);
						}
					}
				}
			}
			else
			{
				// override fallback, in case careless user tries to do two
				// opposite things at the same time
				$fallback = true;
			}

			$results = array();
			if ($fallback)
			{
				// system.multicall is (probably) unsupported by server:
				// emulate multicall via multiple requests
				foreach($msgs as $msg)
				{
					$results[] =& $this->send($msg, $timeout, $method);
				}
			}
			else
			{
				// user does NOT want to fallback on many single calls:
				// since we should always return an array of responses,
				// return an array with the same error repeated n times
				foreach($msgs as $msg)
				{
					$results[] = $result;
				}
			}
			return $results;
		}

		/**
		* Attempt to boxcar $msgs via system.multicall.
		* Returns either an array of xmlrpcreponses, an xmlrpc error response
		* or false (when received response does not respect valid multicall syntax)
		* @access private
		*/
		function _try_multicall($msgs, $timeout, $method)
		{
			// Construct multicall message
			$calls = array();
			foreach($msgs as $msg)
			{
				$call['methodName'] = new xmlrpcval($msg->method(),'string');
				$numParams = $msg->getNumParams();
				$params = array();
				for($i = 0; $i < $numParams; $i++)
				{
					$params[$i] = $msg->getParam($i);
				}
				$call['params'] = new xmlrpcval($params, 'array');
				$calls[] = new xmlrpcval($call, 'struct');
			}
			$multicall = new xmlrpcmsg('system.multicall');
			$multicall->addParam(new xmlrpcval($calls, 'array'));

			// Attempt RPC call
			$result =& $this->send($multicall, $timeout, $method);

			if($result->faultCode() != 0)
			{
				// call to system.multicall failed
				return $result;
			}

			// Unpack responses.
			$rets = $result->value();

			if ($this->return_type == 'xml')
			{
					return $rets;
			}
			else if ($this->return_type == 'phpvals')
			{
				///@todo test this code branch...
				$rets = $result->value();
				if(!is_array($rets))
				{
					return false;		// bad return type from system.multicall
				}
				$numRets = count($rets);
				if($numRets != count($msgs))
				{
					return false;		// wrong number of return values.
				}

				$response = array();
				for($i = 0; $i < $numRets; $i++)
				{
					$val = $rets[$i];
					if (!is_array($val)) {
						return false;
					}
					switch(count($val))
					{
						case 1:
							if(!isset($val[0]))
							{
								return false;		// Bad value
							}
							// Normal return value
							$response[$i] = new xmlrpcresp($val[0], 0, '', 'phpvals');
							break;
						case 2:
							///	@todo remove usage of @: it is apparently quite slow
							$code = @$val['faultCode'];
							if(!is_int($code))
							{
								return false;
							}
							$str = @$val['faultString'];
							if(!is_string($str))
							{
								return false;
							}
							$response[$i] = new xmlrpcresp(0, $code, $str);
							break;
						default:
							return false;
					}
				}
				return $response;
			}
			else // return type == 'xmlrpcvals'
			{
				$rets = $result->value();
				if($rets->kindOf() != 'array')
				{
					return false;		// bad return type from system.multicall
				}
				$numRets = $rets->arraysize();
				if($numRets != count($msgs))
				{
					return false;		// wrong number of return values.
				}

				$response = array();
				for($i = 0; $i < $numRets; $i++)
				{
					$val = $rets->arraymem($i);
					switch($val->kindOf())
					{
						case 'array':
							if($val->arraysize() != 1)
							{
								return false;		// Bad value
							}
							// Normal return value
							$response[$i] = new xmlrpcresp($val->arraymem(0));
							break;
						case 'struct':
							$code = $val->structmem('faultCode');
							if($code->kindOf() != 'scalar' || $code->scalartyp() != 'int')
							{
								return false;
							}
							$str = $val->structmem('faultString');
							if($str->kindOf() != 'scalar' || $str->scalartyp() != 'string')
							{
								return false;
							}
							$response[$i] = new xmlrpcresp(0, $code->scalarval(), $str->scalarval());
							break;
						default:
							return false;
					}
				}
				return $response;
			}
		}
	} // end class xmlrpc_client

	class xmlrpcresp
	{
		var $val = 0;
		var $valtyp;
		var $errno = 0;
		var $errstr = '';
		var $payload;
		var $hdrs = array();
		var $_cookies = array();
		var $content_type = 'text/xml';
		var $raw_data = '';

		/**
		* @param mixed $val either an xmlrpcval obj, a php value or the xml serialization of an xmlrpcval (a string)
		* @param integer $fcode set it to anything but 0 to create an error response
		* @param string $fstr the error string, in case of an error response
		* @param string $valtyp either 'xmlrpcvals', 'phpvals' or 'xml'
		*
		* @todo add check that $val / $fcode / $fstr is of correct type???
		* NB: as of now we do not do it, since it might be either an xmlrpcval or a plain
		* php val, or a complete xml chunk, depending on usage of xmlrpc_client::send() inside which creator is called...
		*/
		function xmlrpcresp($val, $fcode = 0, $fstr = '', $valtyp='')
		{
			if($fcode != 0)
			{
				// error response
				$this->errno = $fcode;
				$this->errstr = $fstr;
				//$this->errstr = htmlspecialchars($fstr); // XXX: encoding probably shouldn't be done here; fix later.
			}
			else
			{
				// successful response
				$this->val = $val;
				if ($valtyp == '')
				{
					// user did not declare type of response value: try to guess it
					if (is_object($this->val) && is_a($this->val, 'xmlrpcval'))
					{
						$this->valtyp = 'xmlrpcvals';
					}
					else if (is_string($this->val))
					{
						$this->valtyp = 'xml';

					}
					else
					{
						$this->valtyp = 'phpvals';
					}
				}
				else
				{
					// user declares type of resp value: believe him
					$this->valtyp = $valtyp;
				}
			}
		}

		/**
		* Returns the error code of the response.
		* @return integer the error code of this response (0 for not-error responses)
		* @access public
		*/
		function faultCode()
		{
			return $this->errno;
		}

		/**
		* Returns the error code of the response.
		* @return string the error string of this response ('' for not-error responses)
		* @access public
		*/
		function faultString()
		{
			return $this->errstr;
		}

		/**
		* Returns the value received by the server.
		* @return mixed the xmlrpcval object returned by the server. Might be an xml string or php value if the response has been created by specially configured xmlrpc_client objects
		* @access public
		*/
		function value()
		{
			return $this->val;
		}

		/**
		* Returns an array with the cookies received from the server.
		* Array has the form: $cookiename => array ('value' => $val, $attr1 => $val1, $attr2 = $val2, ...)
		* with attributes being e.g. 'expires', 'path', domain'.
		* NB: cookies sent as 'expired' by the server (i.e. with an expiry date in the past)
		* are still present in the array. It is up to the user-defined code to decide
		* how to use the received cookies, and wheter they have to be sent back with the next
		* request to the server (using xmlrpc_client::setCookie) or not
		* @return array array of cookies received from the server
		* @access public
		*/
		function cookies()
		{
			return $this->_cookies;
		}

		/**
		* Returns xml representation of the response. XML prologue not included
		* @param string $charset_encoding the charset to be used for serialization. if null, US-ASCII is assumed
		* @return string the xml representation of the response
		* @access public
		*/
		function serialize($charset_encoding='')
		{
			if ($charset_encoding != '')
				$this->content_type = 'text/xml; charset=' . $charset_encoding;
			else
				$this->content_type = 'text/xml';
			$result = "<methodResponse>\n";
			if($this->errno)
			{
				// G. Giunta 2005/2/13: let non-ASCII response messages be tolerated by clients
				// by xml-encoding non ascii chars
				$result .= "<fault>\n" .
"<value>\n<struct><member><name>faultCode</name>\n<value><int>" . $this->errno .
"</int></value>\n</member>\n<member>\n<name>faultString</name>\n<value><string>" .
xmlrpc_encode_entitites($this->errstr, $GLOBALS['xmlrpc_internalencoding'], $charset_encoding) . "</string></value>\n</member>\n" .
"</struct>\n</value>\n</fault>";
			}
			else
			{
				if(!is_object($this->val) || !is_a($this->val, 'xmlrpcval'))
				{
					if (is_string($this->val) && $this->valtyp == 'xml')
					{
						$result .= "<params>\n<param>\n" .
							$this->val .
							"</param>\n</params>";
					}
					else
					{
						/// @todo try to build something serializable?
						die('cannot serialize xmlrpcresp objects whose content is native php values');
					}
				}
				else
				{
					$result .= "<params>\n<param>\n" .
						$this->val->serialize($charset_encoding) .
						"</param>\n</params>";
				}
			}
			$result .= "\n</methodResponse>";
			$this->payload = $result;
			return $result;
		}
	}

	class xmlrpcmsg
	{
		var $payload;
		var $methodname;
		var $params=array();
		var $debug=0;
		var $content_type = 'text/xml';

		/**
		* @param string $meth the name of the method to invoke
		* @param array $pars array of parameters to be paased to the method (xmlrpcval objects)
		*/
		function xmlrpcmsg($meth, $pars=0)
		{
			$this->methodname=$meth;
			if(is_array($pars) && count($pars)>0)
			{
				for($i=0; $i<count($pars); $i++)
				{
					$this->addParam($pars[$i]);
				}
			}
		}

		/**
		* @access private
		*/
		function xml_header($charset_encoding='')
		{
			if ($charset_encoding != '')
			{
				return "<?xml version=\"1.0\" encoding=\"$charset_encoding\" ?" . ">\n<methodCall>\n";
			}
			else
			{
				return "<?xml version=\"1.0\"?" . ">\n<methodCall>\n";
			}
		}

		/**
		* @access private
		*/
		function xml_footer()
		{
			return '</methodCall>';
		}

		/**
		* @access private
		*/
		function kindOf()
		{
			return 'msg';
		}

		/**
		* @access private
		*/
		function createPayload($charset_encoding='')
		{
			if ($charset_encoding != '')
				$this->content_type = 'text/xml; charset=' . $charset_encoding;
			else
				$this->content_type = 'text/xml';
			$this->payload=$this->xml_header($charset_encoding);
			$this->payload.='<methodName>' . $this->methodname . "</methodName>\n";
			$this->payload.="<params>\n";
			for($i=0; $i<count($this->params); $i++)
			{
				$p=$this->params[$i];
				$this->payload.="<param>\n" . $p->serialize($charset_encoding) .
				"</param>\n";
			}
			$this->payload.="</params>\n";
			$this->payload.=$this->xml_footer();
		}

		/**
		* Gets/sets the xmlrpc method to be invoked
		* @param string $meth the method to be set (leave empty not to set it)
		* @return string the method that will be invoked
		* @access public
		*/
		function method($meth='')
		{
			if($meth!='')
			{
				$this->methodname=$meth;
			}
			return $this->methodname;
		}

		/**
		* Returns xml representation of the message. XML prologue included
		* @return string the xml representation of the message, xml prologue included
		* @access public
		*/
		function serialize($charset_encoding='')
		{
			$this->createPayload($charset_encoding);
			return $this->payload;
		}

		/**
		* Add a parameter to the list of parameters to be used upon method invocation
		* @param xmlrpcval $par
		* @return boolean false on failure
		* @access public
		*/
		function addParam($par)
		{
			// add check: do not add to self params which are not xmlrpcvals
			if(is_object($par) && is_a($par, 'xmlrpcval'))
			{
				$this->params[]=$par;
				return true;
			}
			else
			{
				return false;
			}
		}

		/**
		* Returns the nth parameter in the message. The index zero-based.
		* @param integer $i the index of the parameter to fetch (zero based)
		* @return xmlrpcval the i-th parameter
		* @access public
		*/
		function getParam($i) { return $this->params[$i]; }

		/**
		* Returns the number of parameters in the messge.
		* @return integer the number of parameters currently set
		* @access public
		*/
		function getNumParams() { return count($this->params); }

		/**
		* Given an open file handle, read all data available and parse it as axmlrpc response.
		* NB: the file handle is not closed by this function.
		* NNB: might have trouble in rare cases to work on network streams, as we
		*      check for a read of 0 bytes instead of feof($fp).
		*      But since checking for feof(null) returns false, we would risk an
		*      infinite loop in that case, because we cannot trust the caller
		*      to give us a valid pointer to an open file...
		* @access public
		* @return xmlrpcresp
		* @todo add 2nd & 3rd param to be passed to ParseResponse() ???
		*/
		function &parseResponseFile($fp)
		{
			$ipd='';
			while($data=fread($fp, 32768))
			{
				$ipd.=$data;
			}
			//fclose($fp);
			$r =& $this->parseResponse($ipd);
			return $r;
		}

		/**
		* Parses HTTP headers and separates them from data.
		* @access private
		*/
		function &parseResponseHeaders(&$data, $headers_processed=false)
		{
				// Support "web-proxy-tunelling" connections for https through proxies
				if(preg_match('/^HTTP\/1\.[0-1] 200 Connection established/', $data))
				{
					// Look for CR/LF or simple LF as line separator,
					// (even though it is not valid http)
					$pos = strpos($data,"\r\n\r\n");
					if($pos || is_int($pos))
					{
						$bd = $pos+4;
					}
					else
					{
						$pos = strpos($data,"\n\n");
						if($pos || is_int($pos))
						{
							$bd = $pos+2;
						}
						else
						{
							// No separation between response headers and body: fault?
							$bd = 0;
						}
					}
					if ($bd)
					{
						// this filters out all http headers from proxy.
						// maybe we could take them into account, too?
						$data = substr($data, $bd);
					}
					else
					{
						error_log('XML-RPC: '.__METHOD__.': HTTPS via proxy error, tunnel connection possibly failed');
						$r=new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['http_error'], $GLOBALS['xmlrpcstr']['http_error']. ' (HTTPS via proxy error, tunnel connection possibly failed)');
						return $r;
					}
				}

				// Strip HTTP 1.1 100 Continue header if present
				while(preg_match('/^HTTP\/1\.1 1[0-9]{2} /', $data))
				{
					$pos = strpos($data, 'HTTP', 12);
					// server sent a Continue header without any (valid) content following...
					// give the client a chance to know it
					if(!$pos && !is_int($pos)) // works fine in php 3, 4 and 5
					{
						break;
					}
					$data = substr($data, $pos);
				}
				if(!preg_match('/^HTTP\/[0-9.]+ 200 /', $data))
				{
					$errstr= substr($data, 0, strpos($data, "\n")-1);
					error_log('XML-RPC: '.__METHOD__.': HTTP error, got response: ' .$errstr);
					$r=new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['http_error'], $GLOBALS['xmlrpcstr']['http_error']. ' (' . $errstr . ')');
					return $r;
				}

				$GLOBALS['_xh']['headers'] = array();
				$GLOBALS['_xh']['cookies'] = array();

				// be tolerant to usage of \n instead of \r\n to separate headers and data
				// (even though it is not valid http)
				$pos = strpos($data,"\r\n\r\n");
				if($pos || is_int($pos))
				{
					$bd = $pos+4;
				}
				else
				{
					$pos = strpos($data,"\n\n");
					if($pos || is_int($pos))
					{
						$bd = $pos+2;
					}
					else
					{
						// No separation between response headers and body: fault?
						// we could take some action here instead of going on...
						$bd = 0;
					}
				}
				// be tolerant to line endings, and extra empty lines
				$ar = preg_split("/\r?\n/", trim(substr($data, 0, $pos)));
				while(list(,$line) = @each($ar))
				{
					// take care of multi-line headers and cookies
					$arr = explode(':',$line,2);
					if(count($arr) > 1)
					{
						$header_name = strtolower(trim($arr[0]));
						/// @todo some other headers (the ones that allow a CSV list of values)
						/// do allow many values to be passed using multiple header lines.
						/// We should add content to $GLOBALS['_xh']['headers'][$header_name]
						/// instead of replacing it for those...
						if ($header_name == 'set-cookie' || $header_name == 'set-cookie2')
						{
							if ($header_name == 'set-cookie2')
							{
								// version 2 cookies:
								// there could be many cookies on one line, comma separated
								$cookies = explode(',', $arr[1]);
							}
							else
							{
								$cookies = array($arr[1]);
							}
							foreach ($cookies as $cookie)
							{
								// glue together all received cookies, using a comma to separate them
								// (same as php does with getallheaders())
								if (isset($GLOBALS['_xh']['headers'][$header_name]))
									$GLOBALS['_xh']['headers'][$header_name] .= ', ' . trim($cookie);
								else
									$GLOBALS['_xh']['headers'][$header_name] = trim($cookie);
								// parse cookie attributes, in case user wants to correctly honour them
								// feature creep: only allow rfc-compliant cookie attributes?
								// @todo support for server sending multiple time cookie with same name, but using different PATHs
								$cookie = explode(';', $cookie);
								foreach ($cookie as $pos => $val)
								{
									$val = explode('=', $val, 2);
									$tag = trim($val[0]);
									$val = trim(@$val[1]);
									/// @todo with version 1 cookies, we should strip leading and trailing " chars
									if ($pos == 0)
									{
										$cookiename = $tag;
										$GLOBALS['_xh']['cookies'][$tag] = array();
										$GLOBALS['_xh']['cookies'][$cookiename]['value'] = urldecode($val);
									}
									else
									{
										if ($tag != 'value')
										{
										  $GLOBALS['_xh']['cookies'][$cookiename][$tag] = $val;
										}
									}
								}
							}
						}
						else
						{
							$GLOBALS['_xh']['headers'][$header_name] = trim($arr[1]);
						}
					}
					elseif(isset($header_name))
					{
						///	@todo version1 cookies might span multiple lines, thus breaking the parsing above
						$GLOBALS['_xh']['headers'][$header_name] .= ' ' . trim($line);
					}
				}

				$data = substr($data, $bd);

				if($this->debug && count($GLOBALS['_xh']['headers']))
				{
					print '<PRE>';
					foreach($GLOBALS['_xh']['headers'] as $header => $value)
					{
						print htmlentities("HEADER: $header: $value\n");
					}
					foreach($GLOBALS['_xh']['cookies'] as $header => $value)
					{
						print htmlentities("COOKIE: $header={$value['value']}\n");
					}
					print "</PRE>\n";
				}

				// if CURL was used for the call, http headers have been processed,
				// and dechunking + reinflating have been carried out
				if(!$headers_processed)
				{
					// Decode chunked encoding sent by http 1.1 servers
					if(isset($GLOBALS['_xh']['headers']['transfer-encoding']) && $GLOBALS['_xh']['headers']['transfer-encoding'] == 'chunked')
					{
						if(!$data = decode_chunked($data))
						{
							error_log('XML-RPC: '.__METHOD__.': errors occurred when trying to rebuild the chunked data received from server');
							$r = new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['dechunk_fail'], $GLOBALS['xmlrpcstr']['dechunk_fail']);
							return $r;
						}
					}

					// Decode gzip-compressed stuff
					// code shamelessly inspired from nusoap library by Dietrich Ayala
					if(isset($GLOBALS['_xh']['headers']['content-encoding']))
					{
						$GLOBALS['_xh']['headers']['content-encoding'] = str_replace('x-', '', $GLOBALS['_xh']['headers']['content-encoding']);
						if($GLOBALS['_xh']['headers']['content-encoding'] == 'deflate' || $GLOBALS['_xh']['headers']['content-encoding'] == 'gzip')
						{
							// if decoding works, use it. else assume data wasn't gzencoded
							if(function_exists('gzinflate'))
							{
								if($GLOBALS['_xh']['headers']['content-encoding'] == 'deflate' && $degzdata = @gzuncompress($data))
								{
									$data = $degzdata;
									if($this->debug)
									print "<PRE>---INFLATED RESPONSE---[".strlen($data)." chars]---\n" . htmlentities($data) . "\n---END---</PRE>";
								}
								elseif($GLOBALS['_xh']['headers']['content-encoding'] == 'gzip' && $degzdata = @gzinflate(substr($data, 10)))
								{
									$data = $degzdata;
									if($this->debug)
									print "<PRE>---INFLATED RESPONSE---[".strlen($data)." chars]---\n" . htmlentities($data) . "\n---END---</PRE>";
								}
								else
								{
									error_log('XML-RPC: '.__METHOD__.': errors occurred when trying to decode the deflated data received from server');
									$r = new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['decompress_fail'], $GLOBALS['xmlrpcstr']['decompress_fail']);
									return $r;
								}
							}
							else
							{
								error_log('XML-RPC: '.__METHOD__.': the server sent deflated data. Your php install must have the Zlib extension compiled in to support this.');
								$r = new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['cannot_decompress'], $GLOBALS['xmlrpcstr']['cannot_decompress']);
								return $r;
							}
						}
					}
				} // end of 'if needed, de-chunk, re-inflate response'

				// real stupid hack to avoid PHP complaining about returning NULL by ref
				$r = null;
				$r =& $r;
				return $r;
		}

		/**
		* Parse the xmlrpc response contained in the string $data and return an xmlrpcresp object.
		* @param string $data the xmlrpc response, eventually including http headers
		* @param bool $headers_processed when true prevents parsing HTTP headers for interpretation of content-encoding and consequent decoding
		* @param string $return_type decides return type, i.e. content of response->value(). Either 'xmlrpcvals', 'xml' or 'phpvals'
		* @return xmlrpcresp
		* @access public
		*/
		function &parseResponse($data='', $headers_processed=false, $return_type='xmlrpcvals')
		{
			if($this->debug)
			{
				//by maHo, replaced htmlspecialchars with htmlentities
				print "<PRE>---GOT---\n" . htmlentities($data) . "\n---END---\n</PRE>";
			}

			if($data == '')
			{
				error_log('XML-RPC: '.__METHOD__.': no response received from server.');
				$r = new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['no_data'], $GLOBALS['xmlrpcstr']['no_data']);
				return $r;
			}

			$GLOBALS['_xh']=array();

			$raw_data = $data;
			// parse the HTTP headers of the response, if present, and separate them from data
			if(substr($data, 0, 4) == 'HTTP')
			{
				$r =& $this->parseResponseHeaders($data, $headers_processed);
				if ($r)
				{
					// failed processing of HTTP response headers
					// save into response obj the full payload received, for debugging
					$r->raw_data = $data;
					return $r;
				}
			}
			else
			{
				$GLOBALS['_xh']['headers'] = array();
				$GLOBALS['_xh']['cookies'] = array();
			}

			if($this->debug)
			{
				$start = strpos($data, '<!-- SERVER DEBUG INFO (BASE64 ENCODED):');
				if ($start)
				{
					$start += strlen('<!-- SERVER DEBUG INFO (BASE64 ENCODED):');
					$end = strpos($data, '-->', $start);
					$comments = substr($data, $start, $end-$start);
					print "<PRE>---SERVER DEBUG INFO (DECODED) ---\n\t".htmlentities(str_replace("\n", "\n\t", base64_decode($comments)))."\n---END---\n</PRE>";
				}
			}

			// be tolerant of extra whitespace in response body
			$data = trim($data);

			/// @todo return an error msg if $data=='' ?

			// be tolerant of junk after methodResponse (e.g. javascript ads automatically inserted by free hosts)
			// idea from Luca Mariano <luca.mariano@email.it> originally in PEARified version of the lib
			$pos = strrpos($data, '</methodResponse>');
			if($pos !== false)
			{
				$data = substr($data, 0, $pos+17);
			}

			// if user wants back raw xml, give it to him
			if ($return_type == 'xml')
			{
				$r = new xmlrpcresp($data, 0, '', 'xml');
				$r->hdrs = $GLOBALS['_xh']['headers'];
				$r->_cookies = $GLOBALS['_xh']['cookies'];
				$r->raw_data = $raw_data;
				return $r;
			}

			// try to 'guestimate' the character encoding of the received response
			$resp_encoding = guess_encoding(@$GLOBALS['_xh']['headers']['content-type'], $data);

			$GLOBALS['_xh']['ac']='';
			//$GLOBALS['_xh']['qt']=''; //unused...
			$GLOBALS['_xh']['stack'] = array();
			$GLOBALS['_xh']['valuestack'] = array();
			$GLOBALS['_xh']['isf']=0; // 0 = OK, 1 for xmlrpc fault responses, 2 = invalid xmlrpc
			$GLOBALS['_xh']['isf_reason']='';
			$GLOBALS['_xh']['rt']=''; // 'methodcall or 'methodresponse'

			// if response charset encoding is not known / supported, try to use
			// the default encoding and parse the xml anyway, but log a warning...
			if (!in_array($resp_encoding, array('UTF-8', 'ISO-8859-1', 'US-ASCII')))
			// the following code might be better for mb_string enabled installs, but
			// makes the lib about 200% slower...
			//if (!is_valid_charset($resp_encoding, array('UTF-8', 'ISO-8859-1', 'US-ASCII')))
			{
				error_log('XML-RPC: '.__METHOD__.': invalid charset encoding of received response: '.$resp_encoding);
				$resp_encoding = $GLOBALS['xmlrpc_defencoding'];
			}
			$parser = xml_parser_create($resp_encoding);
			xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, true);
			// G. Giunta 2005/02/13: PHP internally uses ISO-8859-1, so we have to tell
			// the xml parser to give us back data in the expected charset.
			// What if internal encoding is not in one of the 3 allowed?
			// we use the broadest one, ie. utf8
			// This allows to send data which is native in various charset,
			// by extending xmlrpc_encode_entitites() and setting xmlrpc_internalencoding
			if (!in_array($GLOBALS['xmlrpc_internalencoding'], array('UTF-8', 'ISO-8859-1', 'US-ASCII')))
			{
				xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, 'UTF-8');
			}
			else
			{
				xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, $GLOBALS['xmlrpc_internalencoding']);
			}

			if ($return_type == 'phpvals')
			{
				xml_set_element_handler($parser, 'xmlrpc_se', 'xmlrpc_ee_fast');
			}
			else
			{
				xml_set_element_handler($parser, 'xmlrpc_se', 'xmlrpc_ee');
			}

			xml_set_character_data_handler($parser, 'xmlrpc_cd');
			xml_set_default_handler($parser, 'xmlrpc_dh');

			// first error check: xml not well formed
			if(!xml_parse($parser, $data, count($data)))
			{
				// thanks to Peter Kocks <peter.kocks@baygate.com>
				if((xml_get_current_line_number($parser)) == 1)
				{
					$errstr = 'XML error at line 1, check URL';
				}
				else
				{
					$errstr = sprintf('XML error: %s at line %d, column %d',
						xml_error_string(xml_get_error_code($parser)),
						xml_get_current_line_number($parser), xml_get_current_column_number($parser));
				}
				error_log($errstr);
				$r=new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['invalid_return'], $GLOBALS['xmlrpcstr']['invalid_return'].' ('.$errstr.')');
				xml_parser_free($parser);
				if($this->debug)
				{
					print $errstr;
				}
				$r->hdrs = $GLOBALS['_xh']['headers'];
				$r->_cookies = $GLOBALS['_xh']['cookies'];
				$r->raw_data = $raw_data;
				return $r;
			}
			xml_parser_free($parser);
			// second error check: xml well formed but not xml-rpc compliant
			if ($GLOBALS['_xh']['isf'] > 1)
			{
				if ($this->debug)
				{
					/// @todo echo something for user?
				}

				$r = new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['invalid_return'],
				$GLOBALS['xmlrpcstr']['invalid_return'] . ' ' . $GLOBALS['_xh']['isf_reason']);
			}
			// third error check: parsing of the response has somehow gone boink.
			// NB: shall we omit this check, since we trust the parsing code?
			elseif ($return_type == 'xmlrpcvals' && !is_object($GLOBALS['_xh']['value']))
			{
				// something odd has happened
				// and it's time to generate a client side error
				// indicating something odd went on
				$r=new xmlrpcresp(0, $GLOBALS['xmlrpcerr']['invalid_return'],
					$GLOBALS['xmlrpcstr']['invalid_return']);
			}
			else
			{
				if ($this->debug)
				{
					print "<PRE>---PARSED---\n";
					// somehow htmlentities chokes on var_export, and some full html string...
					//print htmlentitites(var_export($GLOBALS['_xh']['value'], true));
					print htmlspecialchars(var_export($GLOBALS['_xh']['value'], true));
					print "\n---END---</PRE>";
				}

				// note that using =& will raise an error if $GLOBALS['_xh']['st'] does not generate an object.
				$v =& $GLOBALS['_xh']['value'];

				if($GLOBALS['_xh']['isf'])
				{
					/// @todo we should test here if server sent an int and a string,
					/// and/or coerce them into such...
					if ($return_type == 'xmlrpcvals')
					{
						$errno_v = $v->structmem('faultCode');
						$errstr_v = $v->structmem('faultString');
						$errno = $errno_v->scalarval();
						$errstr = $errstr_v->scalarval();
					}
					else
					{
						$errno = $v['faultCode'];
						$errstr = $v['faultString'];
					}

					if($errno == 0)
					{
						// FAULT returned, errno needs to reflect that
						$errno = -1;
					}

					$r = new xmlrpcresp(0, $errno, $errstr);
				}
				else
				{
					$r=new xmlrpcresp($v, 0, '', $return_type);
				}
			}

			$r->hdrs = $GLOBALS['_xh']['headers'];
			$r->_cookies = $GLOBALS['_xh']['cookies'];
			$r->raw_data = $raw_data;
			return $r;
		}
	}

	class xmlrpcval
	{
		var $me=array();
		var $mytype=0;
		var $_php_class=null;

		/**
		* @param mixed $val
		* @param string $type any valid xmlrpc type name (lowercase). If null, 'string' is assumed
		*/
		function xmlrpcval($val=-1, $type='')
		{
			/// @todo: optimization creep - do not call addXX, do it all inline.
			/// downside: booleans will not be coerced anymore
			if($val!==-1 || $type!='')
			{
				// optimization creep: inlined all work done by constructor
				switch($type)
				{
					case '':
						$this->mytype=1;
						$this->me['string']=$val;
						break;
					case 'i4':
					case 'int':
					case 'double':
					case 'string':
					case 'boolean':
					case 'dateTime.iso8601':
					case 'base64':
					case 'null':
						$this->mytype=1;
						$this->me[$type]=$val;
						break;
					case 'array':
						$this->mytype=2;
						$this->me['array']=$val;
						break;
					case 'struct':
						$this->mytype=3;
						$this->me['struct']=$val;
						break;
					default:
						error_log("XML-RPC: ".__METHOD__.": not a known type ($type)");
				}
				/*if($type=='')
				{
					$type='string';
				}
				if($GLOBALS['xmlrpcTypes'][$type]==1)
				{
					$this->addScalar($val,$type);
				}
				elseif($GLOBALS['xmlrpcTypes'][$type]==2)
				{
					$this->addArray($val);
				}
				elseif($GLOBALS['xmlrpcTypes'][$type]==3)
				{
					$this->addStruct($val);
				}*/
			}
		}

		/**
		* Add a single php value to an (unitialized) xmlrpcval
		* @param mixed $val
		* @param string $type
		* @return int 1 or 0 on failure
		*/
		function addScalar($val, $type='string')
		{
			$typeof=@$GLOBALS['xmlrpcTypes'][$type];
			if($typeof!=1)
			{
				error_log("XML-RPC: ".__METHOD__.": not a scalar type ($type)");
				return 0;
			}

			// coerce booleans into correct values
			// NB: we should either do it for datetimes, integers and doubles, too,
			// or just plain remove this check, implemented on booleans only...
			if($type==$GLOBALS['xmlrpcBoolean'])
			{
				if(strcasecmp($val,'true')==0 || $val==1 || ($val==true && strcasecmp($val,'false')))
				{
					$val=true;
				}
				else
				{
					$val=false;
				}
			}

			switch($this->mytype)
			{
				case 1:
					error_log('XML-RPC: '.__METHOD__.': scalar xmlrpcval can have only one value');
					return 0;
				case 3:
					error_log('XML-RPC: '.__METHOD__.': cannot add anonymous scalar to struct xmlrpcval');
					return 0;
				case 2:
					// we're adding a scalar value to an array here
					//$ar=$this->me['array'];
					//$ar[]=new xmlrpcval($val, $type);
					//$this->me['array']=$ar;
					// Faster (?) avoid all the costly array-copy-by-val done here...
					$this->me['array'][]=new xmlrpcval($val, $type);
					return 1;
				default:
					// a scalar, so set the value and remember we're scalar
					$this->me[$type]=$val;
					$this->mytype=$typeof;
					return 1;
			}
		}

		/**
		* Add an array of xmlrpcval objects to an xmlrpcval
		* @param array $vals
		* @return int 1 or 0 on failure
		* @access public
		*
		* @todo add some checking for $vals to be an array of xmlrpcvals?
		*/
		function addArray($vals)
		{
			if($this->mytype==0)
			{
				$this->mytype=$GLOBALS['xmlrpcTypes']['array'];
				$this->me['array']=$vals;
				return 1;
			}
			elseif($this->mytype==2)
			{
				// we're adding to an array here
				$this->me['array'] = array_merge($this->me['array'], $vals);
				return 1;
			}
			else
			{
				error_log('XML-RPC: '.__METHOD__.': already initialized as a [' . $this->kindOf() . ']');
				return 0;
			}
		}

		/**
		* Add an array of named xmlrpcval objects to an xmlrpcval
		* @param array $vals
		* @return int 1 or 0 on failure
		* @access public
		*
		* @todo add some checking for $vals to be an array?
		*/
		function addStruct($vals)
		{
			if($this->mytype==0)
			{
				$this->mytype=$GLOBALS['xmlrpcTypes']['struct'];
				$this->me['struct']=$vals;
				return 1;
			}
			elseif($this->mytype==3)
			{
				// we're adding to a struct here
				$this->me['struct'] = array_merge($this->me['struct'], $vals);
				return 1;
			}
			else
			{
				error_log('XML-RPC: '.__METHOD__.': already initialized as a [' . $this->kindOf() . ']');
				return 0;
			}
		}

		// poor man's version of print_r ???
		// DEPRECATED!
		function dump($ar)
		{
			foreach($ar as $key => $val)
			{
				echo "$key => $val<br />";
				if($key == 'array')
				{
					while(list($key2, $val2) = each($val))
					{
						echo "-- $key2 => $val2<br />";
					}
				}
			}
		}

		/**
		* Returns a string containing "struct", "array" or "scalar" describing the base type of the value
		* @return string
		* @access public
		*/
		function kindOf()
		{
			switch($this->mytype)
			{
				case 3:
					return 'struct';
					break;
				case 2:
					return 'array';
					break;
				case 1:
					return 'scalar';
					break;
				default:
					return 'undef';
			}
		}

		/**
		* @access private
		*/
		function serializedata($typ, $val, $charset_encoding='')
		{
			$rs='';
			switch(@$GLOBALS['xmlrpcTypes'][$typ])
			{
				case 1:
					switch($typ)
					{
						case $GLOBALS['xmlrpcBase64']:
							$rs.="<${typ}>" . base64_encode($val) . "</${typ}>";
							break;
						case $GLOBALS['xmlrpcBoolean']:
							$rs.="<${typ}>" . ($val ? '1' : '0') . "</${typ}>";
							break;
						case $GLOBALS['xmlrpcString']:
							// G. Giunta 2005/2/13: do NOT use htmlentities, since
							// it will produce named html entities, which are invalid xml
							$rs.="<${typ}>" . xmlrpc_encode_entitites($val, $GLOBALS['xmlrpc_internalencoding'], $charset_encoding). "</${typ}>";
							break;
						case $GLOBALS['xmlrpcInt']:
						case $GLOBALS['xmlrpcI4']:
							$rs.="<${typ}>".(int)$val."</${typ}>";
							break;
						case $GLOBALS['xmlrpcDouble']:
							// avoid using standard conversion of float to string because it is locale-dependent,
							// and also because the xmlrpc spec forbids exponential notation.
							// sprintf('%F') could be most likely ok but it fails eg. on 2e-14.
							// The code below tries its best at keeping max precision while avoiding exp notation,
							// but there is of course no limit in the number of decimal places to be used...
							$rs.="<${typ}>".preg_replace('/\\.?0+$/','',number_format((double)$val, 128, '.', ''))."</${typ}>";
							break;
						case $GLOBALS['xmlrpcDateTime']:
							if (is_string($val))
							{
								$rs.="<${typ}>${val}</${typ}>";
							}
							else if(is_a($val, 'DateTime'))
							{
								$rs.="<${typ}>".$val->format('Ymd\TH:i:s')."</${typ}>";
							}
							else if(is_int($val))
							{
								$rs.="<${typ}>".strftime("%Y%m%dT%H:%M:%S", $val)."</${typ}>";
							}
							else
							{
								// not really a good idea here: but what shall we output anyway? left for backward compat...
								$rs.="<${typ}>${val}</${typ}>";
							}
							break;
						case $GLOBALS['xmlrpcNull']:
							if ($GLOBALS['xmlrpc_null_apache_encoding'])
							{
								$rs.="<ex:nil/>";
							}
							else
							{
								$rs.="<nil/>";
							}
							break;
						default:
							// no standard type value should arrive here, but provide a possibility
							// for xmlrpcvals of unknown type...
							$rs.="<${typ}>${val}</${typ}>";
					}
					break;
				case 3:
					// struct
					if ($this->_php_class)
					{
						$rs.='<struct php_class="' . $this->_php_class . "\">\n";
					}
					else
					{
						$rs.="<struct>\n";
					}
					foreach($val as $key2 => $val2)
					{
						$rs.='<member><name>'.xmlrpc_encode_entitites($key2, $GLOBALS['xmlrpc_internalencoding'], $charset_encoding)."</name>\n";
						//$rs.=$this->serializeval($val2);
						$rs.=$val2->serialize($charset_encoding);
						$rs.="</member>\n";
					}
					$rs.='</struct>';
					break;
				case 2:
					// array
					$rs.="<array>\n<data>\n";
					for($i=0; $i<count($val); $i++)
					{
						//$rs.=$this->serializeval($val[$i]);
						$rs.=$val[$i]->serialize($charset_encoding);
					}
					$rs.="</data>\n</array>";
					break;
				default:
					break;
			}
			return $rs;
		}

		/**
		* Returns xml representation of the value. XML prologue not included
		* @param string $charset_encoding the charset to be used for serialization. if null, US-ASCII is assumed
		* @return string
		* @access public
		*/
		function serialize($charset_encoding='')
		{
			// add check? slower, but helps to avoid recursion in serializing broken xmlrpcvals...
			//if (is_object($o) && (get_class($o) == 'xmlrpcval' || is_subclass_of($o, 'xmlrpcval')))
			//{
				reset($this->me);
				list($typ, $val) = each($this->me);
				return '<value>' . $this->serializedata($typ, $val, $charset_encoding) . "</value>\n";
			//}
		}

		// DEPRECATED
		function serializeval($o)
		{
			// add check? slower, but helps to avoid recursion in serializing broken xmlrpcvals...
			//if (is_object($o) && (get_class($o) == 'xmlrpcval' || is_subclass_of($o, 'xmlrpcval')))
			//{
				$ar=$o->me;
				reset($ar);
				list($typ, $val) = each($ar);
				return '<value>' . $this->serializedata($typ, $val) . "</value>\n";
			//}
		}

		/**
		* Checks wheter a struct member with a given name is present.
		* Works only on xmlrpcvals of type struct.
		* @param string $m the name of the struct member to be looked up
		* @return boolean
		* @access public
		*/
		function structmemexists($m)
		{
			return array_key_exists($m, $this->me['struct']);
		}

		/**
		* Returns the value of a given struct member (an xmlrpcval object in itself).
		* Will raise a php warning if struct member of given name does not exist
		* @param string $m the name of the struct member to be looked up
		* @return xmlrpcval
		* @access public
		*/
		function structmem($m)
		{
			return $this->me['struct'][$m];
		}

		/**
		* Reset internal pointer for xmlrpcvals of type struct.
		* @access public
		*/
		function structreset()
		{
			reset($this->me['struct']);
		}

		/**
		* Return next member element for xmlrpcvals of type struct.
		* @return xmlrpcval
		* @access public
		*/
		function structeach()
		{
			return each($this->me['struct']);
		}

		// DEPRECATED! this code looks like it is very fragile and has not been fixed
		// for a long long time. Shall we remove it for 2.0?
		function getval()
		{
			// UNSTABLE
			reset($this->me);
			list($a,$b)=each($this->me);
			// contributed by I Sofer, 2001-03-24
			// add support for nested arrays to scalarval
			// i've created a new method here, so as to
			// preserve back compatibility

			if(is_array($b))
			{
				@reset($b);
				while(list($id,$cont) = @each($b))
				{
					$b[$id] = $cont->scalarval();
				}
			}

			// add support for structures directly encoding php objects
			if(is_object($b))
			{
				$t = get_object_vars($b);
				@reset($t);
				while(list($id,$cont) = @each($t))
				{
					$t[$id] = $cont->scalarval();
				}
				@reset($t);
				while(list($id,$cont) = @each($t))
				{
					@$b->$id = $cont;
				}
			}
			// end contrib
			return $b;
		}

		/**
		* Returns the value of a scalar xmlrpcval
		* @return mixed
		* @access public
		*/
		function scalarval()
		{
			reset($this->me);
			list(,$b)=each($this->me);
			return $b;
		}

		/**
		* Returns the type of the xmlrpcval.
		* For integers, 'int' is always returned in place of 'i4'
		* @return string
		* @access public
		*/
		function scalartyp()
		{
			reset($this->me);
			list($a,)=each($this->me);
			if($a==$GLOBALS['xmlrpcI4'])
			{
				$a=$GLOBALS['xmlrpcInt'];
			}
			return $a;
		}

		/**
		* Returns the m-th member of an xmlrpcval of struct type
		* @param integer $m the index of the value to be retrieved (zero based)
		* @return xmlrpcval
		* @access public
		*/
		function arraymem($m)
		{
			return $this->me['array'][$m];
		}

		/**
		* Returns the number of members in an xmlrpcval of array type
		* @return integer
		* @access public
		*/
		function arraysize()
		{
			return count($this->me['array']);
		}

		/**
		* Returns the number of members in an xmlrpcval of struct type
		* @return integer
		* @access public
		*/
		function structsize()
		{
			return count($this->me['struct']);
		}
	}


	// date helpers

	/**
	* Given a timestamp, return the corresponding ISO8601 encoded string.
	*
	* Really, timezones ought to be supported
	* but the XML-RPC spec says:
	*
	* "Don't assume a timezone. It should be specified by the server in its
	* documentation what assumptions it makes about timezones."
	*
	* These routines always assume localtime unless
	* $utc is set to 1, in which case UTC is assumed
	* and an adjustment for locale is made when encoding
	*
	* @param int $timet (timestamp)
	* @param int $utc (0 or 1)
	* @return string
	*/
	function iso8601_encode($timet, $utc=0)
	{
		if(!$utc)
		{
			$t=strftime("%Y%m%dT%H:%M:%S", $timet);
		}
		else
		{
			if(function_exists('gmstrftime'))
			{
				// gmstrftime doesn't exist in some versions
				// of PHP
				$t=gmstrftime("%Y%m%dT%H:%M:%S", $timet);
			}
			else
			{
				$t=strftime("%Y%m%dT%H:%M:%S", $timet-date('Z'));
			}
		}
		return $t;
	}

	/**
	* Given an ISO8601 date string, return a timet in the localtime, or UTC
	* @param string $idate
	* @param int $utc either 0 or 1
	* @return int (datetime)
	*/
	function iso8601_decode($idate, $utc=0)
	{
		$t=0;
		if(preg_match('/([0-9]{4})([0-9]{2})([0-9]{2})T([0-9]{2}):([0-9]{2}):([0-9]{2})/', $idate, $regs))
		{
			if($utc)
			{
				$t=gmmktime($regs[4], $regs[5], $regs[6], $regs[2], $regs[3], $regs[1]);
			}
			else
			{
				$t=mktime($regs[4], $regs[5], $regs[6], $regs[2], $regs[3], $regs[1]);
			}
		}
		return $t;
	}

	/**
	* Takes an xmlrpc value in PHP xmlrpcval object format and translates it into native PHP types.
	*
	* Works with xmlrpc message objects as input, too.
	*
	* Given proper options parameter, can rebuild generic php object instances
	* (provided those have been encoded to xmlrpc format using a corresponding
	* option in php_xmlrpc_encode())
	* PLEASE NOTE that rebuilding php objects involves calling their constructor function.
	* This means that the remote communication end can decide which php code will
	* get executed on your server, leaving the door possibly open to 'php-injection'
	* style of attacks (provided you have some classes defined on your server that
	* might wreak havoc if instances are built outside an appropriate context).
	* Make sure you trust the remote server/client before eanbling this!
	*
	* @author Dan Libby (dan@libby.com)
	*
	* @param xmlrpcval $xmlrpc_val
	* @param array $options if 'decode_php_objs' is set in the options array, xmlrpc structs can be decoded into php objects; if 'dates_as_objects' is set xmlrpc datetimes are decoded as php DateTime objects (standard is
	* @return mixed
	*/
	function php_xmlrpc_decode($xmlrpc_val, $options=array())
	{
		switch($xmlrpc_val->kindOf())
		{
			case 'scalar':
				if (in_array('extension_api', $options))
				{
					reset($xmlrpc_val->me);
					list($typ,$val) = each($xmlrpc_val->me);
					switch ($typ)
					{
						case 'dateTime.iso8601':
							$xmlrpc_val->scalar = $val;
							$xmlrpc_val->xmlrpc_type = 'datetime';
							$xmlrpc_val->timestamp = iso8601_decode($val);
							return $xmlrpc_val;
						case 'base64':
							$xmlrpc_val->scalar = $val;
							$xmlrpc_val->type = $typ;
							return $xmlrpc_val;
						default:
							return $xmlrpc_val->scalarval();
					}
				}
				if (in_array('dates_as_objects', $options) && $xmlrpc_val->scalartyp() == 'dateTime.iso8601')
				{
					// we return a Datetime object instead of a string
					// since now the constructor of xmlrpcval accepts safely strings, ints and datetimes,
					// we cater to all 3 cases here
					$out = $xmlrpc_val->scalarval();
					if (is_string($out))
					{
						$out = strtotime($out);
					}
					if (is_int($out))
					{
						$result = new Datetime();
						$result->setTimestamp($out);
						return $result;
					}
					elseif (is_a($out, 'Datetime'))
					{
						return $out;
					}
				}
				return $xmlrpc_val->scalarval();
			case 'array':
				$size = $xmlrpc_val->arraysize();
				$arr = array();
				for($i = 0; $i < $size; $i++)
				{
					$arr[] = php_xmlrpc_decode($xmlrpc_val->arraymem($i), $options);
				}
				return $arr;
			case 'struct':
				$xmlrpc_val->structreset();
				// If user said so, try to rebuild php objects for specific struct vals.
				/// @todo should we raise a warning for class not found?
				// shall we check for proper subclass of xmlrpcval instead of
				// presence of _php_class to detect what we can do?
				if (in_array('decode_php_objs', $options) && $xmlrpc_val->_php_class != ''
					&& class_exists($xmlrpc_val->_php_class))
				{
					$obj = @new $xmlrpc_val->_php_class;
					while(list($key,$value)=$xmlrpc_val->structeach())
					{
						$obj->$key = php_xmlrpc_decode($value, $options);
					}
					return $obj;
				}
				else
				{
					$arr = array();
					while(list($key,$value)=$xmlrpc_val->structeach())
					{
						$arr[$key] = php_xmlrpc_decode($value, $options);
					}
					return $arr;
				}
			case 'msg':
				$paramcount = $xmlrpc_val->getNumParams();
				$arr = array();
				for($i = 0; $i < $paramcount; $i++)
				{
					$arr[] = php_xmlrpc_decode($xmlrpc_val->getParam($i));
				}
				return $arr;
			}
	}

	// This constant left here only for historical reasons...
	// it was used to decide if we have to define xmlrpc_encode on our own, but
	// we do not do it anymore
	if(function_exists('xmlrpc_decode'))
	{
		define('XMLRPC_EPI_ENABLED','1');
	}
	else
	{
		define('XMLRPC_EPI_ENABLED','0');
	}

	/**
	* Takes native php types and encodes them into xmlrpc PHP object format.
	* It will not re-encode xmlrpcval objects.
	*
	* Feature creep -- could support more types via optional type argument
	* (string => datetime support has been added, ??? => base64 not yet)
	*
	* If given a proper options parameter, php object instances will be encoded
	* into 'special' xmlrpc values, that can later be decoded into php objects
	* by calling php_xmlrpc_decode() with a corresponding option
	*
	* @author Dan Libby (dan@libby.com)
	*
	* @param mixed $php_val the value to be converted into an xmlrpcval object
	* @param array $options	can include 'encode_php_objs', 'auto_dates', 'null_extension' or 'extension_api'
	* @return xmlrpcval
	*/
	function php_xmlrpc_encode($php_val, $options=array())
	{
		$type = gettype($php_val);
		switch($type)
		{
			case 'string':
				if (in_array('auto_dates', $options) && preg_match('/^[0-9]{8}T[0-9]{2}:[0-9]{2}:[0-9]{2}$/', $php_val))
					$xmlrpc_val = new xmlrpcval($php_val, $GLOBALS['xmlrpcDateTime']);
				else
					$xmlrpc_val = new xmlrpcval($php_val, $GLOBALS['xmlrpcString']);
				break;
			case 'integer':
				$xmlrpc_val = new xmlrpcval($php_val, $GLOBALS['xmlrpcInt']);
				break;
			case 'double':
				$xmlrpc_val = new xmlrpcval($php_val, $GLOBALS['xmlrpcDouble']);
				break;
				// <G_Giunta_2001-02-29>
				// Add support for encoding/decoding of booleans, since they are supported in PHP
			case 'boolean':
				$xmlrpc_val = new xmlrpcval($php_val, $GLOBALS['xmlrpcBoolean']);
				break;
				// </G_Giunta_2001-02-29>
			case 'array':
				// PHP arrays can be encoded to either xmlrpc structs or arrays,
				// depending on wheter they are hashes or plain 0..n integer indexed
				// A shorter one-liner would be
				// $tmp = array_diff(array_keys($php_val), range(0, count($php_val)-1));
				// but execution time skyrockets!
				$j = 0;
				$arr = array();
				$ko = false;
				foreach($php_val as $key => $val)
				{
					$arr[$key] = php_xmlrpc_encode($val, $options);
					if(!$ko && $key !== $j)
					{
						$ko = true;
					}
					$j++;
				}
				if($ko)
				{
					$xmlrpc_val = new xmlrpcval($arr, $GLOBALS['xmlrpcStruct']);
				}
				else
				{
					$xmlrpc_val = new xmlrpcval($arr, $GLOBALS['xmlrpcArray']);
				}
				break;
			case 'object':
				if(is_a($php_val, 'xmlrpcval'))
				{
					$xmlrpc_val = $php_val;
				}
				else if(is_a($php_val, 'DateTime'))
				{
					$xmlrpc_val = new xmlrpcval($php_val->format('Ymd\TH:i:s'), $GLOBALS['xmlrpcStruct']);
				}
				else
				{
					$arr = array();
					reset($php_val);
					while(list($k,$v) = each($php_val))
					{
						$arr[$k] = php_xmlrpc_encode($v, $options);
					}
					$xmlrpc_val = new xmlrpcval($arr, $GLOBALS['xmlrpcStruct']);
					if (in_array('encode_php_objs', $options))
					{
						// let's save original class name into xmlrpcval:
						// might be useful later on...
						$xmlrpc_val->_php_class = get_class($php_val);
					}
				}
				break;
			case 'NULL':
				if (in_array('extension_api', $options))
				{
					$xmlrpc_val = new xmlrpcval('', $GLOBALS['xmlrpcString']);
				}
				else if (in_array('null_extension', $options))
				{
					$xmlrpc_val = new xmlrpcval('', $GLOBALS['xmlrpcNull']);
				}
				else
				{
					$xmlrpc_val = new xmlrpcval();
				}
				break;
			case 'resource':
				if (in_array('extension_api', $options))
				{
					$xmlrpc_val = new xmlrpcval((int)$php_val, $GLOBALS['xmlrpcInt']);
				}
				else
				{
					$xmlrpc_val = new xmlrpcval();
				}
			// catch "user function", "unknown type"
			default:
				// giancarlo pinerolo <ping@alt.it>
				// it has to return
				// an empty object in case, not a boolean.
				$xmlrpc_val = new xmlrpcval();
				break;
			}
			return $xmlrpc_val;
	}

	/**
	* Convert the xml representation of a method response, method request or single
	* xmlrpc value into the appropriate object (a.k.a. deserialize)
	* @param string $xml_val
	* @param array $options
	* @return mixed false on error, or an instance of either xmlrpcval, xmlrpcmsg or xmlrpcresp
	*/
	function php_xmlrpc_decode_xml($xml_val, $options=array())
	{
		$GLOBALS['_xh'] = array();
		$GLOBALS['_xh']['ac'] = '';
		$GLOBALS['_xh']['stack'] = array();
		$GLOBALS['_xh']['valuestack'] = array();
		$GLOBALS['_xh']['params'] = array();
		$GLOBALS['_xh']['pt'] = array();
		$GLOBALS['_xh']['isf'] = 0;
		$GLOBALS['_xh']['isf_reason'] = '';
		$GLOBALS['_xh']['method'] = false;
		$GLOBALS['_xh']['rt'] = '';
		/// @todo 'guestimate' encoding
		$parser = xml_parser_create();
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, true);
		// What if internal encoding is not in one of the 3 allowed?
		// we use the broadest one, ie. utf8!
		if (!in_array($GLOBALS['xmlrpc_internalencoding'], array('UTF-8', 'ISO-8859-1', 'US-ASCII')))
		{
			xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, 'UTF-8');
		}
		else
		{
			xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, $GLOBALS['xmlrpc_internalencoding']);
		}
		xml_set_element_handler($parser, 'xmlrpc_se_any', 'xmlrpc_ee');
		xml_set_character_data_handler($parser, 'xmlrpc_cd');
		xml_set_default_handler($parser, 'xmlrpc_dh');
		if(!xml_parse($parser, $xml_val, 1))
		{
			$errstr = sprintf('XML error: %s at line %d, column %d',
						xml_error_string(xml_get_error_code($parser)),
						xml_get_current_line_number($parser), xml_get_current_column_number($parser));
			error_log($errstr);
			xml_parser_free($parser);
			return false;
		}
		xml_parser_free($parser);
		if ($GLOBALS['_xh']['isf'] > 1) // test that $GLOBALS['_xh']['value'] is an obj, too???
		{
			error_log($GLOBALS['_xh']['isf_reason']);
			return false;
		}
		switch ($GLOBALS['_xh']['rt'])
		{
			case 'methodresponse':
				$v =& $GLOBALS['_xh']['value'];
				if ($GLOBALS['_xh']['isf'] == 1)
				{
					$vc = $v->structmem('faultCode');
					$vs = $v->structmem('faultString');
					$r = new xmlrpcresp(0, $vc->scalarval(), $vs->scalarval());
				}
				else
				{
					$r = new xmlrpcresp($v);
				}
				return $r;
			case 'methodcall':
				$m = new xmlrpcmsg($GLOBALS['_xh']['method']);
				for($i=0; $i < count($GLOBALS['_xh']['params']); $i++)
				{
					$m->addParam($GLOBALS['_xh']['params'][$i]);
				}
				return $m;
			case 'value':
				return $GLOBALS['_xh']['value'];
			default:
				return false;
		}
	}

	/**
	* decode a string that is encoded w/ "chunked" transfer encoding
	* as defined in rfc2068 par. 19.4.6
	* code shamelessly stolen from nusoap library by Dietrich Ayala
	*
	* @param string $buffer the string to be decoded
	* @return string
	*/
	function decode_chunked($buffer)
	{
		// length := 0
		$length = 0;
		$new = '';

		// read chunk-size, chunk-extension (if any) and crlf
		// get the position of the linebreak
		$chunkend = strpos($buffer,"\r\n") + 2;
		$temp = substr($buffer,0,$chunkend);
		$chunk_size = hexdec( trim($temp) );
		$chunkstart = $chunkend;
		while($chunk_size > 0)
		{
			$chunkend = strpos($buffer, "\r\n", $chunkstart + $chunk_size);

			// just in case we got a broken connection
			if($chunkend == false)
			{
				$chunk = substr($buffer,$chunkstart);
				// append chunk-data to entity-body
				$new .= $chunk;
				$length += strlen($chunk);
				break;
			}

			// read chunk-data and crlf
			$chunk = substr($buffer,$chunkstart,$chunkend-$chunkstart);
			// append chunk-data to entity-body
			$new .= $chunk;
			// length := length + chunk-size
			$length += strlen($chunk);
			// read chunk-size and crlf
			$chunkstart = $chunkend + 2;

			$chunkend = strpos($buffer,"\r\n",$chunkstart)+2;
			if($chunkend == false)
			{
				break; //just in case we got a broken connection
			}
			$temp = substr($buffer,$chunkstart,$chunkend-$chunkstart);
			$chunk_size = hexdec( trim($temp) );
			$chunkstart = $chunkend;
		}
		return $new;
	}

	/**
	* xml charset encoding guessing helper function.
	* Tries to determine the charset encoding of an XML chunk received over HTTP.
	* NB: according to the spec (RFC 3023), if text/xml content-type is received over HTTP without a content-type,
	* we SHOULD assume it is strictly US-ASCII. But we try to be more tolerant of unconforming (legacy?) clients/servers,
	* which will be most probably using UTF-8 anyway...
	*
	* @param string $httpheaders the http Content-type header
	* @param string $xmlchunk xml content buffer
	* @param string $encoding_prefs comma separated list of character encodings to be used as default (when mb extension is enabled)
	*
	* @todo explore usage of mb_http_input(): does it detect http headers + post data? if so, use it instead of hand-detection!!!
	*/
	function guess_encoding($httpheader='', $xmlchunk='', $encoding_prefs=null)
	{
		// discussion: see http://www.yale.edu/pclt/encoding/
		// 1 - test if encoding is specified in HTTP HEADERS

		//Details:
		// LWS:           (\13\10)?( |\t)+
		// token:         (any char but excluded stuff)+
		// quoted string: " (any char but double quotes and cointrol chars)* "
		// header:        Content-type = ...; charset=value(; ...)*
		//   where value is of type token, no LWS allowed between 'charset' and value
		// Note: we do not check for invalid chars in VALUE:
		//   this had better be done using pure ereg as below
		// Note 2: we might be removing whitespace/tabs that ought to be left in if
		//   the received charset is a quoted string. But nobody uses such charset names...

		/// @todo this test will pass if ANY header has charset specification, not only Content-Type. Fix it?
		$matches = array();
		if(preg_match('/;\s*charset\s*=([^;]+)/i', $httpheader, $matches))
		{
			return strtoupper(trim($matches[1], " \t\""));
		}

		// 2 - scan the first bytes of the data for a UTF-16 (or other) BOM pattern
		//     (source: http://www.w3.org/TR/2000/REC-xml-20001006)
		//     NOTE: actually, according to the spec, even if we find the BOM and determine
		//     an encoding, we should check if there is an encoding specified
		//     in the xml declaration, and verify if they match.
		/// @todo implement check as described above?
		/// @todo implement check for first bytes of string even without a BOM? (It sure looks harder than for cases WITH a BOM)
		if(preg_match('/^(\x00\x00\xFE\xFF|\xFF\xFE\x00\x00|\x00\x00\xFF\xFE|\xFE\xFF\x00\x00)/', $xmlchunk))
		{
			return 'UCS-4';
		}
		elseif(preg_match('/^(\xFE\xFF|\xFF\xFE)/', $xmlchunk))
		{
			return 'UTF-16';
		}
		elseif(preg_match('/^(\xEF\xBB\xBF)/', $xmlchunk))
		{
			return 'UTF-8';
		}

		// 3 - test if encoding is specified in the xml declaration
		// Details:
		// SPACE:         (#x20 | #x9 | #xD | #xA)+ === [ \x9\xD\xA]+
		// EQ:            SPACE?=SPACE? === [ \x9\xD\xA]*=[ \x9\xD\xA]*
		if (preg_match('/^<\?xml\s+version\s*=\s*'. "((?:\"[a-zA-Z0-9_.:-]+\")|(?:'[a-zA-Z0-9_.:-]+'))".
			'\s+encoding\s*=\s*' . "((?:\"[A-Za-z][A-Za-z0-9._-]*\")|(?:'[A-Za-z][A-Za-z0-9._-]*'))/",
			$xmlchunk, $matches))
		{
			return strtoupper(substr($matches[2], 1, -1));
		}

		// 4 - if mbstring is available, let it do the guesswork
		// NB: we favour finding an encoding that is compatible with what we can process
		if(extension_loaded('mbstring'))
		{
			if($encoding_prefs)
			{
				$enc = mb_detect_encoding($xmlchunk, $encoding_prefs);
			}
			else
			{
				$enc = mb_detect_encoding($xmlchunk);
			}
			// NB: mb_detect likes to call it ascii, xml parser likes to call it US_ASCII...
			// IANA also likes better US-ASCII, so go with it
			if($enc == 'ASCII')
			{
				$enc = 'US-'.$enc;
			}
			return $enc;
		}
		else
		{
			// no encoding specified: as per HTTP1.1 assume it is iso-8859-1?
			// Both RFC 2616 (HTTP 1.1) and 1945 (HTTP 1.0) clearly state that for text/xxx content types
			// this should be the standard. And we should be getting text/xml as request and response.
			// BUT we have to be backward compatible with the lib, which always used UTF-8 as default...
			return $GLOBALS['xmlrpc_defencoding'];
		}
	}

	/**
	* Checks if a given charset encoding is present in a list of encodings or
	* if it is a valid subset of any encoding in the list
	* @param string $encoding charset to be tested
	* @param mixed $validlist comma separated list of valid charsets (or array of charsets)
	*/
	function is_valid_charset($encoding, $validlist)
	{
		$charset_supersets = array(
			'US-ASCII' => array ('ISO-8859-1', 'ISO-8859-2', 'ISO-8859-3', 'ISO-8859-4',
				'ISO-8859-5', 'ISO-8859-6', 'ISO-8859-7', 'ISO-8859-8',
				'ISO-8859-9', 'ISO-8859-10', 'ISO-8859-11', 'ISO-8859-12',
				'ISO-8859-13', 'ISO-8859-14', 'ISO-8859-15', 'UTF-8',
				'EUC-JP', 'EUC-', 'EUC-KR', 'EUC-CN')
		);
		if (is_string($validlist))
			$validlist = explode(',', $validlist);
		if (@in_array(strtoupper($encoding), $validlist))
			return true;
		else
		{
			if (array_key_exists($encoding, $charset_supersets))
				foreach ($validlist as $allowed)
					if (in_array($allowed, $charset_supersets[$encoding]))
						return true;
				return false;
		}
	}

////////////////////////////////////////////
	
	

/**
 * JSON extension to the PHP-XMLRPC lib
 *
 * For more info see:
 * http://www.json.org/
 * http://json-rpc.org/
 *
 * @version $Id: jsonrpc.inc,v 1.36 2009/02/05 09:50:59 ggiunta Exp $
 * @author Gaetano Giunta
 * @copyright (c) 2005-2009 G. Giunta
 * @license code licensed under the BSD License: http://phpxmlrpc.sourceforge.net/license.txt
 *
 * @todo the JSON proposed RFC states that when making json calls, we should
 *       specify an 'accep: application/json' http header. Currently we either
 *       do not otuput an 'accept' header or specify  'any' (in curl mode)
 **/

	// requires: xmlrpc.inc 2.0 or later

	// Note: the json spec omits \v, but it is present in ECMA-262, so we allow it
	$GLOBALS['ecma262_entities'] = array(
		'b' => chr(8),
		'f' => chr(12),
		'n' => chr(10),
		'r' => chr(13),
		't' => chr(9),
		'v' => chr(11)
	);

	// tables used for transcoding different charsets into us-ascii javascript

	$GLOBALS['ecma262_iso88591_Entities']=array();
	$GLOBALS['ecma262_iso88591_Entities']['in'] = array();
	$GLOBALS['ecma262_iso88591_Entities']['out'] = array();
	for ($i = 0; $i < 32; $i++)
	{
		$GLOBALS['ecma262_iso88591_Entities']['in'][] = chr($i);
		$GLOBALS['ecma262_iso88591_Entities']['out'][] = sprintf('\u%\'04x', $i);
	}
	for ($i = 160; $i < 256; $i++)
	{
		$GLOBALS['ecma262_iso88591_Entities']['in'][] = chr($i);
		$GLOBALS['ecma262_iso88591_Entities']['out'][] = sprintf('\u%\'04x', $i);
	}

	/**
	* Encode php strings to valid JSON unicode representation.
	* All chars outside ASCII range are converted to \uXXXX for maximum portability.
	* @param string $data (in iso-8859-1 charset by default)
	* @param string charset of source string, defaults to $GLOBALS['xmlrpc_internalencoding']
	* @param string charset of the encoded string, defaults to ASCII for maximum interoperabilty
	* @return string
	* @access private
	* @todo add support for UTF-16 as destination charset instead of ASCII
	* @todo add support for UTF-16 as source charset
	*/
	function json_encode_entities($data, $src_encoding='', $dest_encoding='')
	{
		if ($src_encoding == '')
		{
			// lame, but we know no better...
			$src_encoding = $GLOBALS['xmlrpc_internalencoding'];
		}

		switch(strtoupper($src_encoding.'_'.$dest_encoding))
		{
			case 'ISO-8859-1_':
			case 'ISO-8859-1_US-ASCII':
				$escaped_data = str_replace(array('\\', '"', '/', "\t", "\n", "\r", chr(8), chr(11), chr(12)), array('\\\\', '\"', '\/', '\t', '\n', '\r', '\b', '\v', '\f'), $data);
				$escaped_data = str_replace($GLOBALS['ecma262_iso88591_Entities']['in'], $GLOBALS['ecma262_iso88591_Entities']['out'], $escaped_data);
				break;
			case 'ISO-8859-1_UTF-8':
				$escaped_data = str_replace(array('\\', '"', '/', "\t", "\n", "\r", chr(8), chr(11), chr(12)), array('\\\\', '\"', '\/', '\t', '\n', '\r', '\b', '\v', '\f'), $data);
				$escaped_data = utf8_encode($escaped_data);
				break;
			case 'ISO-8859-1_ISO-8859-1':
			case 'US-ASCII_US-ASCII':
			case 'US-ASCII_UTF-8':
			case 'US-ASCII_':
			case 'US-ASCII_ISO-8859-1':
			case 'UTF-8_UTF-8':
				$escaped_data = str_replace(array('\\', '"', '/', "\t", "\n", "\r", chr(8), chr(11), chr(12)), array('\\\\', '\"', '\/', '\t', '\n', '\r', '\b', '\v', '\f'), $data);
				break;
			case 'UTF-8_':
			case 'UTF-8_US-ASCII':
			case 'UTF-8_ISO-8859-1':
	// NB: this will choke on invalid UTF-8, going most likely beyond EOF
	$escaped_data = "";
	// be kind to users creating string jsonrpcvals out of different php types
	$data = (string) $data;
	$ns = strlen ($data);
	for ($nn = 0; $nn < $ns; $nn++)
	{
		$ch = $data[$nn];
		$ii = ord($ch);
		//1 7 0bbbbbbb (127)
		if ($ii < 128)
		{
			/// @todo shall we replace this with a (supposedly) faster str_replace?
			switch($ii){
				case 8:
					$escaped_data .= '\b';
					break;
				case 9:
					$escaped_data .= '\t';
					break;
				case 10:
					$escaped_data .= '\n';
					break;
				case 11:
					$escaped_data .= '\v';
					break;
				case 12:
					$escaped_data .= '\f';
					break;
				case 13:
					$escaped_data .= '\r';
					break;
				case 34:
					$escaped_data .= '\"';
					break;
				case 47:
					$escaped_data .= '\/';
					break;
				case 92:
					$escaped_data .= '\\\\';
					break;
				default:
					$escaped_data .= $ch;
			} // switch
		}
		//2 11 110bbbbb 10bbbbbb (2047)
		else if ($ii>>5 == 6)
		{
			$b1 = ($ii & 31);
			$ii = ord($data[$nn+1]);
			$b2 = ($ii & 63);
			$ii = ($b1 * 64) + $b2;
			$ent = sprintf ('\u%\'04x', $ii);
			$escaped_data .= $ent;
			$nn += 1;
		}
		//3 16 1110bbbb 10bbbbbb 10bbbbbb
		else if ($ii>>4 == 14)
		{
			$b1 = ($ii & 15);
			$ii = ord($data[$nn+1]);
			$b2 = ($ii & 63);
			$ii = ord($data[$nn+2]);
			$b3 = ($ii & 63);
			$ii = ((($b1 * 64) + $b2) * 64) + $b3;
			$ent = sprintf ('\u%\'04x', $ii);
			$escaped_data .= $ent;
			$nn += 2;
		}
		//4 21 11110bbb 10bbbbbb 10bbbbbb 10bbbbbb
		else if ($ii>>3 == 30)
		{
			$b1 = ($ii & 7);
			$ii = ord($data[$nn+1]);
			$b2 = ($ii & 63);
			$ii = ord($data[$nn+2]);
			$b3 = ($ii & 63);
			$ii = ord($data[$nn+3]);
			$b4 = ($ii & 63);
			$ii = ((((($b1 * 64) + $b2) * 64) + $b3) * 64) + $b4;
			$ent = sprintf ('\u%\'04x', $ii);
			$escaped_data .= $ent;
			$nn += 3;
		}
	}
				break;
			default:
				$escaped_data = '';
				error_log("Converting from $src_encoding to $dest_encoding: not supported...");
		} // switch
		return $escaped_data;

	/*
		$length = strlen($data);
		$escapeddata = "";
		for($position = 0; $position < $length; $position++)
		{
			$character = substr($data, $position, 1);
			$code = ord($character);
			switch($code)
			{
				case 8:
					$character = '\b';
					break;
				case 9:
					$character = '\t';
					break;
				case 10:
					$character = '\n';
					break;
				case 12:
					$character = '\f';
					break;
				case 13:
					$character = '\r';
					break;
				case 34:
					$character = '\"';
					break;
				case 47:
					$character = '\/';
					break;
				case 92:
					$character = '\\\\';
					break;
				default:
					if($code < 32 || $code > 159)
					{
						$character = "\u".str_pad(dechex($code), 4, '0', STR_PAD_LEFT);
					}
					break;
			}
			$escapeddata .= $character;
		}
		return $escapeddata;
		*/
	}

	/**
	* Parse a JSON string.
	* NB: try to accept any valid string according to ECMA, even though the JSON
	* spec is much more strict.
	* Assumes input is UTF-8...
	* @param string $data a json string
	* @param bool $return_phpvals if true, do not rebuild jsonrpcval objects, but plain php values
	* @param string $src_encoding
	* @param string $dest_encoding
	* @return bool
	* @access private
	* @todo support for other source encodings than UTF-8
	* @todo optimization creep: build elements of arrays/objects asap instead of counting chars many times
	* @todo we should move to xmlrpc_defencoding and xmlrpc_internalencoding as predefined values, but it would make this even slower...
	*       Maybe just move those two parameters outside of here into callers?
	*
	* @bug parsing of "[1]// comment here" works in ie/ff, but not here
	* @bug parsing of "[.1]" works in ie/ff, but not here
	* @bug parsing of "[01]" works in ie/ff, but not here
	* @bug parsing of "{true:1}" works here, but not in ie/ff
	* @bug parsing of "{a b:1}" works here, but not in ie/ff
	*/
	function json_parse($data, $return_phpvals=false, $src_encoding='UTF-8', $dest_encoding='ISO-8859-1')
	{
		// optimization creep: this is quite costly. Is there any better way to achieve it?
		// also note that json does not really allow comments...
		$data = preg_replace(array(
			// eliminate single line comments in '// ...' form
			// REMOVED BECAUSE OF BUGS: 1-does not match at end of non-empty line, 2-eats inside strings, too
			//'#^\s*//(.*)$#m',
			// eliminate multi-line comments in '/* ... */' form, at start of string
			'#^\s*/\*(.*)\*/#Us',
			// eliminate multi-line comments in '/* ... */' form, at end of string
			'#/\*(.*)\*/\s*$#Us'
		), '', $data);

		$data = trim($data); // remove excess whitespace

		if ($data == '')
		{
			$GLOBALS['_xh']['isf_reason'] = 'Invalid data (empty string?)';
			return false;
		}

//echo "Parsing string (".$data.")\n";
		switch($data[0])
		{
			case '"':
			case "'":
				$len = strlen($data);
				// quoted string: check for closing char first
				if ($data[$len-1] == $data[0] && $len > 1)
				{
					// UTF8-decode (or encode) string
					// NB: we MUST do this BEFORE looking for \xNN, \uMMMM or other escape sequences
					if ($src_encoding == 'UTF-8' && ($dest_encoding == 'ISO-8859-1' || $dest_encoding == 'US-ASCII'))
					{
						$data = utf8_decode($data);
						$len = strlen($data);
					}
					else
					{
						if ($dest_encoding == 'UTF-8' && ($src_encoding == 'ISO-8859-1' || $src_encoding == 'US-ASCII'))
						{
							$data = utf8_encode($data);
							$len = strlen($data);
						}
						//else
						//{
						//	$GLOBALS['_xh']['value'] = $GLOBALS['_xh']['ac'];
						//}
					}

					$outdata = '';
					$delim = $data[0];
					for ($i = 1; $i < $len-1; $i++)
					{
						switch($data[$i])
						{
							case '\\':
								if ($i == $len-2)
								{
									break;
								}
								switch($data[$i+1])
								{
									case 'b':
									case 'f':
									case 'n':
									case 'r':
									case 't':
									case 'v':
										$outdata .= $GLOBALS['ecma262_entities'][$data[$i+1]];
										$i++;
										break;
									case 'u':
										// most likely unicode code point
										if ($dest_encoding == 'UTF-8')
										{
											/// @todo see if this is faster / works in all cases
											//$outdata .= utf8_encode(chr(hexdec(substr($data, $i+4, 2))));

											// encode the UTF code point into utf-8...
											$ii = hexdec(substr($data, $i+2, 4));
											if ($ii < 0x80)
											{
												$outdata .= chr($ii);
											}
											else if ($ii <= 0x800)
											{
												$outdata .= chr(0xc0 | $ii >> 6) . chr(0x80 | ($ii & 0x3f));
											}
											else if ($ii <= 0x10000)
											{
												$outdata .= chr(0xe0 | $ii >> 12) . chr(0x80 | ($ii >> 6 & 0x3f)) . chr(0x80 | ($ii & 0x3f));
											}
											else
											{
												$outdata .= chr(0xf0 | $ii >> 20) . chr(0x80 | ($ii >> 12 & 0x3f)) . chr(0x80 | ($ii >> 6 & 0x3f)) . chr(0x80 | ($ii & 0x3f));
											}
											$i += 5;
										}
										else
										{
											// Note: we only decode code points below 256, so we take the last 2 chars of the unicode representation
											$outdata .= chr(hexdec(substr($data, $i+4, 2)));
											$i += 5;
										}
										break;
									case 'x':
										// most likely unicode code point in hexadecimal
										// Note: the json spec omits this case, but ECMA-262 does not...
										if ($dest_encoding == 'UTF-8')
										{
											// encode the UTF code point into utf-8...
											$ii = hexdec(substr($data, $i+2, 2));
											if ($ii < 0x80)
											{
												$outdata .= chr($ii);
											}
											else if ($ii <= 0x800)
											{
												$outdata .= chr(0xc0 | $ii >> 6) . chr(0x80 | ($ii & 0x3f));
											}
											else if ($ii <= 0x10000)
											{
												$outdata .= chr(0xe0 | $ii >> 12) . chr(0x80 | ($ii >> 6 & 0x3f)) . chr(0x80 | ($ii & 0x3f));
											}
											else
											{
												$outdata .= chr(0xf0 | $ii >> 20) . chr(0x80 | ($ii >> 12 & 0x3f)) . chr(0x80 | ($ii >> 6 & 0x3f)) . chr(0x80 | ($ii & 0x3f));
											}
											$i += 3;
										}
										else
										{
											$outdata .= chr(hexdec(substr($data, $i+2, 2)));
											$i += 3;
										}
										break;
									case '0':
									case '1':
									case '2':
									case '3':
									case '4':
									case '5':
									case '6':
									case '7':
									case '8':
									case '9':
										// Note: ECMA-262 forbids these escapes, we just skip it...
										break;
									default:
										// Note: Javascript 1.5 on http://developer.mozilla.org/en/docs/Core_JavaScript_1.5_Guide
										// mentions syntax /XXX with X octal number, but ECMA262
										// explicitly forbids it...
										$outdata .= $data[$i+1];
										$i++;
								} // end of switch on slash char found
								break;
							case $delim:
								// found unquoted end of string in middle of string
								$GLOBALS['_xh']['isf_reason'] = 'Invalid data (unescaped quote char inside string?)';
								return false;
							case "\n":
							case "\r":
								$GLOBALS['_xh']['isf_reason'] = 'Invalid data (line terminator char inside string?)';
								return false;
							default:
								$outdata .= $data[$i];
						}
					} // end of loop on string chars
//echo "Found a string\n";
					$GLOBALS['_xh']['vt'] = 'string';
					$GLOBALS['_xh']['value'] = $outdata;
				}
				else
				{
					// string without a terminating quote
					$GLOBALS['_xh']['isf_reason'] = 'Invalid data (string missing closing quote?)';
					return false;
				}
				break;
			case '[':
			case '{':
				$len = strlen($data);
				// object and array notation: use the same parsing code
				if ($data[0] == '[')
				{
					if ($data[$len-1] != ']')
					{
						// invalid array
						$GLOBALS['_xh']['isf_reason'] = 'Invalid data (array missing closing bracket?)';
						return false;
					}
					$GLOBALS['_xh']['vt'] = 'array';
				}
				else
				{
					if ($data[$len-1] != '}')
					{
						// invalid object
						$GLOBALS['_xh']['isf_reason'] = 'Invalid data (object missing closing bracket?)';
						return false;
					}
					$GLOBALS['_xh']['vt'] = 'struct';
				}

				$data = trim(substr($data, 1, -1));
//echo "Parsing array/obj (".$data.")\n";
				if ($data == '')
				{
					// empty array/object
					$GLOBALS['_xh']['value'] = array();
				}
				else
				{
					$valuestack = array();
					$last = array('type' => 'sl', 'start' => 0);
					$len = strlen($data);
					$value = array();
					$keypos = null;
					//$ac = '';
					$vt = '';
					//$start = 0;
					for ($i = 0; $i <= $len; $i++)
					{
						if ($i == $len || ($data[$i] == ',' && $last['type'] == 'sl'))
						{

							// end of element: push it onto array
							$slice = substr($data, $last['start'], ($i - $last['start']));
							//$slice = trim($slice); useless here, sincewe trim it on sub-elementparsing
//echo "Found slice (".$slice.")\n";

							//$valuestack[] = $last; // necessario ???
							//$last = array('type' => 'sl', 'start' => ($i + 1));
							if ($GLOBALS['_xh']['vt'] == 'array')
							{
								if ($slice == '')
								{
									// 'elided' element: ecma supports it, so do we
									// what should happen here in fact is that
									// "array index is augmented and element is undefined"

									// NOTE: Firefox's js engine does not create
									// trailing undefined elements, while IE does...
									//if ($i < $len)
									//{
										if ($return_phpvals)
										{
											$value[] = null;
										}
										else
										{
											$value[] = new jsonrpcval(null, 'null');
										}
									//}
								}
								else
								{
									if (!json_parse($slice, $return_phpvals, $src_encoding, $dest_encoding))
									{
										return false;
									}
									else
									{
										$value[] = $GLOBALS['_xh']['value'];
										$GLOBALS['_xh']['vt'] = 'array';
									}
								}
							}
							else
							{
								if (!$keypos)
								{
									$GLOBALS['_xh']['isf_reason'] = 'Invalid data (missing object member name?)';
									return false;
								}
								else
								{
									if (!json_parse(substr($data, $last['start'], $keypos-$last['start']), true, $src_encoding, $dest_encoding) ||
										$GLOBALS['_xh']['vt'] != 'string')
									{
										// object member name received unquoted: what to do???
										// be tolerant as much as we can. ecma tolerates numbers as identifiers, too...
										$key = trim(substr($data, $last['start'], $keypos-$last['start']));
									}
									else
									{
										$key = $GLOBALS['_xh']['value'];
									}

//echo "Use extension: $use_extension\n";
									if (!json_parse(substr($data, $keypos+1, $i-$keypos-1), $return_phpvals, $src_encoding, $dest_encoding))
									{
										return false;
									}
									$value[$key] = $GLOBALS['_xh']['value'];
									$GLOBALS['_xh']['vt'] = 'struct';
									$keypos = null;
								}
							}
							$last['start'] = $i + 1;
							$vt = ''; // reset type of val found
						}
						else if ($data[$i] == '"' || $data[$i] == "'")
						{
							// found beginning of string: run till end
							$ok = false;
							for ($j = $i+1; $j < $len; $j++)
							{
								if ($data[$j] == $data[$i])
								{
									$ok = true;
									break;
								}
								else if($data[$j] == '\\')
								{
									$j++;
								}
							}
							if ($ok)
							{
								$i = $j; // advance pointer to end of string
								$vt = 'st';
							}
							else
							{
								$GLOBALS['_xh']['isf_reason'] = 'Invalid data (string missing closing quote?)';
								return false;
							}
						}
						else if ($data[$i] == "[")
						{
							$valuestack[] = $last;
							$last = array('type' => 'ar', 'start' => $i);
						}
						else if ($data[$i] == '{')
						{
							$valuestack[] = $last;
							$last = array('type' => 'ob', 'start' => $i);
						}
						else if ($data[$i] == "]")
						{
							if ($last['type'] == 'ar')
							{
								$last = array_pop($valuestack);
								$vt = 'ar';
							}
							else
							{
								$GLOBALS['_xh']['isf_reason'] = 'Invalid data (unmatched array closing bracket?)';
								return false;
							}
						}
						else if ($data[$i] == '}')
						{
							if ($last['type'] == 'ob')
							{
								$last = array_pop($valuestack);
								$vt = 'ob';
							}
							else
							{
								$GLOBALS['_xh']['isf_reason'] = 'Invalid data (unmatched object closing bracket?)';
								return false;
							}
						}
						else if ($data[$i] == ':' && $last['type'] == 'sl' && !$keypos)
						{
//echo "Found key stop at pos. $i\n";
							$keypos = $i;
						}
						else if ($data[$i] == '/' && $i < $len-1 && $data[$i+1] == "*")
						{
							// found beginning of comment: run till end
							$ok = false;
							for ($j = $i+2; $j < $len-1; $j++)
							{
								if ($data[$j] == '*' && $data[$j+1] == '/')
								{
									$ok = true;
									break;
								}
							}
							if ($ok)
							{
								$i = $j+1; // advance pointer to end of string
							}
							else
							{
								$GLOBALS['_xh']['isf_reason'] = 'Invalid data (comment missing closing tag?)';
								return false;
							}
						}

					}
					$GLOBALS['_xh']['value'] = $value;
				}
				//return true;
				break;
			default:
//echo "Found a scalar val (not string): '$data'\n";
				// be tolerant of uppercase chars in numbers/booleans/null
				$data = strtolower($data);
				if ($data == "true")
				{
//echo "Found a true\n";
					$GLOBALS['_xh']['value'] = true;
					$GLOBALS['_xh']['vt'] = 'boolean';
				}
				else if ($data == "false")
				{
//echo "Found a false\n";
					$GLOBALS['_xh']['value'] = false;
					$GLOBALS['_xh']['vt'] = 'boolean';
				}
				else if ($data == "null")
				{
//echo "Found a null\n";
					$GLOBALS['_xh']['value'] = null;
					$GLOBALS['_xh']['vt'] = 'null';
				}
				// we could use is_numeric here, but rules are slightly different,
				// e.g. 012 is NOT valid according to JSON or ECMA, but browsers inetrpret it as octal
				/// @todo add support for .5
				/// @todo add support for numbers in octal notation, eg. 010
				else if (preg_match("#^-?(0|[1-9][0-9]*)(\.[0-9]*)?([e][+-]?[0-9]+)?$#" ,$data))
				{
					if (preg_match('#[.e]#', $data))
					{
//echo "Found a double\n";
						// floating point
						$GLOBALS['_xh']['value'] = (double)$data;
						$GLOBALS['_xh']['vt'] = 'double';
					}
					else
					{
//echo "Found an int\n";
						//integer
						$GLOBALS['_xh']['value'] = (int)$data;
						$GLOBALS['_xh']['vt'] = 'int';
					}
					//return true;
				}
				else if (preg_match("#^0x[0-9a-f]+$#", $data))
				{
					// int in hex notation: not in JSON, but in ECMA...
					$GLOBALS['_xh']['vt'] = 'int';
					$GLOBALS['_xh']['value'] = hexdec(substr($data, 2));
				}
				else
				{
					$GLOBALS['_xh']['isf_reason'] = 'Invalid data';
					return false;
				}
		} // switch $data[0]

		if (!$return_phpvals)
		{
			$GLOBALS['_xh']['value'] = new jsonrpcval($GLOBALS['_xh']['value'], $GLOBALS['_xh']['vt']);
		}

		return true;

	}

	/**
	* Used in place of json_parse to take advantage of native json decoding when available:
	* it parses either a jsonrpc request or a response.
	* NB: php native decoding of json balks anyway at anything but array / struct as top level element
	* @access private
	* @bug unicode chars are handled differently from this and json_parse...
	* @todo add support for src and dest encoding!!!
	*/
	function json_parse_native($data)
	{
//echo "Parsing string - internal way (".$data.")\n";
		$out = json_decode($data, true);
		if (!is_array($out))
		{
			//$GLOBALS['_xh']['isf'] = 2;
			$GLOBALS['_xh']['isf_reason'] = 'JSON parsing failed';
			return false;
		}
		// decoding will be fine for a jsonrpc error response, so we have to
		// check for it by hand here...
		//else if (array_key_exists('error', $out) && $out['error'] != null)
		//{
		//	$GLOBALS['_xh']['isf'] = 1;
			//$GLOBALS['_xh']['value'] = $out['error'];
		//}
		else
		{
			$GLOBALS['_xh']['value'] = $out;
			return true;
		}
	}

	/**
	* Parse a json string, expected to be jsonrpc request format
	* @access private
	*/
	function jsonrpc_parse_req($data, $return_phpvals=false, $use_extension=false, $src_encoding='')
	{
		$GLOBALS['_xh']['isf']=0;
		$GLOBALS['_xh']['isf_reason']='';
		$GLOBALS['_xh']['pt'] = array();
		if ($return_phpvals && $use_extension)
		{
			$ok = json_parse_native($data);
		}
		else
		{
			$ok = json_parse($data, $return_phpvals, $src_encoding);
		}
		if ($ok)
		{
			if (!$return_phpvals)
				$GLOBALS['_xh']['value'] = @$GLOBALS['_xh']['value']->me['struct'];

			if (!is_array($GLOBALS['_xh']['value']) || !array_key_exists('method', $GLOBALS['_xh']['value'])
				|| !array_key_exists('params', $GLOBALS['_xh']['value']) || !array_key_exists('id', $GLOBALS['_xh']['value']))
			{
				$GLOBALS['_xh']['isf_reason'] = 'JSON parsing did not return correct jsonrpc request object';
				return false;
			}
			else
			{
				$GLOBALS['_xh']['method'] = $GLOBALS['_xh']['value']['method'];
				$GLOBALS['_xh']['params'] = $GLOBALS['_xh']['value']['params'];
				$GLOBALS['_xh']['id'] = $GLOBALS['_xh']['value']['id'];
				if (!$return_phpvals)
				{
					/// @todo we should check for appropriate type for method name and params array...
					$GLOBALS['_xh']['method'] = $GLOBALS['_xh']['method']->scalarval();
					$GLOBALS['_xh']['params'] = $GLOBALS['_xh']['params']->me['array'];
					$GLOBALS['_xh']['id'] = php_jsonrpc_decode($GLOBALS['_xh']['id']);
				}
				else
				{
					// to allow 'phpvals' type servers to work, we need to rebuild $GLOBALS['_xh']['pt'] too
					foreach($GLOBALS['_xh']['params'] as $val)
					{
					    // since we rebuild this after converting json values to php,
					    // we've lost the info about array/struct, and we try to rebuild it
					    /// @bug empty objects will be recognized as empty arrays
					    /// @bug an object with keys '0', '1', ... 'n' will be recognized as an array
					    $typ = gettype($val);
					    if ($typ == 'array' && count($val) && count(array_diff_key($val, array_fill(0, count($val), null))) !== 0)
					    {
    					    $typ = 'object';
					    }
						$GLOBALS['_xh']['pt'][] = php_2_jsonrpc_type($typ);
					}
				}
				return true;
			}
		}
		else
		{
			return false;
		}
	}

	/**
	* Parse a json string, expected to be in json-rpc response format.
	* @access private
	* @todo checks missing:
	*       - no extra members in response
	*       - no extra members in error struct
	*       - resp. ID validation
	*/
	function jsonrpc_parse_resp($data, $return_phpvals=false, $use_extension=false, $src_encoding='')
	{
		$GLOBALS['_xh']['isf']=0;
		$GLOBALS['_xh']['isf_reason']='';
		if ($return_phpvals && $use_extension)
		{
			$ok = json_parse_native($data);
		}
		else
		{
			$ok = json_parse($data, $return_phpvals, $src_encoding);
		}
		if ($ok)
		{
			if (!$return_phpvals)
			{
				$GLOBALS['_xh']['value'] = @$GLOBALS['_xh']['value']->me['struct'];
			}
			if (!is_array($GLOBALS['_xh']['value']) || !array_key_exists('result', $GLOBALS['_xh']['value'])
				|| !array_key_exists('error', $GLOBALS['_xh']['value']) || !array_key_exists('id', $GLOBALS['_xh']['value']))
			{
				//$GLOBALS['_xh']['isf'] = 2;
				$GLOBALS['_xh']['isf_reason'] = 'JSON parsing did not return correct jsonrpc response object';
				return false;
			}
			if (!$return_phpvals)
			{
				$d_error = php_jsonrpc_decode($GLOBALS['_xh']['value']['error']);
				$GLOBALS['_xh']['value']['id'] = php_jsonrpc_decode($GLOBALS['_xh']['value']['id']);
			}
			else
			{
				$d_error = $GLOBALS['_xh']['value']['error'];
			}
			$GLOBALS['_xh']['id'] = $GLOBALS['_xh']['value']['id'];
			if ($d_error != null)
			{
				$GLOBALS['_xh']['isf'] = 1;

				//$GLOBALS['_xh']['value'] = $d_error;
				if (is_array($d_error) && array_key_exists('faultCode', $d_error)
					&& array_key_exists('faultString', $d_error))
				{
					if($d_error['faultCode'] == 0)
					{
						// FAULT returned, errno needs to reflect that
						$d_error['faultCode'] = -1;
					}
					$GLOBALS['_xh']['value'] = $d_error;
				}
				// NB: what about jsonrpc servers that do NOT respect
				// the faultCode/faultString convention???
				// we force the error into a string. regardless of type...
				else //if (is_string($GLOBALS['_xh']['value']))
				{
					if ($return_phpvals)
					{
						$GLOBALS['_xh']['value'] = array('faultCode' => -1, 'faultString' => var_export($GLOBALS['_xh']['value']['error'], true));
					}
					else
					{
						$GLOBALS['_xh']['value'] = array('faultCode' => -1, 'faultString' => serialize_jsonrpcval($GLOBALS['_xh']['value']['error']));
					}
				}

			}
			else
			{
				$GLOBALS['_xh']['value'] = $GLOBALS['_xh']['value']['result'];
			}
			return true;

		}
		else
		{
			return false;
		}
	}

	class jsonrpc_client extends xmlrpc_client
	{
		// by default, no multicall exists for JSON-RPC, so do not try it
		var $no_multicall = true;
		// default return type of calls to json-rpc servers: jsonrpcvals
		var $return_type = 'jsonrpcvals';

		/*
		function jsonrpc_client($path, $server='', $port='', $method='')
		{
			$this->xmlrpc_client($path, $server, $port, $method);
			// we need to override the list of std supported encodings, since
			// according to ECMA-262, the standard charset is UTF-16
			$this->accepted_charset_encodings = array('UTF-16', 'UTF-8', 'ISO-8859-1', 'US-ASCII');
		}
		*/
	}


	class jsonrpcmsg extends xmlrpcmsg
	{
		var $id = null; // used to store request ID internally
		var $content_type = 'application/json';

		/**
		* @param string $meth the name of the method to invoke
		* @param array $pars array of parameters to be paased to the method (xmlrpcval objects)
		* @param mixed $id the id of the jsonrpc request
		*/
		function jsonrpcmsg($meth, $pars=0, $id=null)
		{
			// NB: a NULL id is allowed and has a very definite meaning!
			$this->id = $id;
			$this->xmlrpcmsg($meth, $pars);
		}

		/**
		* @access private
		*/
		function createPayload($charset_encoding='')
		{
			if ($charset_encoding != '')
				$this->content_type = 'application/json; charset=' . $charset_encoding;
			else
				$this->content_type = 'application/json';
			// @ todo: verify if all chars are allowed for method names or can
			// we just skip the js encoding on it?
			$this->payload = "{\n\"method\": \"" . json_encode_entities($this->methodname, '', $charset_encoding) . "\",\n\"params\": [ ";
			for($i = 0; $i < sizeof($this->params); $i++)
			{
				$p = $this->params[$i];
				// MB: we try to force serialization as json even though the object
				// param might be a plain xmlrpcval object.
				// This way we do not need to override addParam, aren't we lazy?
				$this->payload .= "\n  " . serialize_jsonrpcval($p, $charset_encoding) .
				",";
			}
			$this->payload = substr($this->payload, 0, -1) . "\n],\n\"id\": ";
			switch (true)
			{
			  case $this->id === null:
			  	$this->payload .= 'null';
			  	break;
			  case is_string($this->id):
			  	$this->payload .= '"'.json_encode_entities($this->id, '', $charset_encoding).'"';
			  	break;
			  case is_bool($this->id):
			  	$this->payload .= ($this->id ? 'true' : 'false');
			  	break;
			  default:
				$this->payload .= $this->id;
			}
			$this->payload .= "\n}\n";
		}

		/**
		* Parse the jsonrpc response contained in the string $data and return a jsonrpcresp object.
		* @param string $data the xmlrpc response, eventually including http headers
		* @param bool $headers_processed when true prevents parsing HTTP headers for interpretation of content-encoding and conseuqent decoding
		* @param string $return_type decides return type, i.e. content of response->value(). Either 'xmlrpcvals', 'xml' or 'phpvals'
		* @return jsonrpcresp
		* @access private
		*/
		function &parseResponse($data='', $headers_processed=false, $return_type='jsonrpcvals')
		{
			if($this->debug)
			{
				print "<PRE>---GOT---\n" . htmlentities($data) . "\n---END---\n</PRE>";
			}

			if($data == '')
			{
				error_log('XML-RPC: '.__METHOD__.': no response received from server.');
				$r = new jsonrpcresp(0, $GLOBALS['xmlrpcerr']['no_data'], $GLOBALS['xmlrpcstr']['no_data']);
				return $r;
			}

			$GLOBALS['_xh']=array();

			$raw_data = $data;
			// parse the HTTP headers of the response, if present, and separate them from data
			if(substr($data, 0, 4) == 'HTTP')
			{
				$r =& $this->parseResponseHeaders($data, $headers_processed);
				if ($r)
				{
					// parent class implementation of parseResponseHeaders returns in case
					// of error an object of the wrong type: recode it into correct object
					$rj = new jsonrpcresp(0, $r->faultCode(), $r->faultString());
					$rj->raw_data = $data;
					return $rj;
				}
			}
			else
			{
				$GLOBALS['_xh']['headers'] = array();
				$GLOBALS['_xh']['cookies'] = array();
			}

			if($this->debug)
			{
				$start = strpos($data, '/* SERVER DEBUG INFO (BASE64 ENCODED):');
				if ($start !== false)
				{
					$start += strlen('/* SERVER DEBUG INFO (BASE64 ENCODED):');
					$end = strpos($data, '*/', $start);
					$comments = substr($data, $start, $end-$start);
					print "<PRE>---SERVER DEBUG INFO (DECODED) ---\n\t".htmlentities(str_replace("\n", "\n\t", base64_decode($comments)))."\n---END---\n</PRE>";
				}
			}

			// be tolerant of extra whitespace in response body
			$data = trim($data);

			// be tolerant of junk after methodResponse (e.g. javascript ads automatically inserted by free hosts)
			$end = strrpos($data, '}');
			if ($end)
			{
				$data = substr($data, 0, $end+1);
			}
			// if user wants back raw json, give it to him
			if ($return_type == 'json')
			{
				$r = new jsonrpcresp($data, 0, '', 'json');
				$r->hdrs = $GLOBALS['_xh']['headers'];
				$r->_cookies = $GLOBALS['_xh']['cookies'];
				$r->raw_data = $raw_data;
				return $r;
			}

			// @todo shall we try to check for non-unicode json received ???

			if (!jsonrpc_parse_resp($data, $return_type=='phpvals'))
			{
				if ($this->debug)
				{
					/// @todo echo something for user?
				}

				$r = new jsonrpcresp(0, $GLOBALS['xmlrpcerr']['invalid_return'],
					$GLOBALS['xmlrpcstr']['invalid_return'] . ' ' . $GLOBALS['_xh']['isf_reason']);
			}
			//elseif ($return_type == 'jsonrpcvals' && !is_object($GLOBALS['_xh']['value']))
			//{
				// then something odd has happened
				// and it's time to generate a client side error
				// indicating something odd went on
			//	$r =  new jsonrpcresp(0, $GLOBALS['xmlrpcerr']['invalid_return'],
			//		$GLOBALS['xmlrpcstr']['invalid_return']);
			//}
			else
			{
				$v = $GLOBALS['_xh']['value'];

				if ($this->debug)
				{
					print "<PRE>---PARSED---\n" ;
					var_export($v);
					print "\n---END---</PRE>";
				}

				if($GLOBALS['_xh']['isf'])
				{
					$r = new jsonrpcresp(0, $v['faultCode'], $v['faultString']);
				}
				else
				{
					$r = new jsonrpcresp($v, 0, '', $return_type);
				}
				$r->id = $GLOBALS['_xh']['id'];
			}

			$r->hdrs = $GLOBALS['_xh']['headers'];
			$r->_cookies = $GLOBALS['_xh']['cookies'];
			$r->raw_data = $raw_data;
			return $r;
		}
	}

	class jsonrpcresp extends xmlrpcresp
	{
		var $content_type = 'application/json'; // NB: forces us to send US-ASCII over http
		var $id = null;

		/// @todo override creator, to set proper valtyp and id!

		/**
		* Returns json representation of the response.
		* @param string $charset_encoding the charset to be used for serialization. if null, US-ASCII is assumed
		* @return string the json representation of the response
		* @access public
		*/
		function serialize($charset_encoding='')
		{
			if ($charset_encoding != '')
				$this->content_type = 'application/json; charset=' . $charset_encoding;
			else
				$this->content_type = 'application/json';
			$this->payload = serialize_jsonrpcresp($this, $this->id, $charset_encoding);
			return $this->payload;
		}

	}

	class jsonrpcval extends xmlrpcval
	{
		/**
		* Returns json representation of the value.
		* @param string $charset_encoding the charset to be used for serialization. if null, US-ASCII is assumed
		* @return string
		* @access public
		*/
		function serialize($charset_encoding='')
		{
			return serialize_jsonrpcval($this, $charset_encoding);
		}
	}

	/**
	* Takes a json value in PHP jsonrpcval object format
	* and translates it into native PHP types.
	*
	* @param jsonrpcval $jsonrpc_val
	* @param array $options if 'decode_php_objs' is set in the options array, jsonrpc objects can be decoded into php objects
	* @return mixed
	* @access public
	*/
	function php_jsonrpc_decode($jsonrpc_val, $options=array())
	{
		$kind = $jsonrpc_val->kindOf();

		if($kind == 'scalar')
		{
			return $jsonrpc_val->scalarval();
		}
		elseif($kind == 'array')
		{
			$size = $jsonrpc_val->arraysize();
			$arr = array();

			for($i = 0; $i < $size; $i++)
			{
				$arr[] = php_jsonrpc_decode($jsonrpc_val->arraymem($i), $options);
			}
			return $arr;
		}
		elseif($kind == 'struct')
		{
			$jsonrpc_val->structreset();
			// If user said so, try to rebuild php objects for specific struct vals.
			/// @todo should we raise a warning for class not found?
			// shall we check for proper subclass of xmlrpcval instead of
			// presence of _php_class to detect what we can do?
			if (in_array('decode_php_objs', $options))
			{
				if( $jsonrpc_val->_php_class != ''
					&& class_exists($jsonrpc_val->_php_class))
				{
					$obj = @new $jsonrpc_val->_php_class;
				}
				else
				{
					$obj = new stdClass();
				}
				while(list($key,$value) = $jsonrpc_val->structeach())
				{
					$obj->$key = php_jsonrpc_decode($value, $options);
				}
				return $obj;
			}
			else
			{
				$arr = array();
				while(list($key,$value) = $jsonrpc_val->structeach())
				{
					$arr[$key] = php_jsonrpc_decode($value, $options);
				}
				return $arr;
			}
		}
	}

	/**
	* Takes native php types and encodes them into jsonrpc PHP object format.
	* It will not re-encode jsonrpcval objects.
	*
	* @param mixed $php_val the value to be converted into a jsonrpcval object
	* @param array $options	can include 'encode_php_objs'
	* @return jsonrpcval
	* @access public
	*/
	function php_jsonrpc_encode($php_val, $options='')
	{
		$type = gettype($php_val);

		switch($type)
		{
			case 'string':
				$jsonrpc_val = new jsonrpcval($php_val, $GLOBALS['xmlrpcString']);
				break;
			case 'integer':
				$jsonrpc_val = new jsonrpcval($php_val, $GLOBALS['xmlrpcInt']);
				break;
			case 'double':
				$jsonrpc_val = new jsonrpcval($php_val, $GLOBALS['xmlrpcDouble']);
				break;
			case 'boolean':
				$jsonrpc_val = new jsonrpcval($php_val, $GLOBALS['xmlrpcBoolean']);
				break;
			case 'resource': // for compat with php json extension...
			case 'NULL':
				$jsonrpc_val = new jsonrpcval($php_val, $GLOBALS['xmlrpcNull']);
				break;
			case 'array':
				// PHP arrays can be encoded to either objects or arrays,
				// depending on wheter they are hashes or plain 0..n integer indexed
				// A shorter one-liner would be
				// $tmp = array_diff(array_keys($php_val), range(0, count($php_val)-1));
				// but execution time skyrockets!
				$j = 0;
				$arr = array();
				$ko = false;
				foreach($php_val as $key => $val)
				{
					$arr[$key] = php_jsonrpc_encode($val, $options);
					if(!$ko && $key !== $j)
					{
						$ko = true;
					}
					$j++;
				}
				if($ko)
				{
					$jsonrpc_val = new jsonrpcval($arr, $GLOBALS['xmlrpcStruct']);
				}
				else
				{
					$jsonrpc_val = new jsonrpcval($arr, $GLOBALS['xmlrpcArray']);
				}
				break;
			case 'object':
				if(is_a($php_val, 'jsonrpcval'))
				{
					$jsonrpc_val = $php_val;
				}
				else
				{
					$arr = array();
				    reset($php_val);
					while(list($k,$v) = each($php_val))
					{
						$arr[$k] = php_jsonrpc_encode($v, $options);
					}
					$jsonrpc_val = new jsonrpcval($arr, $GLOBALS['xmlrpcStruct']);
					if (in_array('encode_php_objs', $options))
					{
						// let's save original class name into xmlrpcval:
						// might be useful later on...
						$jsonrpc_val->_php_class = get_class($php_val);
					}
				}
				break;
			// catch "user function", "unknown type"
			default:
				$jsonrpc_val = new jsonrpcval();
				break;
			}
			return $jsonrpc_val;
	}

	/**
	* Convert the json representation of a jsonrpc method call, jsonrpc method response
	* or single json value into the appropriate object (a.k.a. deserialize).
	* Please note that there is no way to distinguish the serialized representation
	* of a single json val of type object which has the 3 appropriate members from
	* the serialization of a method call or method response.
	* In such a case, the function will return a jsonrpcresp or jsonrpcmsg
	* @param string $json_val
	* @param array $options
	* @return mixed false on error, or an instance of jsonrpcval, jsonrpcresp or jsonrpcmsg
	* @access public
	* @todo add options controlling character set encodings
	*/
	function php_jsonrpc_decode_json($json_val, $options=array())
	{
		$src_encoding = array_key_exists('src_encoding', $options) ? $options['src_encoding'] : $GLOBALS['xmlrpc_defencoding'];
		$dest_encoding = array_key_exists('dest_encoding', $options) ? $options['dest_encoding'] : $GLOBALS['xmlrpc_internalencoding'];

		//$GLOBALS['_xh'] = array();
		$GLOBALS['_xh']['isf'] = 0;
		if (!json_parse($json_val, false, $src_encoding, $dest_encoding))
		{
			error_log($GLOBALS['_xh']['isf_reason']);
			return false;
		}
		else
		{
			$val = $GLOBALS['_xh']['value']; // shortcut
			if ($GLOBALS['_xh']['value']->kindOf() == 'struct')
			{
				if ($GLOBALS['_xh']['value']->structSize() == 3)
				{
					if ($GLOBALS['_xh']['value']->structMemExists('method') &&
						$GLOBALS['_xh']['value']->structMemExists('params') &&
						$GLOBALS['_xh']['value']->structMemExists('id'))
					{
						/// @todo we do not check for correct type of 'method', 'params' struct members...
						$method = $GLOBALS['_xh']['value']->structMem('method');
						$msg = new jsonrpcmsg($method->scalarval(), null, php_jsonrpc_decode($GLOBALS['_xh']['value']->structMem('id')));
						$params = $GLOBALS['_xh']['value']->structMem('params');
						for($i = 0; $i < $params->arraySize(); ++$i)
						{
						 	$msg->addparam($params->arrayMem($i));
						}
						return $msg;
					}
					else
					if ($GLOBALS['_xh']['value']->structMemExists('result') &&
						$GLOBALS['_xh']['value']->structMemExists('error') &&
						$GLOBALS['_xh']['value']->structMemExists('id'))
					{
						$id = php_jsonrpc_decode($GLOBALS['_xh']['value']->structMem('id'));
						$err = php_jsonrpc_decode($GLOBALS['_xh']['value']->structMem('error'));
						if ($err == null)
						{
							$resp = new jsonrpcresp($GLOBALS['_xh']['value']->structMem('result'));
						}
						else
						{
							if (is_array($err) && array_key_exists('faultCode', $err)
								&& array_key_exists('faultString', $err))
							{
								if($err['faultCode'] == 0)
								{
									// FAULT returned, errno needs to reflect that
									$err['faultCode'] = -1;
								}
							}
							// NB: what about jsonrpc servers that do NOT respect
							// the faultCode/faultString convention???
							// we force the error into a string. regardless of type...
							else //if (is_string($GLOBALS['_xh']['value']))
							{
								$err = array('faultCode' => -1, 'faultString' => serialize_jsonrpcval($GLOBALS['_xh']['value']->structMem('error')));
							}
							$resp = new jsonrpcresp(0, $err['faultCode'], $err['faultString']);
						}
						$resp->id = $id;
						return $resp;
					}
				}
			}
			// not a request msg nor a response: a plain jsonrpcval obj
			return $GLOBALS['_xh']['value'];
		}
	}

	/**
	* Serialize a jsonrpcresp (or xmlrpcresp) as json.
	* Moved outside of the corresponding class to ease multi-serialization of
	* xmlrpcresp objects
	* @param xmlrpcresp or jsonrpcresp $resp
	* @param mixed $id
	* @return string
	* @access private
	*/
	function serialize_jsonrpcresp($resp, $id=null, $charset_encoding='')
	{
		$result = "{\n\"id\": ";
		switch (true)
		{
		  case $id === null:
		  	$result .= 'null';
		  	break;
		  case is_string($id):
		  	$result .= '"'.json_encode_entities($id, '', $charset_encoding).'"';
		  	break;
		  case is_bool($id):
		  	$result .= ($id ? 'true' : 'false');
		  	break;
		  default:
			$result .= $id;
		}
		$result .= ", ";
		if($resp->errno)
		{
			// let non-ASCII response messages be tolerated by clients
			// by encoding non ascii chars
			$result .= "\"error\": { \"faultCode\": " . $resp->errno . ", \"faultString\": \"" . json_encode_entities($resp->errstr, null, $charset_encoding) . "\" }, \"result\": null";
		}
		else
		{
			if(!is_object($resp->val) || !is_a($resp->val, 'xmlrpcval'))
			{
				if (is_string($resp->val) && $resp->valtyp == 'json')
				{
					$result .= "\"error\": null, \"result\": " . $resp->val;
				}
				else
				{
					/// @todo try to build something serializable?
					die('cannot serialize jsonrpcresp objects whose content is native php values');
				}
			}
			else
			{
				$result .= "\"error\": null, \"result\": " .
					serialize_jsonrpcval($resp->val, $charset_encoding);
			}
		}
		$result .= "\n}";
		return $result;
	}

	/**
	* Serialize a jsonrpcval (or xmlrpcval) as json.
	* Moved outside of the corresponding class to ease multi-serialization of
	* xmlrpcval objects
	* @param xmlrpcval or jsonrpcval $value
	* @string $charset_encoding
	* @access private
	*/
	function serialize_jsonrpcval($value, $charset_encoding='')
	{
		reset($value->me);
		list($typ, $val) = each($value->me);

		$rs = '';
		switch(@$GLOBALS['xmlrpcTypes'][$typ])
		{
			case 1:
				switch($typ)
				{
					case $GLOBALS['xmlrpcString']:
						$rs .= '"' . json_encode_entities($val, null, $charset_encoding). '"';
						break;
					case $GLOBALS['xmlrpcI4']:
					case $GLOBALS['xmlrpcInt']:
						$rs .= (int)$val;
						break;
					case $GLOBALS['xmlrpcDateTime']:
						// quote date as a json string.
						// assumes date format is valid and will not break js...
						$rs .=  '"' . $val . '"';
						break;
					case $GLOBALS['xmlrpcDouble']:
						// add a .0 in case value is integer.
						// This helps us carrying around floats in js, and keep them separated from ints
						$sval = strval((double)$val); // convert to string
						// fix usage of comma, in case of eg. german locale
						$sval = str_replace(',', '.', $sval);
						if (strpos($sval, '.') !== false || strpos($sval, 'e') !== false)
						{
							$rs .= $sval;
						}
						else
						{
							$rs .= $val.'.0';
						}
						break;
					case $GLOBALS['xmlrpcBoolean']:
						$rs .= ($val ? 'true' : 'false');
						break;
					case $GLOBALS['xmlrpcBase64']:
						// treat base 64 values as strings ???
						$rs .= '"' . base64_encode($val) . '"';
						break;
					default:
						$rs .= "null";
				}
				break;
			case 2:
				// array
				$rs .= "[";
				$len = sizeof($val);
				if ($len)
				{
					for($i = 0; $i < $len; $i++)
					{
						$rs .= serialize_jsonrpcval($val[$i], $charset_encoding);
						$rs .= ",";
					}
					$rs = substr($rs, 0, -1) . "]";
				}
				else
				{
					$rs .= "]";
				}
				break;
			case 3:
				// struct
				//if ($value->_php_class)
				//{
					/// @todo implement json-rpc extension for object serialization
					//$rs.='<struct php_class="' . $this->_php_class . "\">\n";
				//}
				//else
				//{
				//}
				foreach($val as $key2 => $val2)
				{
					$rs .= ',"'.json_encode_entities($key2, null, $charset_encoding).'":';
					$rs .= serialize_jsonrpcval($val2, $charset_encoding);
				}
				$rs = '{' . substr($rs, 1) . '}';
				break;
			case 0:
				// let uninitialized jsonrpcval objects serialize to an empty string, as they do in xmlrpc land
				$rs = '""';
				break;
			default:
				break;
		}
		return $rs;
	}

	/**
	* Given a string defining a php type or phpxmlrpc type (loosely defined: strings
	* accepted come from javadoc blocks), return corresponding phpxmlrpc type.
	* NB: for php 'resource' types returns empty string, since resources cannot be serialized;
	* for php class names returns 'struct', since php objects can be serialized as json structs;
	* for php arrays always retutn 'array', even though arrays sometiles serialize as json structs
	* @param string $phptype
	* @return string
	*/
    function php_2_jsonrpc_type($phptype)
    {
        switch(strtolower($phptype))
        {
            case 'string':
                return $GLOBALS['xmlrpcString'];
            case 'integer':
            case $GLOBALS['xmlrpcInt']: // 'int'
            case $GLOBALS['xmlrpcI4']:
                return $GLOBALS['xmlrpcInt'];
            case 'double':
                return $GLOBALS['xmlrpcDouble'];
            case 'boolean':
                return $GLOBALS['xmlrpcBoolean'];
            case 'array':
                return $GLOBALS['xmlrpcArray'];
            case 'object':
                return $GLOBALS['xmlrpcStruct'];
            //case $GLOBALS['xmlrpcBase64']:
            case $GLOBALS['xmlrpcStruct']:
                return strtolower($phptype);
            case 'resource':
                return '';
            default:
                if(class_exists($phptype))
                {
                    return $GLOBALS['xmlrpcStruct'];
                }
                else
                {
                    // unknown: might be any 'extended' jsonrpc type
                    return $GLOBALS['xmlrpcValue'];
                }
            }
	}


/**
 * Bitcoin classes
 *
 * By Mike Gogulski - All rights reversed http://www.unlicense.org/ (public domain)
 *
 * If you find this library useful, your donation of Bitcoins to address
 * 1E3d6EWLgwisXY2CWXDcdQQP2ivRN7e9r9 would be greatly appreciated. Thanks!
 *
 * PHPDoc is available at http://code.gogulski.com/
 *
 * @author Mike Gogulski - http://www.nostate.com/ http://www.gogulski.com/
 * @author theymos - theymos @ http://bitcoin.org/smf
 *
 * @author zamgo - Modified for use with Bitcoin Webskin
 *
 */




define("BITCOIN_ADDRESS_VERSION", "00");// this is a hex byte
/**
 * Bitcoin utility functions class
 *
 * @author theymos (functionality)
 * @author Mike Gogulski
 * 	http://www.gogulski.com/ http://www.nostate.com/
 *  (encapsulation, string abstraction, PHPDoc)
 */
class BitcoinPHP {

  /*
   * Bitcoin utility functions by theymos
   * Via http://www.bitcoin.org/smf/index.php?topic=1844.0
   * hex input must be in uppercase, with no leading 0x
   */
  private static $hexchars = "0123456789ABCDEF";
  private static $base58chars = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";

  /**
   * Convert a hex string into a (big) integer
   *
   * @param string $hex
   * @return int
   * @access private
   */
  private function decodeHex($hex) {
    $hex = strtoupper($hex);
    $return = "0";
    for ($i = 0; $i < strlen($hex); $i++) {
      $current = (string) strpos(self::$hexchars, $hex[$i]);
      $return = (string) bcmul($return, "16", 0);
      $return = (string) bcadd($return, $current, 0);
    }
    return $return;
  }

  /**
   * Convert an integer into a hex string
   *
   * @param int $dec
   * @return string
   * @access private
   */
  private function encodeHex($dec) {
    $return = "";
    while (bccomp($dec, 0) == 1) {
      $dv = (string) bcdiv($dec, "16", 0);
      $rem = (integer) bcmod($dec, "16");
      $dec = $dv;
      $return = $return . self::$hexchars[$rem];
    }
    return strrev($return);
  }

  /**
   * Convert a Base58-encoded integer into the equivalent hex string representation
   *
   * @param string $base58
   * @return string
   * @access private
   */
  private function decodeBase58($base58) {
    $origbase58 = $base58;

    $return = "0";
    for ($i = 0; $i < strlen($base58); $i++) {
      $current = (string) strpos(Bitcoin::$base58chars, $base58[$i]);
      $return = (string) bcmul($return, "58", 0);
      $return = (string) bcadd($return, $current, 0);
    }

    $return = self::encodeHex($return);

    //leading zeros
    for ($i = 0; $i < strlen($origbase58) && $origbase58[$i] == "1"; $i++) {
      $return = "00" . $return;
    }

    if (strlen($return) % 2 != 0) {
      $return = "0" . $return;
    }

    return $return;
  }

  /**
   * Convert a hex string representation of an integer into the equivalent Base58 representation
   *
   * @param string $hex
   * @return string
   * @access private
   */
  private function encodeBase58($hex) {
    if (strlen($hex) % 2 != 0) {
      die("encodeBase58: uneven number of hex characters");
    }
    $orighex = $hex;

    $hex = self::decodeHex($hex);
    $return = "";
    while (bccomp($hex, 0) == 1) {
      $dv = (string) bcdiv($hex, "58", 0);
      $rem = (integer) bcmod($hex, "58");
      $hex = $dv;
      $return = $return . self::$base58chars[$rem];
    }
    $return = strrev($return);

    //leading zeros
    for ($i = 0; $i < strlen($orighex) && substr($orighex, $i, 2) == "00"; $i += 2) {
      $return = "1" . $return;
    }

    return $return;
  }

  /**
   * Convert a 160-bit Bitcoin hash to a Bitcoin address
   *
   * @author theymos
   * @param string $hash160
   * @param string $addressversion
   * @return string Bitcoin address
   * @access public
   */
  public static function hash160ToAddress($hash160, $addressversion = BITCOIN_ADDRESS_VERSION) {
    $hash160 = $addressversion . $hash160;
    $check = pack("H*", $hash160);
    $check = hash("sha256", hash("sha256", $check, true));
    $check = substr($check, 0, 8);
    $hash160 = strtoupper($hash160 . $check);
    return self::encodeBase58($hash160);
  }

  /**
   * Convert a Bitcoin address to a 160-bit Bitcoin hash
   *
   * @author theymos
   * @param string $addr
   * @return string Bitcoin hash
   * @access public
   */
  public static function addressToHash160($addr) {
    $addr = self::decodeBase58($addr);
    $addr = substr($addr, 2, strlen($addr) - 10);
    return $addr;
  }

  /**
   * Determine if a string is a valid Bitcoin address
   *
   * @author theymos
   * @param string $addr String to test
   * @param string $addressversion
   * @return boolean
   * @access public
   */
  public static function checkAddress($addr, $addressversion = BITCOIN_ADDRESS_VERSION) {
    $addr = self::decodeBase58($addr);
    if (strlen($addr) != 50) {
      return false;
    }
    $version = substr($addr, 0, 2);
    if (hexdec($version) > hexdec($addressversion)) {
      return false;
    }
    $check = substr($addr, 0, strlen($addr) - 8);
    $check = pack("H*", $check);
    $check = strtoupper(hash("sha256", hash("sha256", $check, true)));
    $check = substr($check, 0, 8);
    return $check == substr($addr, strlen($addr) - 8);
  }

  /**
   * Convert the input to its 160-bit Bitcoin hash
   *
   * @param string $data
   * @return string
   * @access private
   */
  private function hash160($data) {
    $data = pack("H*", $data);
    return strtoupper(hash("ripemd160", hash("sha256", $data, true)));
  }

  /**
   * Convert a Bitcoin public key to a 160-bit Bitcoin hash
   *
   * @param string $pubkey
   * @return string
   * @access public
   */
  public static function pubKeyToAddress($pubkey) {
    return self::hash160ToAddress($this->hash160($pubkey));
  }

  /**
   * Remove leading "0x" from a hex value if present.
   *
   * @param string $string
   * @return string
   * @access public
   */
  public static function remove0x($string) {
    if (substr($string, 0, 2) == "0x" || substr($string, 0, 2) == "0X") {
      $string = substr($string, 2);
    }
    return $string;
  }
}

/**
 * Exception class for BitcoinClient
 *
 * @author Mike Gogulski
 * 	http://www.gogulski.com/ http://www.nostate.com/
 */
class BitcoinClientException extends ErrorException {
  // Redefine the exception so message isn't optional
  public function __construct($message, $code = 0, $severity = E_USER_NOTICE, Exception $previous = null) {
    parent::__construct($message, $code, $severity, $previous);
  }

  public function __toString() {
    return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
  }
}


/**
 * Bitcoin client class for access to a Bitcoin server via JSON-RPC-HTTP[S]
 *
 * Implements the methods documented at https://www.bitcoin.org/wiki/doku.php?id=api
 *
 * @version 0.3.19
 * @author Mike Gogulski
 * 	http://www.gogulski.com/ http://www.nostate.com/
 */
class BitcoinClient extends jsonrpc_client {

  /**
   * Create a jsonrpc_client object to talk to the bitcoin server and return it,
   * or false on failure.
   *
   * @param string $scheme
   * 	"http" or "https"
   * @param string $username
   * 	User name to use in connection the Bitcoin server's JSON-RPC interface
   * @param string $password
   * 	Server password
   * @param string $address
   * 	Server hostname or IP address
   * @param mixed $port
   * 	Server port (string or integer)
   * @param string $certificate_path
   * 	Path on the local filesystem to server's PEM certificate (ignored if $scheme != "https")
   * @param integer $debug_level
   * 	0 (default) = no debugging;
   * 	1 = echo JSON-RPC messages received to stdout;
   * 	2 = log transmitted messages also
   * @return jsonrpc_client
   * @access public
   * @throws BitcoinClientException
   */
  public function __construct($scheme, $username, $password, $address = "localhost", $port = 8332, $certificate_path = '', $debug_level = 0) {
    $scheme = strtolower($scheme);
    if ($scheme != "http" && $scheme != "https")
      throw new BitcoinClientException("Scheme must be http or https");
    if (empty($username))
      throw new BitcoinClientException("Username must be non-blank");
    if (empty($password))
      throw new BitcoinClientException("Password must be non-blank");
    $port = (string) $port;
    if (!$port || empty($port) || !is_numeric($port) || $port < 1 || $port > 65535 || floatval($port) != intval($port))
      throw new BitcoinClientException("Port must be an integer and between 1 and 65535");
    if (!empty($certificate_path) && !is_readable($certificate_path))
      throw new BitcoinClientException("Certificate file " . $certificate_path . " is not readable");
    $uri = $scheme . "://" . $username . ":" . $password . "@" . $address . ":" . $port . "/";
    parent::__construct($uri);
    $this->setDebug($debug_level);
    $this->setSSLVerifyHost(0);
    if ($scheme == "https")
      if (!empty($certificate_path))
        $this->setCaCertificate($certificate_path);
      else
        $this->setSSLVerifyPeer(false);
  }

  /**
   * Test if the connection to the Bitcoin JSON-RPC server is working
   *
   * The check is done by calling the server's getinfo() method and checking
   * for a fault.
   *
   * @return mixed boolean TRUE if successful, or a fault string otherwise
   * @access public
   * @throws none
   */
  public function can_connect() {
    try {
      $r = $this->getinfo();
    } catch (BitcoinClientException $e) {
      return $e->getMessage();
    }
    return true;
  }

  /**
   * Convert a Bitcoin server query argument to a jsonrpcval
   *
   * @param mixed $argument
   * @return jsonrpcval
   * @throws none
   * @todo Make this method private.
   */
  public function query_arg_to_parameter($argument) {
    $type = "";// "string" is encoded as this default type value in xmlrpc.inc
    if (is_numeric($argument)) {
      if (intval($argument) != floatval($argument)) {
        $argument = floatval($argument);
        $type = "double";
      } else {
        $argument = intval($argument);
        $type = "int";
      }
    }
    if (is_bool($argument))
      $type = "boolean";
    if (is_int($argument))
      $type = "int";
    if (is_float($argument))
      $type = "double";
    if (is_array($argument))
      $type = "array";
    return new jsonrpcval($argument, $type);
  }

  /**
   * Send a JSON-RPC message and optional parameter arguments to the server.
   *
   * Use the API functions if possible. This method remains public to support
   * changes being made to the API before this libarary can be updated.
   *
   * @param string $message
   * @param mixed $args, ...
   * @return mixed
   * @throws BitcoinClientException
   * @see xmlrpc.inc:php_xmlrpc_decode()
   */
  public function query($message) {
    if (!$message || empty($message))
      throw new BitcoinClientException("Bitcoin client query requires a message");
    $msg = new jsonrpcmsg($message);
    if (func_num_args() > 1) {
      for ($i = 1; $i < func_num_args(); $i++) {
        $msg->addParam(self::query_arg_to_parameter(func_get_arg($i)));
      }
    }
    $response = $this->send($msg);
    if ($response->faultCode()) {
      throw new BitcoinClientException($response->faultString());
    }
    return php_xmlrpc_decode($response->value());
  }

  /*
   * The following functions implement the Bitcoin RPC API as documented at https://www.bitcoin.org/wiki/doku.php?id=api
   */

  /**
   * Safely copies wallet.dat to destination, which can be a directory or
   * a path with filename.
   *
   * @param string $destination
   * @return mixed Nothing, or an error array
   * @throws BitcoinClientException
   */
  public function backupwallet($destination) {
    if (!$destination || empty($destination))
      throw new BitcoinClientException("backupwallet requires a destination");
    return $this->query("backupwallet", $destination);
  }

  /**
   * Returns the server's available balance, or the balance for $account with
   * at least $minconf confirmations.
   *
   * @param string $account Account to check. If not provided, the server's
   *  total available balance is returned.
   * @param integer $minconf If specified, only transactions with at least
   *  $minconf confirmations will be included in the returned total.
   * @return float Bitcoin balance
   * @throws BitcoinClientException
   */
  public function getbalance($account = NULL, $minconf = 1) {
    if (!is_numeric($minconf) || $minconf < 0)
      throw new BitcoinClientException('getbalance requires a numeric minconf >= 0');
    if ($account == NULL)
      return $this->query("getbalance");
    return $this->query("getbalance", $account, $minconf);
  }

  /**
   * Returns the number of blocks in the longest block chain.
   *
   * @return integer Current block count
   * @throws BitcoinClientException
   */
  public function getblockcount() {
    return $this->query("getblockcount");
  }

  /**
   * Returns the block number of the latest block in the longest block chain.
   *
   * @return integer Block number
   * @throws BitcoinClientException
   */
  public function getblocknumber() {
    return $this->query("getblocknumber");
  }

  /**
   * Returns the number of connections to other nodes.
   *
   * @return integer Connection count
   * @throws BitcoinClientException
   */
  public function getconnectioncount() {
    return $this->query("getconnectioncount");
  }

  /**
   * Returns the proof-of-work difficulty as a multiple of the minimum difficulty.
   *
   * @return float Difficulty
   * @throws BitcoinClientException
   */
  public function getdifficulty() {
    return $this->query("getdifficulty");
  }

  /**
   * Returns boolean true if server is trying to generate bitcoins, false otherwise.
   *
   * @return boolean Generation status
   * @throws BitcoinClientException
   */
  public function getgenerate() {
    return $this->query("getgenerate");
  }

  /**
   * Tell Bitcoin server to generate Bitcoins or not, and how many processors
   * to use.
   *
   * @param boolean $generate
   * @param integer $maxproc
   * 	Limit generation to $maxproc processors, unlimited if -1
   * @return mixed Nothing if successful, error array if not
   * @throws BitcoinClientException
   */
  public function setgenerate($generate = TRUE, $maxproc = -1) {
    if (!is_numeric($maxproc) || $maxproc < -1)
      throw new BitcoinClientException('setgenerate: $maxproc must be numeric and >= -1');
    return $this->query("setgenerate", $generate, $maxproc);
  }

  /**
   * Returns an array containing server information.
   *
   * @return array Server information
   * @throws BitcoinClientException
   */
  public function getinfo() {
    return $this->query("getinfo");
  }

  /**
   * Returns the account associated with the given address.
   *
   * @param string $address
   * @return string Account
   * @throws BitcoinClientException
   * @since 0.3.17
   */
  public function getaccount($address) {
    if (!$address || empty($address))
      throw new BitcoinClientException("getaccount requires an address");
    return $this->query("getaccount", $address);
  }

  /**
   * Returns the label associated with the given address.
   *
   * @param string $address
   * @return string Label
   * @throws BitcoinClientException
   * @deprecated Since 0.3.17
   */
  public function getlabel($address) {
    if (!$address || empty($address))
      throw new BitcoinClientException("getlabel requires an address");
    return $this->query("getlabel", $address);
  }

  /**
   * Sets the account associated with the given address.
   * $account may be omitted to remove an account from an address.
   *
   * @param string $address
   * @param string $account
   * @return NULL
   * @throws BitcoinClientException
   * @since 0.3.17
   */
  public function setaccount($address, $account = "") {
    if (!$address || empty($address))
      throw new BitcoinClientException("setaccount requires an address");
    return $this->query("setaccount", $address, $account);
  }

  /**
   * Sets the label associated with the given address.
   * $label may be omitted to remove a label from an address.
   *
   * @param string $address
   * @param string $label
   * @return NULL
   * @throws BitcoinClientException
   * @deprecated Since 0.3.17
   */
  public function setlabel($address, $label = "") {
    if (!$address || empty($address))
      throw new BitcoinClientException("setlabel requires an address");
    return $this->query("setlabel", $address, $label);
  }

  /**
   * Returns a new bitcoin address for receiving payments.
   *
   * If $account is specified (recommended), it is added to the address book so
   * payments received with the address will be credited to $account.
   *
   * @param string $account Label to apply to the new address
   * @return string Bitcoin address
   * @throws BitcoinClientException
   */
  public function getnewaddress($account = NULL) {
    if (!$account || empty($account))
      return $this->query("getnewaddress");
    return $this->query("getnewaddress", $account);
  }

  /**
   * Returns the total amount received by $address in transactions with at least
   * $minconf confirmations.
   *
   * @param string $address
   * 	Bitcoin address
   * @param integer $minconf
   * 	Minimum number of confirmations for transactions to be counted
   * @return float Bitcoin total
   * @throws BitcoinClientException
   */
  public function getreceivedbyaddress($address, $minconf = 1) {
    if (!is_numeric($minconf) || $minconf < 0)
      throw new BitcoinClientException('getreceivedbyaddress requires a numeric minconf >= 0');
    if (!$address || empty($address))
      throw new BitcoinClientException("getreceivedbyaddress requires an address");
    return $this->query("getreceivedbyaddress", $address, $minconf);
  }

  /**
   * Returns the total amount received by addresses associated with $account
   * in transactions with at least $minconf confirmations.
   *
   * @param string $account
   * @param integer $minconf
   * 	Minimum number of confirmations for transactions to be counted
   * @return float Bitcoin total
   * @throws BitcoinClientException
   * @since 0.3.17
   */
  public function getreceivedbyaccount($account, $minconf = 1) {
    if (!is_numeric($minconf) || $minconf < 0)
      throw new BitcoinClientException('getreceivedbyaccount requires a numeric minconf >= 0');
    if (!$account || empty($account))
      throw new BitcoinClientException("getreceivedbyaccount requires an account");
    return $this->query("getreceivedbyaccount", $account, $minconf);
  }

  /**
   * Returns the total amount received by addresses with $label in
   * transactions with at least $minconf confirmations.
   *
   * @param string $label
   * @param integer $minconf
   * 	Minimum number of confirmations for transactions to be counted
   * @return float Bitcoin total
   * @throws BitcoinClientException
   * @deprecated Since 0.3.17
   */
  public function getreceivedbylabel($label, $minconf = 1) {
    if (!is_numeric($minconf) || $minconf < 0)
      throw new BitcoinClientException('getreceivedbylabel requires a numeric minconf >= 0');
    if (!$label || empty($label))
      throw new BitcoinClientException("getreceivedbylabel requires a label");
    return $this->query("getreceivedbylabel", $label, $minconf);
  }

  /**
   * Return a list of server RPC commands or help for $command, if specified.
   *
   * @param string $command
   * @return string Help text
   * @throws BitcoinClientException
   */
  public function help($command = NULL) {
    if (!$command || empty($command))
      return $this->query("help");
    return $this->query("help", $command);
  }

  /**
   * Return an array of arrays showing how many Bitcoins have been received by
   * each address in the server's wallet.
   *
   * @param integer $minconf Minimum number of confirmations before payments are included.
   * @param boolean $includeempty Whether to include addresses that haven't received any payments.
   * @return array An array of arrays. The elements are:
   * 	"address" => receiving address
   * 	"account" => the account of the receiving address
   * 	"amount" => total amount received by the address
   * 	"confirmations" => number of confirmations of the most recent transaction included
   * @throws BitcoinClientException
   */
  public function listreceivedbyaddress($minconf = 1, $includeempty = FALSE) {
    if (!is_numeric($minconf) || $minconf < 0)
      throw new BitcoinClientException('listreceivedbyaddress requires a numeric minconf >= 0');
    return $this->query("listreceivedbyaddress", $minconf, $includeempty);
  }

  /**
   * Return an array of arrays showing how many Bitcoins have been received by
   * each account in the server's wallet.
   *
   * @param integer $minconf
   * 	Minimum number of confirmations before payments are included.
   * @param boolean $includeempty
   * 	Whether to include addresses that haven't received any payments.
   * @return array An array of arrays. The elements are:
   * 	"account" => the label of the receiving address
   * 	"amount" => total amount received by the address
   * 	"confirmations" => number of confirmations of the most recent transaction included
   * @throws BitcoinClientException
   * @since 0.3.17
   */
  public function listreceivedbyaccount($minconf = 1, $includeempty = FALSE) {
    if (!is_numeric($minconf) || $minconf < 0)
      throw new BitcoinClientException('listreceivedbyaccount requires a numeric minconf >= 0');
    return $this->query("listreceivedbyaccount", $minconf, $includeempty);
  }

  /**
   * Return an array of arrays showing how many Bitcoins have been received by
   * each label in the server's wallet.
   *
   * @param integer $minconf Minimum number of confirmations before payments are included.
   * @param boolean $includeempty Whether to include addresses that haven't received any payments.
   * @return array An array of arrays. The elements are:
   * 	"label" => the label of the receiving address
   * 	"amount" => total amount received by the address
   * 	"confirmations" => number of confirmations of the most recent transaction included
   * @throws BitcoinClientException
   * @deprecated Since 0.3.17
   */
  public function listreceivedbylabel($minconf = 1, $includeempty = FALSE) {
    if (!is_numeric($minconf) || $minconf < 0)
      throw new BitcoinClientException('listreceivedbylabel requires a numeric minconf >= 0');
    return $this->query("listreceivedbylabel", $minconf, $includeempty);
  }

  /**
   * Send amount from the server's available balance.
   *
   * $amount is a real and is rounded to the nearest 0.01. Returns string "sent" on success.
   *
   * @param string $address Destination Bitcoin address or IP address
   * @param float $amount Amount to send. Will be rounded to the nearest 0.01.
   * @param string $comment
   * @param string $comment_to
   * @return string Hexadecimal transaction ID on success.
   * @throws BitcoinClientException
   * @todo Document the comment arguments better.
   */
  public function sendtoaddress($address, $amount, $comment = NULL, $comment_to = NULL) {
    if (!$address || empty($address))
      throw new BitcoinClientException("sendtoaddress requires a destination address");
    if (!$amount || empty($amount))
      throw new BitcoinClientException("sendtoaddress requires an amount to send");
    if (!is_numeric($amount) || $amount <= 0)
      throw new BitcoinClientException("sendtoaddress requires the amount sent to be a number > 0");
    $amount = floatval($amount);
    if (!$comment && !$comment_to)
      return $this->query("sendtoaddress", $address, $amount);
    if (!$comment_to)
      return $this->query("sendtoaddress", $address, $amount, $comment);
    return $this->query("sendtoaddress", $address, $amount, $comment, $comment_to);
  }

  /**
   * Stop the Bitcoin server.
   *
   * @throws BitcoinClientException
   */
  public function stop() {
    return $this->query("stop");
  }

  /**
   * Check that $address looks like a proper Bitcoin address.
   *
   * @param string $address String to test for validity as a Bitcoin address
   * @return array An array containing:
   * 	"isvalid" => true or false
   * 	"ismine" => true if the address is in the server's wallet
   * 	"address" => bitcoinaddress
   *  Note: ismine and address are only returned if the address is valid.
   * @throws BitcoinClientException
   */
  public function validateaddress($address) {
    if (!$address || empty($address))
      throw new BitcoinClientException("validateaddress requires a Bitcoin address");
    return $this->query("validateaddress", $address);
  }

  /**
   * Return information about a specific transaction.
   *
   * @param string $txid 64-digit hexadecimal transaction ID
   * @return array An error array, or an array containing:
   *    "amount" => float Transaction amount
   *    "fee" => float Transaction fee
   *    "confirmations" => integer Network confirmations of this transaction
   *    "txid" => string The transaction ID
   *    "message" => string Transaction "comment" message
   *    "to" => string Transaction "to" message
   * @throws BitcoinClientException
   * @since 0.3.18
   */
  public function gettransaction($txid) {
    if (!$txid || empty($txid) || strlen($txid) != 64 || !preg_match('/^[0-9a-fA-F]+$/', $txid))
      throw new BitcoinClientException("gettransaction requires a valid hexadecimal transaction ID");
    return $this->query("getttransaction", $txid);
  }

  /**
   * Move bitcoins between accounts.
   *
   * @param string $fromaccount
   *    Account to move from. If given as an empty string ("") or NULL, bitcoins will
   *    be moved from the wallet balance to the target account.
   * @param string $toaccount
   *     Account to move to
   * @param float $amount
   *     Amount to move
   * @param integer $minconf
   *     Minimum number of confirmations on bitcoins being moved
   * @param string $comment
   *     Transaction comment
   * @throws BitcoinClientException
   * @since 0.3.18
   */
  public function move($fromaccount = "", $toaccount, $amount, $minconf = 1, $comment = NULL) {
    if (!$fromaccount)
      $fromaccount = "";
    if (!$toaccount || empty($toaccount) || !$amount || !is_numeric($amount) || $amount <= 0)
      throw new BitcoinClientException("move requires a from account, to account and numeric amount > 0");
    if (!is_numeric($minconf) || $minconf < 0)
      throw new BitcoinClientException('move requires a numeric $minconf >= 0');
    if (!$comment || empty($comment))
      return $this->query("move", $fromaccount, $toaccount, $amount, $minconf);
    return $this->query("move", $fromaccount, $toaccount, $amount, $minconf, $comment);
  }

  /**
   * Send $amount from $account's balance to $toaddress. This method will fail
   * if there is less than $amount bitcoins with $minconf confirmations in the
   * account's balance (unless $account is the empty-string-named default
   * account; it behaves like the sendtoaddress method). Returns transaction
   * ID on success.
   *
   * @param string $account Account to send from
   * @param string $toaddress Bitcoin address to send to
   * @param float $amount Amount to send
   * @param integer $minconf Minimum number of confirmations on bitcoins being sent
   * @param string $comment
   * @param string $comment_to
   * @return string Hexadecimal transaction ID
   * @throws BitcoinClientException
   * @since 0.3.18
   */
  public function sendfrom($account, $toaddress, $amount, $minconf = 1, $comment = NULL, $comment_to = NULL) {
    if (!$account || !$toaddress || empty($toaddress) || !$amount || !is_numeric($amount) || $amount <= 0)
      throw new BitcoinClientException("sendfrom requires a from account, to account and numeric amount > 0");
    if (!is_numeric($minconf) || $minconf < 0)
      throw new BitcoinClientException('sendfrom requires a numeric $minconf >= 0');
    if (!$comment && !$comment_to)
      return $this->query("sendfrom", $account, $toaddress, $amount, $minconf);
    if (!$comment_to)
      return $this->query("sendfrom", $account, $toaddress, $amount, $minconf, $comment);
    $this->query("sendfrom", $account, $toaddress, $amount, $minconf, $comment, $comment_to);
  }

  /**
   * Return formatted hash data to work on, or try to solve specified block.
   *
   * If $data is provided, tries to solve the block and returns true if successful.
   * If $data is not provided, returns formatted hash data to work on.
   *
   * @param string $data Block data
   * @return mixed
   *    boolean TRUE if $data provided and block solving successful
   *    array otherwise, containing:
   *      "midstate" => string, precomputed hash state after hashing the first half of the data
   *      "data" => string, block data
   *      "hash1" => string, formatted hash buffer for second hash
   *      "target" => string, little endian hash target
   * @throws BitcoinClientException
   * @since 0.3.18
   */
  public function getwork($data = NULL) {
    if (!$data)
      return $this->query("getwork");
    return $this->query("getwork", $data);
  }

  /**
   * Return the current bitcoin address for receiving payments to $account.
   * The account and address will be created if $account doesn't exist.
   *
   * @param string $account Account name
   * @return string Bitcoin address for $account
   * @throws BitcoinClientException
   * @since 0.3.18
   */
  public function getaccountaddress($account) {
    if (!$account || empty($account))
      throw new BitcoinClientException("getaccountaddress requires an account");
    return $this->query("getaccountaddress", $account);
  }

  /**
   * Return a recent hashes per second performance measurement.
   *
   * @return integer Hashes per second
   * @throws BitcoinClientException
   */
  public function gethashespersec() {
    return $this->query("gethashespersec");
  }

  /**
   * Returns the list of addresses associated with the given account.
   *
   * @param string $account
   * @return array
   *    A simple array of Bitcoin addresses associated with $account, empty
   *    if the account doesn't exist.
   * @throws BitcoinClientException
   */
  public function getaddressesbyaccount($account) {
    if (!$account || empty($account))
      throw new BitcoinClientException("getaddressesbyaccount requires an account");
    return $this->query("getaddressesbyaccount", $account);
  }

}

