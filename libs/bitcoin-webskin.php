<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/

if( !file_exists('config.php') ) { 
	$msg = "Can not find Startup file 'config.php'"; 
	include 'skins/simple/fatal.error.php'; 
	exit; 
}
require_once 'config.php';



class BitcoinWebskin {

	public $debug = 1;		// Debug notices  1=on  0=off
	
	private $wallet_is_open; // Current status of wallet connection   true/false
	
	private $a;	// Current action

	public function __construct() {
		$this->wallet_is_open = false;
		//$this->skin = 'debug';
		$this->skin = 'simple';
		$this->template( $this->get_template() );		
	}

	private function get_template() {  // get template name

		$this->a = $this->get_get('a', 'home');
		
		switch( $this->a ) {

			case 'home': 
				$this->open_wallet();
				return 'home'; break;
			
			default: 
				$msg = 'Unknown Action'; include 'skins/simple/fatal.error.php'; exit; break;
	
			case 'listtransactions':
			
				if( !$this->open_wallet() ) {
					$this->debug('ERROR: listtransactions: open_wallet failed');
					return 'listtransactions';
				} 
				
				
				if( !isset($_GET['account']) ) {
					$_GET['account'] = '*';  // ALL
				}
				if( isset($_GET['account']) && $_GET['account'] == '""' ) {
					$_GET['account'] = ''; // Default Account
				}
				
				
				$this->account = $this->get_get('account', '');
				$this->count = $this->get_get('count', -1);
				

				$this->listtransactions = $this->wallet->listtransactions(
					(string) $this->account,
					(int)    $this->count					
				); 
				
				$this->info['transactions_count'] = sizeof( $this->listtransactions );
				
				$this->listtransactions = @array_reverse( $this->listtransactions );

				$this->lisstransactions = @array_walk( 
					$this->listtransactions, 
					array( &$this, 'post_process_listtransactions') 
				);
				
				return 'listtransactions'; break;
				
				
			case 'listaccounts':  
				$this->open_wallet(); 	
				$this->listaccounts = $this->wallet->listaccounts( 
					(int) $this->get_get('minconf', 1) 
				); 
				return 'listaccounts'; break;
				
			case 'listreceivedbyaccount': 
				$this->open_wallet(); 
				$this->listreceivedbyaccount = $this->wallet->listreceivedbyaccount(
					(int) $this->get_get('minconf', 1),
					(bool) $this->get_get('includeempty', 'false') 
				); 
				return 'listreceivedbyaccount'; break;
	
			case 'getaccountaddress': 
				$this->open_wallet(); 
				$this->getaccountaddress = $this->wallet->getaccountaddress(
					(string) $this->get_get('account', '', $failonempty=true) 
				); 
				return 'getaccountaddress'; break;
				
			case 'getaddressesbyaccount':
				$this->open_wallet(); 
				$this->getaddressesbyaccount = $this->wallet->getaddressesbyaccount(
					(string) $this->get_get('account', '', $failonempty=true),
					(int) $this->get_get('minconf', 1)
				); 
				return 'getaddressesbyaccount'; break;
			
			case 'getreceivedbyaccount': 
				$this->open_wallet(); 
				$this->getreceivedbyaccount = $this->wallet->getreceivedbyaccount(
					(string) $this->get_get('account', '', true) 
				); 
				return 'getreceivedbyaccount'; break;
				
			case 'getbalance': 
				$this->open_wallet(); 
				$this->getbalance = $this->wallet->getbalance(
					(string) $this->get_get('account', '', true),
					(int) $this->get_get('minconf', 1)					
				); 
				return 'getbalance'; break;


			// Transactions

			case 'gettransaction': 
				$this->open_wallet(); 
				$this->gettransaction = $this->wallet->gettransaction(
					(string) $this->get_get('txid', '', true)				
				); 
				return 'gettransaction'; break;			

			case 'listreceivedbyaddress': 
				$this->open_wallet(); 
				$this->listreceivedbyaddress = $this->wallet->listreceivedbyaddress(
					(int)  $this->get_get('minconf', 1),
					(bool) $this->get_get('includeempty', false) 					
				); 
				return 'listreceivedbyaddress'; break;	
				
			case 'getnewaddress':
				$this->open_wallet(); 
				$this->getnewaddress = $this->wallet->getnewaddress(
					(string) $this->get_get('account', '')				
				); 
				return 'getnewaddress'; break;		
				
			case 'getreceivedbyaddress': 
				$this->open_wallet(); 			
				$this->getreceivedbyaddress = $this->wallet->getreceivedbyaddress(
					(string) $this->get_get('address', ''),				
					(int)    $this->get_get('minconf', 1)			
				); 
				return 'getreceivedbyaddress'; break;				

			case 'getaccount':
				$this->open_wallet(); 			
				$this->getaccount = $this->wallet->getaccount(
					(string) $this->get_get('address', '', true)					
				); 
				return 'getaccount'; break;	

			case 'setaccount':
				$this->open_wallet(); 			
				$this->setaccount = $this->wallet->setaccount(
					(string) $this->get_get('address', '', true),					
					(string) $this->get_get('account', '', true)					
				); 
				if( $this->setaccount == '' ) { 
					$this->setaccount = 'OK';
				}
				return 'setaccount'; break;	
				
			case 'validateaddress': 
				$this->open_wallet(); 			
				$this->validateaddress = $this->wallet->validateaddress(
					(string) $this->get_get('address', '', true)					
				); 
				return 'validateaddress'; break;			
				
			case 'sendtoaddress': 
			
				$this->open_wallet(); 			
				
				$this->address = $this->get_get('address', '');
				$this->amount = $this->get_get('amount', '');
				$this->ok = $this->get_get('ok', '0');

	
				$this->debug("send address:$this->address amount:$this->amount ok:$this->ok");

				if( $this->address ) { 

					$this->validateaddress = $this->wallet->validateaddress( $this->address );
					if( !$this->validateaddress['isvalid'] ) { 
						$this->debug('invalid address: ' . $this->address);
						return 'sendtoaddress'; break;	
						
					}
					
				} 
				
				if( $this->address && $this->amount && $this->ok ) { 

					$this->debug("Sending coins");
					
					$this->sendtoaddress = $this->wallet->sendtoaddress(
						(string) $this->address,					
						(float)  $this->amount,				
						(string) $this->get_get('comment', ''),					
						(string) $this->get_get('comment_to', '')					
					); 
				}
				
				return 'sendtoaddress'; break;			
			

                                case 'sendescrow':
			
                                $this->open_wallet(); 			
				
                                $this->inputtx = $this->get_get('inputtx', '');
                                $this->address = $this->get_get('address', '');
                                $this->amount = $this->get_get('amount', '');
                                $this->ok = $this->get_get('ok', '0');

	
                                $this->debug("inputtx:$this->inputtx send address:$this->address amount:$this->amount ok:$this->ok");

				if( $this->address ) { 

					$this->validateaddress = $this->wallet->validateaddress( $this->address );
					if( !$this->validateaddress['isvalid'] ) { 
						$this->debug('invalid address: ' . $this->address);
						return 'sendescrow'; break;	
						
					}
					
				} 
				
				if( $this->address && $this->amount && $this->ok ) { 

					$this->debug("Sending escrow");
					
					$this->sendescrow = $this->wallet->sendescrow(
                                                (string) $this->inputtx,
						(string) $this->address,					
						(float)  $this->amount,				
						(string) $this->get_get('comment', ''),					
						(string) $this->get_get('comment_to', '')					
					); 
				}
				
				return 'sendescrow'; break;
	
			case 'sendfrom':
				$this->open_wallet(); 			
				$this->sendfrom = $this->wallet->sendfrom(
					(string) $this->get_get('account', '', true),					
					(string) $this->get_get('address', '', true),					
					(float)  $this->get_get('amount', '', true),				
					(int)    $this->get_get('minconf', 1),				
					(string) $this->get_get('comment', ''),					
					(string) $this->get_get('comment_to', '')					
				); 
				return 'sendfrom'; break;				
			
			case 'sendmany': 
				$this->open_wallet(); 			
				$this->sendmany = $this->wallet->sendmany(
					(string) $this->get_get('account', '', true),					
					(string) $this->get_get('tomany', '', true),									
					(int)    $this->get_get('minconf', 1),				
					(string) $this->get_get('comment', '')							
				); 
				return 'sendmany'; break;				
			
			case 'move': 
				$this->open_wallet(); 			
				$this->move = $this->wallet->move(
					(string) $this->get_get('fromaccount', '', true),					
					(string) $this->get_get('toaccount', '', true),									
					(float)  $this->get_get('amount', '', true),				
					(int)    $this->get_get('minconf', 1),				
					(string) $this->get_get('comment', '')							
				); 
				return 'move'; break;				

			case 'getinfo': 
				$this->open_wallet(); 
				$this->getinfo = @$this->info; 
				return 'getinfo'; break;
			
			case 'getblockcount': 
			case 'getblocknumber': 
			case 'getconnectioncount': 
			case 'getdifficulty': 
			case 'getgenerate': 
			case 'gethashespersec':
			case 'getwork': 
			case 'stop':
				$this->open_wallet(); 
				$this->{$this->a} = $this->wallet->{$this->a}(); 
				return 'debug'; break;
			

			case 'start':
			case 'getprocess':
			case 'kill':			
				$this->open_wallet(); 			
				$this->{$this->a} = $this->wallet->{$this->a}(); 
				return 'debug'; break;

				
			case 'backupwallet':
				$this->open_wallet(); 			
				$this->backupwallet = $this->wallet->backupwallet(
					(string) $this->get_get('destination', '', true)				
				); 
				if( $this->backupwallet == '' ) { 
					$this->backupwallet = 'OK';
				}				
				return 'backupwallet'; break;
				
				
				
				
			case 'setgenerate':
			
				$this->open_wallet(); 		
				
				// hacky fix until we do better per-_GET/_POST to $this->{_GET/_POST} var with typecasting
				switch( $this->get_get('generate', '', TRUE) ) {
					case 'false':
					case '0':
						$this->generate = 0;
						break;
					case 'true':
					case '1':
						$this->generate = 1;
						break;
					default:
						$this->debug("ERROR: setgenerate generate is not boolean");
						return 'setgenerate'; 
						break;
				
				}

				$this->genproclimit = (int) $this->get_get('genproclimit', '');
				
				$this->setgenerate = $this->wallet->setgenerate( 
					(bool)$this->generate, (int)$this->genproclimit 
				); 

				if( $this->setgenerate == '' ) {
					$this->setgenerate = "OK: setgenerate $this->generate $this->genproclimit" ;
				}
				
				
				return 'setgenerate'; break;
				
				
				
				
				
			case 'help': 
				$this->open_wallet(); 			
				$this->help = $this->wallet->help(
					(string) $this->get_get('command', '')				
				); 
				return 'help'; break;
			
			
			// Namecoin
			case 'name_list':
				$this->open_wallet(); 			
				$this->name_list = $this->wallet->name_list(
					(string) $this->get_get('name', '')								
				); 
				return 'debug'; break;		

			case 'name_new':
				$this->open_wallet(); 			
				$this->name_new = $this->wallet->name_new(
					(string) $this->get_get('name', '')								
				); 
				return 'debug'; break;

			case 'name_firstupdate':
				$this->open_wallet(); 			
				$this->name_firstupdate = $this->wallet->name_firstupdate(
					(string) $this->get_get('name', ''),								
					(string) $this->get_get('rand', ''),								
					(string) $this->get_get('tx', ''),								
					(string) $this->get_get('value', '')								
				); 
				return 'debug'; break;
				
			case 'name_update':
				$this->open_wallet(); 			
				$this->name_update = $this->wallet->name_update(
					(string) $this->get_get('name', ''),															
					(string) $this->get_get('value', ''),
					(string) $this->get_get('address', '')										
				); 
				return 'debug'; break;
				
			case 'name_scan':
				$this->open_wallet(); 			
				$this->name_scan = $this->wallet->name_scan(
					(string) $this->get_get('start_name', ''),				
					(int) $this->get_get('max_returned', '')				
				); 
				return 'debug'; break;
				
			case 'name_clean':
				$this->open_wallet(); 			
				$this->name_clean = $this->wallet->name_clean(); 
				return 'debug'; break;						
				
			case 'deletetransaction':
				$this->open_wallet(); 			
				$this->deletetransaction = $this->wallet->deletetransaction(
					(string) $this->get_get('txid', '', true)	
				); 
				return 'debug'; break;		


				
			////////////////////////////////////////////////////////////////////////////////////////////////
			case 'server.control': 
					
				if( !SERVER_LOCALHOST ) {
					$this->info['control'] = 'Error: No Localhost server found in configuration';
					return 'server.control';
				}
				
				if( SERVER_LOCALHOST_TYPE != 'windows' ) {
					$this->info['control'] = 'Erro: No Windows platform found in configuration';
					return 'server.control';
				}
				switch( strtolower( $this->get_get('a1', '') ) ) {
				
					case 'view': 
						// tasklist 
						$tasklist = shell_exec(WINDOWS_TASKLIST 
							. ' /FO LIST /FI "IMAGENAME eq ' . SERVER_NAME . '" 2>&1');
						//$tasklist = shell_exec(WINDOWS_TASKLIST . ' 2>&1');
						$found = strpos($tasklist, SERVER_NAME);
						if( $found === false ) { 
							$this->info['control'] = SERVER_NAME . ' Process Not Found';
							return 'server.control';
						}
						//$header = substr($tasklist, 0, 154);
						//$info = substr($tasklist, $found, 76);
						//$this->info['control'] = "$header\n$info";
						$this->info['control'] = $tasklist;
						break;
						
					case 'start': 
			
						if( !file_exists( SERVER ) ) {
							$this->info['control'] = "Error: Can not find server executable '" . SERVER . "'";
							return 'server.control';
						}
						
						if( !file_exists( SERVER_CONF ) ) {
							$this->info['control'] = "ERROR: Can not find server configuration file '" 
							. SERVER_CONF . "'<br />Please create this configuration file.";
							return 'server.control';
						}
						
						$start_cmd = 'start /B ' . SERVER 
							. ( SERVER_TESTNET ? ' -testnet ' : '' )
							. ' -datadir=' . SERVER_DATADIR 
							. ' -conf=' . SERVER_CONF;
						
						$this->info['control'] = "Running: $start_cmd\n";
						try {
							//$this->info['control'] = shell_exec( $start_cmd. ' 2>&1');
							pclose(popen("start /B ". $start_cmd, "r"));  // start in background, return execution to us
						} catch( BitcoinClientException $e ) {
							$this->info['control'] .= "Error: Can not start server: \nCommand: $cmd \nMessage: " 
								. $e->getMessage();
						}
						break;				
				
				} // end switch
				
				return 'server.control';
				break;
				
			// misc
			
			case 'mtgox':
			
				include_once('plugins/mtgox.php');
				
				$this->info['mtgox_ticker'] = mtgox_get_ticker();
											//= null_data_ticker();
											
				switch( $this->get_get('a1', '') ) {
					case 'depth':
						$this->info['mtgox_depth']  = mtgox_get_depth();
												    //= null_data_depth();
						break;
					case 'trades':
						$this->info['mtgox_trades'] = mtgox_get_trades();
													//= null_data_trades();		
						break;
				}
				
				return 'mtgox';
				break;			
	
				
		} // end switch

	} // end get_template()

