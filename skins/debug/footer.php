<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><pre>
<hr size="1" /><a href="./">Bitcoin Webskin</a>  
 
Info: <?php 

	if( isset($this->info) ) {
		print_r($this->info);
	} else {
		print 'No Info';
	}
	
?> 
</pre></body></html>