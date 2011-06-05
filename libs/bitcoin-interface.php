<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/

interface Webskin {

	public function start(); // start the local server
	public function getprocess(); // get info on server process
	public function kill(); // kill the local server process
	
} // end Webskin interface

interface Bitcoin extends Webskin {

	const bitcoin_version = 32100;

	// Accounts
    public function listaccounts( $minconf=1 );
    public function listreceivedbyaccount( $minconf=1, $includeempty=false );
    public function getaccountaddress( $account );
    public function getaddressesbyaccount( $account );
    public function getreceivedbyaccount( $account, $minconf=1 );
    public function getbalance( $account, $minconf=1 );	

	// Transactions
    public function listtransactions( $account, $count=10 );
    public function gettransaction( $txid );

	// Addresses
	public function listreceivedbyaddress( $minconf=1, $includeempty=false );
    public function getnewaddress( $account='' );
    public function getreceivedbyaddress( $address, $minconf=1 );
    public function getaccount( $address );
    public function setaccount( $address, $account );
    public function validateaddress( $address );	

	// Sending
    public function sendtoaddress( $address, $amount, $comment='', $comment_to='' );	
    public function sendfrom( $fromaccount, $toaddress, $amount, $minconf=1, $comment='', $comment_to='' );
    public function sendmany( $fromaccount, $tomany, $minconf=1, $comment='');
	public function move( $fromaccount, $toaccount, $amount, $minconf=1, $comment='' );
	
	// Server
    public function getinfo();	
    public function getblockcount();	
    public function getblocknumber();	
    public function getconnectioncount();	
    public function getdifficulty();	
    public function getgenerate();	
    public function gethashespersec();	
    public function getwork( $data='' );	
    public function backupwallet( $destination );	
    public function setgenerate( $generate, $genproclimit=-1 );
    public function help( $command='' );
	public function stop();

} // End Bitcoin interface

interface Namecoin extends Bitcoin {

	const namecoin_version = 32150;
	
	// Names
    public function name_list( $name );
    public function name_scan( $start_name='', $max_returned );	
    public function name_new( $name );	
    public function name_firstupdate( $name, $rand, $tx, $value );
    public function name_update( $name, $value, $toaddress='' );
	
	// Server
	public function name_clean();
		
	// Transactions
    public function deletetransaction( $txid );
	
} // End Namecoin interface

