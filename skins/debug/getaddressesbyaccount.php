<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>getaddressbyaccount</b><hr />
<?php 


	isset( $this->getaddressbyaccount )
		? print_r($this->getaddressbyaccount)
		: print "Error: getaddressbyaccount not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>