	private function open_wallet() {  // Open the wallet
	
		//$this->debug("open_wallet() called.  wallet_is_open = " . ($this->wallet_is_open ? 'true' : 'false') );		

		if( $this->wallet_is_open ) { return true; }
		
		include_once('libs/bitcoin-interface.php');
		include_once('plugins/jsonRPCClient.php');
		$this->wallet = new jsonRPCClientControler;
		
		//$this->debug("Interface created.  Starting wallet... ");			
		
		if( !$this->wallet->start($this->debug) ) {
			$this->debug("ERROR: unable to open wallet: " . @$this->wallet->info['error']);
			$this->wallet_is_open = false;
			return false;
		}
		$this->wallet_is_open = true;		

		$this->info = $this->wallet->info;
		
		$this->info['keypoololdest_date'] = $this->readable_time( $this->info['keypoololdest'] );
		
		//$this->debug('Wallet Open. Balance: '.$this->info['balance']
		//	.'  Blocks: '.$this->info['blocks'].'  Connections: '.$this->info['connections']
		//	.'  Version: '.$this->info['version'].'  Paytxfee: '.$this->info['paytxfee']);	
		
		return true;
	} // end open_wallet

	private function template($t) {  // Load template	
		$file = 'skins/' . $this->skin . '/' . $t . '.php';
		if( !file_exists($file) ) {
			$msg = "Can not find Template '" . htmlentities($t) . "'"; 
			include 'skins/simple/fatal.error.php'; 
			exit; 
		}
		//$this->debug("template($t) loading");		
		try {
			include($file);	
		} catch( Exception $e ) {
			$this->error("template '$t' can not be loaded: " . $e->getMessage() );
		}
	
	} // end function template()

