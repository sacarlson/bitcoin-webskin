<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>setaccount</b><hr />
<?php 


	isset( $this->setaccount )
		? print_r($this->setaccount)
		: print "Error: setaccount not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>