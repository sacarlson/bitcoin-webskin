<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><pre>
<hr size="1" /><a href="./">Bitcoin Webskin</a> 
<hr size="1" />Info: <?php 

	if( isset($this->info) ) {
		print_r($this->info);
	}
	
?> 
</pre></body></html>