<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>validateaddress</b><hr />
<?php 


	isset( $this->validateaddress )
		? print_r($this->validateaddress)
		: print "Error: validateaddress not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>