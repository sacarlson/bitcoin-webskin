<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/


class WebskinTest implements Bitcoin, Namecoin {

	// Control
	public function start() {  // start the local server
		return 'error';
	}
	public function getprocess() {  // get info on server process
		return 'error';
	}
	public function kill() {  // kill the local server process
		return 'error';
	}
	
	// Accounts
    public function listaccounts( $minconf=1 ) { 
		return array(
			'' => -0.12345678,
			'Test Account' => 9.87654321
		);
	} // end listaccounts
	
    public function listreceivedbyaccount( $minconf=1, $includeempty=false ) { 
		return array(
			array(
				'account' => '',
				'label' => '',
				'amount' => 0.12345678,
				'confirmations' => 100
			),
			array(
				'account' => 'Test Account',
				'label' => 'Test Account',
				'amount' => 9.87654321,
				'confirmations' => 125,
			),
		);
	} // end listreceivedbyaccount
	
    public function getaccountaddress( $account ) { 
		return 'error';
	}
    public function getaddressesbyaccount( $account ) { 
		return 'error';
	}
    public function getreceivedbyaccount( $account, $minconf=1 ) { 
		return 'error';
	}
    public function getbalance( $account, $minconf=1 ) { 	
		return 'error';
	}
	
	// Transactions
    public function listtransactions( $account, $count=10 ) { 
    		return array(
				array(
					'account' => '',
					'address' => '1testaddressaaaaaaaaaaaaaaaaaaaaaa',
					'category' => 'receive',
					'amount' => 0.12345678,
					'confirmations' => 100,
					'txid' => '01testaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
					'time' => '1306300000',
				),
				array(
					'account' => '',
					'address' => '1testaddressaaaaaaaaaaaaaaaaaaaaab',
					'category' => 'send',
					'amount' => 0.12345678,
					'confirmations' => 100,
					'txid' => '02testaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaab',
					'time' => '1306300001',
				)
			);
	} 
	
	
	public function gettransaction( $txid ) { 
		return array(
			'amount' => 0.12345678,
			'confirmations' => 123,
			'txid' => '9xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
			'time' => 1306700000,
			'details' => array(
							array(
								'account' => 'Test Account',
								'address' => '1TESTaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
								'category' => 'receive',
								'amount' => 0.12345678
							)
						)
			);
	} // end gettransaction
	
	
	// Addresses
	public function listreceivedbyaddress( $minconf=1, $includeempty=false ) { 
		return array(
			array(
				'address' => '1TESTaaaaaaaaaaaaaaaaaaaaaaaaaaaaA',
				'account' => '',
				'label' => '',
				'amount' => 0.12345678,
				'confirmations' => 100
			),
			array(
				'address' => '1TESTaaaaaaaaaaaaaaaaaaaaaaaaaaaaB',
				'account' => 'Test Account',
				'label' => 'Test Account',
				'amount' => 9.87654321,
				'confirmations' => 125,
			),
		);
	}

	public function getnewaddress( $account='' ) { 
    		return '1TESTaaaaaaaaaaaaaaaaaaaaaaaaaaNEW';
	}

	public function getreceivedbyaddress( $address, $minconf=1 ) { 
    		return 'error';
	}
	public function getaccount( $address ) { 
    		return 'error';
	}
	public function setaccount( $address, $account ) { 
    		return 'error';
	}
	public function validateaddress( $address ) { 	
		return 'error';
	}
	
	// Sending
    public function sendtoaddress( $address, $amount, $comment='', $comment_to='' ) { 	
    		return 'error';
	}
	public function sendfrom( $fromaccount, $toaddress, $amount, $minconf=1, $comment='', $comment_to='' ) { 
    		return 'error';
	}
	public function sendmany( $fromaccount, $tomany, $minconf=1, $comment='') { 
			return 'error';
	}
	public function move( $fromaccount, $toaccount, $amount, $minconf=1, $comment='' ) { 
			return 'error';
	}
	
	// Server
    public function getinfo() { 	
    		return array(
				'version' 		=> 32100,
				'balance' 		=> 1.12345678,
				'blocks' 		=> 1000,
				'connections' 	=> 10,
				'proxy' 		=> '',
				'generate' 		=> false,
				'genproclimit' 	=> 0,
				'difficulty' 	=> 123456.789012,
				'hashespersec' 	=> 0,
				'testnet' 		=> false,
				'keypoololdest' => 1305700000,
				'paytxfee'		=> 0.00000000,
				'errors' 		=> 'Test Data'
			);
	}

	public function getblockcount() { 	
    		return 'error';
	}
	public function getblocknumber() { 	
    		return 'error';
	}
	public function getconnectioncount() { 	
    		return 'error';
	}
	public function getdifficulty() { 	
    		return 'error';
	}
	public function getgenerate() { 	
    		return 'error';
	}
	public function gethashespersec() { 	
    		return 'error';
	}
	public function getwork( $data='' ) { 	
    		return 'error';
	}
	public function backupwallet( $destination ) { 	
    		return 'error';
	}
	public function setgenerate( $generate, $genproclimit=-1 ) { 
    		return 'error';
	}
	
	public function help( $command='' ) { 
			return 'backupwallet <destination>
getaccount <bitcoinaddress>
getaccountaddress <account>
getaddressesbyaccount <account>
getbalance [account] [minconf=1]
getblockcount
getblocknumber
getconnectioncount
getdifficulty
getgenerate
gethashespersec
getinfo
getnewaddress [account]
getreceivedbyaccount <account> [minconf=1]
getreceivedbyaddress <bitcoinaddress> [minconf=1]
gettransaction <txid>
getwork [data]
help [command]
listaccounts [minconf=1]
listreceivedbyaccount [minconf=1] [includeempty=false]
listreceivedbyaddress [minconf=1] [includeempty=false]
listtransactions [account] [count=10]
move <fromaccount> <toaccount> <amount> [minconf=1] [comment]
sendfrom <fromaccount> <tobitcoinaddress> <amount> [minconf=1] [comment] [comment-to]
sendmany <fromaccount> {address:amount,...} [minconf=1] [comment]
sendtoaddress <bitcoinaddress> <amount> [comment] [comment-to]
setaccount <bitcoinaddress> <account>
setgenerate <generate> [genproclimit]
stop
validateaddress <bitcoinaddress>
';
	}
	
	public function stop() { 
		return 'error';
	}
	
	
	// Namecoin
    public function name_list( $name ) { return 'error'; }
    public function name_scan( $start_name='', $max_returned ) { return 'error'; }
    public function name_new( $name ) { return 'error'; }
    public function name_firstupdate( $name, $rand, $tx, $value ) { return 'error'; }
    public function name_update( $name, $value, $toaddress='' ) { return 'error'; }
	public function name_clean() { return 'error'; }
    public function deletetransaction( $txid ) { return 'error'; }
	
	
	
} // end class BitcoinInterfaceTest