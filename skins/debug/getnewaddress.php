<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>getnewaddress</b><hr />
<?php 


	isset( $this->getnewaddress )
		? print_r($this->getnewaddress)
		: print "Error: getnewaddress not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>