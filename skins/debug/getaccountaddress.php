<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>getaccountaddress</b><hr />
<?php 


	isset( $this->getaccountaddress )
		? print_r($this->getaccountaddress)
		: print "Error: getaccountaddress not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>