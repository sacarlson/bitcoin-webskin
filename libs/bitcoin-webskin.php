<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/

if( !file_exists('config.php') ) { 
	$msg = "Can not find Starup file 'config.php'"; 
	include 'skins/simple/fatal.error.php'; 
	exit; 
}
require_once 'config.php';



class BitcoinWebskin {

	public $debug = 0;		// Debug notices  1=on  0=off
	
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
					return 'transactions';
				} 
				
				
				if( !isset($_GET['account']) ) {
					$_GET['account'] = '*';  // ALL
				}
				if( isset($_GET['account']) && $_GET['account'] == '""' ) {
					$_GET['account'] = ''; // Default Account
				}
				
				
				
				$this->account = $this->get_get('account', '');
				$this->count = $this->get_get('count', -1);
				
				$this->debug("Calling: listtransactions( " .$this->account . ", " . $this->count . ")");
					
				$this->listtransactions = $this->wallet->listtransactions(
					(string) $this->account,
					(int)    $this->count					
				); 
				
				$this->info['transactions_count'] = sizeof( $this->listtransactions );
				
				$this->listtransactions = array_reverse( $this->listtransactions );

				$this->lisstransactions = array_walk( 
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
				$this->sendtoaddress = $this->wallet->sendtoaddress(
					(string) $this->get_get('address', '', true),					
					(float)  $this->get_get('amount', '', true),				
					(string) $this->get_get('comment', ''),					
					(string) $this->get_get('comment_to', '')					
				); 
				return 'sendtoaddress'; break;			
			
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
				$this->setgenerate = $this->wallet->setgenerate(
					(bool) $this->get_get('generate', '', true),				
					(int)  $this->get_get('genproclimit', -1)				
				); 
				if( $this->setgenerate == '' ) {
					$this->setgenerate = 'OK';
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
				$this->name_firstupdate = $this->wallet->name_firstupdate(
					(string) $this->get_get('name', ''),															
					(string) $this->get_get('value', ''),
					(string) $this->get_get('address', '', true)										
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
				
			case 'delete_transaction':
				$this->open_wallet(); 			
				$this->delete_transaction = $this->wallet->delete_transaction(
					(string) $this->get_get('txid', '', true)	
				); 
				return 'debug'; break;		


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
	
		$this->debug("open_wallet() called.  wallet_is_open = " . ($this->wallet_is_open ? 'true' : 'false') );		

		if( $this->wallet_is_open ) { return true; }
		
		include_once('libs/bitcoin-interface.php');

		
		
		$this->debug("Starting Interface: bitcoin-php");
		
		include_once('plugins/bitcoin-php.php');
		$this->wallet = new BitcoinPHPcontroler;
		
		$this->debug("Interface created.  Starting wallet... ");			
		
		if( !$this->wallet->start() ) {
			$this->debug("ERROR: unable to open wallet: " . @$this->info['error']);
			$this->wallet_is_open = false;
			return false;
		}
		$this->wallet_is_open = true;		

		$this->info = $this->wallet->info;
		
		$this->info['keypoololdest_date'] = $this->readable_time( $this->info['keypoololdest'] );
		
		$this->debug('Wallet Open. Balance: '.$this->info['balance']
			.'  Blocks: '.$this->info['blocks'].'  Connections: '.$this->info['connections']
			.'  Version: '.$this->info['version'].'  Paytxfee: '.$this->info['paytxfee']);	
		
		return true;
	} // end open_wallet

	private function template($t) {  // Load template	
		$file = 'skins/' . $this->skin . '/' . $t . '.php';
		if( !file_exists($file) ) {
			$msg = "Can not find Template '" . htmlentities($t) . "'"; 
			include 'skins/simple/fatal.error.php'; 
			exit; 
		}
		$this->debug("template($t) loading");		
		try {
			include($file);	
		} catch( Exception $e ) {
			$this->error("template '$t' can not be loaded: " . $e->getMessage() );
		}
	
	} // end function template()

	private function post_process_listtransactions(&$item, $key) {
	
		$item['datetime'] = date('r', $item['time']);
		
		if( isset($item['txid']) ) {
			$item['txid_short'] = substr( $item['txid'], 0, 10) . '...'; 
		}
		
		if( $item['account'] == '' ) { 
			$item['account'] = '""'; 
		}
		
		if( isset($item['confirmations']) && $item['confirmations'] >= 6 ) { 
			$item['status'] = 'confirmed';
		} else { 
			$item['status'] = 'unconfirmed';
		}
		if( $item['category'] == 'move' ) { $item['status'] = 'move'; }  // moves have no confirmations
		
					
		isset($this->info['immature_count']) ? : $this->info['immature_count'] = 0;
		isset($this->info['immature_amount']) ? : $this->info['immature_amount'] = 0;
		isset($this->info['generate_count']) ? : $this->info['generate_count'] = 0;
		isset($this->info['generate_amount']) ? : $this->info['generate_amount'] = 0;
		isset($this->info['orphan_count']) ? : $this->info['orphan_count'] = 0;
		isset($this->info['orphan_amount']) ? : $this->info['orphan_amount'] = 0;
		isset($this->info['move_count']) ? : $this->info['move_count'] = 0;
		isset($this->info['move_amount']) ? : $this->info['move_amount'] = 0;
		isset($this->info['receive_count']) ? : $this->info['receive_count'] = 0;
		isset($this->info['receive_amount']) ? : $this->info['receive_amount'] = 0;
		isset($this->info['send_count']) ? : $this->info['send_count'] = 0;
		isset($this->info['send_amount']) ? : $this->info['send_amount'] = 0;
		isset($this->info['unknown_count']) ? : $this->info['unknown_count'] = 0;
		isset($this->info['unknown_amount']) ? : $this->info['unknown_amount'] = 0;
		
		isset($this->info['transactions_amount']) ? : $this->info['transactions_amount'] = 0;
		$this->info['transactions_amount'] += $item['amount'];
		
		switch( $item['category'] ) { 
			case 'immature':  
				$this->info['immature_count']++;
				$this->info['immature_amount'] += $item['amount'];
				break;
			case 'generate':
				$this->info['generate_count']++;
				$this->info['generate_amount'] += $item['amount'];
				break;			
			case 'orphan':
				$this->info['orphan_count']++;
				$this->info['orphan_amount'] += $item['amount'];
				break;				
			case 'move':
				$this->info['move_count']++;
				$this->info['move_amount'] += $item['amount'];
				break;				
			case 'receive':
				$this->info['receive_count']++;
				$this->info['receive_amount'] += $item['amount'];
				break;				
			case 'send':
				$this->info['send_count']++;
				$this->info['send_amount'] += $item['amount'];
				break;				
			default:
				$this->info['unknown_count']++;
				$this->info['unknown_amount'] += $item['amount'];
				break;				
			
		}
		
	} // end post_process_listtransaction
		

	private function get_get( $get, $default='', $failonempty=false ) { // get a _GET
	
		( isset($_GET[$get]) && $_GET[$get] ) 
			? $r = htmlentities( urldecode($_GET[$get]) )
			: $r = $default;
			
		if( $failonempty && $r == '' ) {
			$msg = "$this->a requires '$get' parameter";
			include 'skins/simple/fatal.error.php'; exit;
		}
		
		//print "<pre style='margin:0'>_GET[$get] = $r</pre>";
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
	}

} // end class BitcoinWebskin