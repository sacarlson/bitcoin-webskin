<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>getreceivedbyaddress</b><hr />
<?php 


	isset( $this->getreceivedbyaddress )
		? print_r($this->getreceivedbyaddress)
		: print "Error: getreceivedbyaddress not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>