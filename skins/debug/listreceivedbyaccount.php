<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>listreceivedbyaccount</b><hr />
<?php 


	isset( $this->listreceivedbyaccount )
		? print_r($this->listreceivedbyaccount)
		: print "Error: listreceivedbyaccount not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>