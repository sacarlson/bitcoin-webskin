<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>gettransaction</b><hr />
<?php 


	isset( $this->gettransaction )
		? print_r($this->gettransaction)
		: print "Error: gettransaction not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>