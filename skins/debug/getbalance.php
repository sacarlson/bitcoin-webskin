<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>getbalance</b><hr />
<?php 


	isset( $this->getbalance )
		? print_r($this->getbalance)
		: print "Error: getbalance not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>