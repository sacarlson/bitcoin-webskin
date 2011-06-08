<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><html><head><title>Bitcoin Webskin</title></head><body>
<pre><a href="./">Bitcoin Webskin</a>    <?php print date('r'); ?> 
<?php	if( $this->wallet_is_open ) {

		print 'Balance: <b>' . $this->info['balance'] . '</b>'
		. '   Blocks: ' . $this->info['blocks'] 		
		. '   Connections: ' . $this->info['connections'] 
		. '   Network: ' . SERVER_NETWORK . ($this->info['testnet'] ? ' Testnet' : '') ;

	} else {
	
		?>Not Connected to Wallet<?php
	
	}
?></pre>
