<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>listaccounts</b><hr />
<?php 


	isset( $this->listaccounts )
		? print_r($this->listaccounts)
		: print "Error: listaccounts not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>