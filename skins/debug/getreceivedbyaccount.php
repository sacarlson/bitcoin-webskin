<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>getreceivedbyaccount</b><hr />
<?php 


	isset( $this->getreceivedbyaccount )
		? print_r($this->getreceivedbyaccount)
		: print "Error: getreceivedbyaccount not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>