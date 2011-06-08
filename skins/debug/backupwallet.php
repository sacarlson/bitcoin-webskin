<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>backupwallet</b><hr />
<?php 


	isset( $this->backupwallet )
		? print_r($this->backupwallet)
		: print "Error: backupwallet not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>