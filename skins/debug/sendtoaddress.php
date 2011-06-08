<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>sendtoaddress</b><hr />
<?php 


	isset( $this->sendtoaddress )
		? print_r($this->sendtoaddress)
		: print "Error: sendtoaddress not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>