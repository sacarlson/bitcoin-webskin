<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><pre>
<hr size="1" /><a href="./">Bitcoin Webskin</a> 
<?php 

	if( isset($this->info['error']) && $this->info['error'] ) {
		print 'ERROR: ' . $this->info['error'] . '<hr size="1" /><br />';
	}
	
?> 
</pre></body></html>