	private function post_process_listtransactions(&$item, $key) {
	
		$item['datetime'] = date('r', $item['time']);
	
		if( isset($item['amount']) ) {
			$item['amount'] = $this->num($item['amount']);
		} else {
			$item['amount'] = $this->num(0);
		}
		
		if( isset($item['txid']) ) {
			$item['txid_short'] = substr( $item['txid'], 0, 10) . '...'; 
		}
		
		if( $item['account'] == '' ) { 
			$item['account'] = '""'; 
		}
		
		if( !isset($item['confirmations'])  ) { 
			$item['confirmations'] = 0;
		}
		
		if(    ( $item['category'] != 'immature' && $item['confirmations'] >= 6 )
			|| ( $item['category'] == 'immature' && $item['confirmations'] >= 120 )
			|| $item['category'] == 'generate'
		) { 
			$item['status'] = $item['confirmations'] . ' confirmations';
		} else { 
			$item['status'] = $item['confirmations'] . '/unconfirmed';
		}
		

		if(    $item['category'] == 'move'
			|| $item['category'] == 'orphan'
		) { 
			$item['status'] = $item['confirmations'];
		}  
		
		
		@$this->info['transactions_amount'] += $item['amount'];
		
		switch( $item['category'] ) { 
			case 'immature':  
				@$this->info['immature_count']++;
				@$this->info['immature_amount'] += $item['amount'];
				break;
			case 'generate':
				@$this->info['generate_count']++;
				@$this->info['generate_amount'] += $item['amount'];
				break;			
			case 'orphan':
				@$this->info['orphan_count']++;
				@$this->info['orphan_amount'] += $item['amount'];
				break;				
			case 'move':
				@$this->info['move_count']++;
				@$this->info['move_amount'] += $item['amount'];
				break;				
			case 'receive':
				@$this->info['receive_count']++;
				@$this->info['receive_amount'] += $item['amount'];
				break;				
			case 'send':
				@$this->info['send_count']++;
				@$this->info['send_amount'] += $item['amount'];
				break;				
			default:
				@$this->info['unknown_count']++;
				@$this->info['unknown_amount'] += $item['amount'];
				break;				
		}
		
		
		

		@$this->info['transactions_amount'] = $this->num($this->info['transactions_amount']);
		@$this->info['immature_amount'] = $this->num($this->info['immature_amount']);
		@$this->info['generate_amount'] = $this->num($this->info['generate_amount']);
		@$this->info['orphan_amount'] = $this->num($this->info['orphan_amount']);
		@$this->info['move_amount'] = $this->num($this->info['move_amount']);
		@$this->info['receive_amount'] = $this->num($this->info['receive_amount']);
		@$this->info['send_amount'] = $this->num($this->info['send_amount']);
		@$this->info['unknown_amount'] = $this->num($this->info['unknown_amount']);
		
	} // end post_process_listtransaction
		

	private function get_get( $get, $default='', $failonempty=false ) { // get a _GET
	
		( isset($_GET[$get]) && $_GET[$get] ) 
			? $r = htmlentities( urldecode($_GET[$get]) )
			: $r = $default;
			
		if( $failonempty && $r == '' ) {
			$msg = "$this->a requires '$get' parameter";
			include 'skins/simple/fatal.error.php'; exit;
		}

		return $r;
	}
	
	public function num($n) {  // Bitcoin number format 
		return number_format($n,8);
	}

	public function readable_time($t) {  // Unixtime to readable human time
		is_int($t) ? $r = date('r', $t) : $r = 'error';
		return $r;
	}
	
	
	public function debug($msg) {
		if( !$this->debug ) { return; }
		print "<pre style='margin:0'>DEBUG: "; print_r($msg); print '</pre>';
		//print "<span style='margin:0'><br />DEBUG: "; print_r($msg); print '</span>';	
	}

} // end class BitcoinWebskin
