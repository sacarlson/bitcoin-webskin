<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>getaccount</b><hr />
<?php 


	isset( $this->getaccount )
		? print_r($this->getaccount)
		: print "Error: getaccount not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>