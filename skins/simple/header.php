<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><html><head><title>Bitcoin Webskin</title>
<style type="text/css">
body {
	font-size:15px;
	font-family:sans-serif;	
	color:#000000;
	background-color:#F6FFF6;
	margin:10px;
}

a {
	text-decoration:  none;
}

a:hover, a:active { 	
	color: #000000;
	background-color: #FFFFCC;
}

table {
	border-collapse:collapse;
		
}
table, td {
	border: 1px solid black;
	padding:3px;	
	font-size:14px;
	font-family:sans-serif;		
}

.address {
	font-size:14px;
	font-family:monospace;	
}

.amount, .conf {
	text-align: right;
}

</style>
</head><body>
<pre><a href="./">Bitcoin Webskin</a>    <?php print date('r'); ?> 
<?	if( $this->wallet_is_open ) {

		print 'Balance: <b>' . $this->info['balance'] . '</b>'
		. '   Blocks: ' . $this->info['blocks'] 		
		. '   Connections: ' . $this->info['connections'] 
		. '   Network: ' . SERVER_NETWORK . ($this->info['testnet'] ? ' Testnet' : '') 		
	    //. ' Pay Tx Fee: ' . $this->num($this->info['paytxfee']) 
        //. ' Oldest key: ' . $this->info['keypoololdest_date']
		;

	} else {
	
		?>Not Connected to Wallet<?
	
	}
?></pre>
