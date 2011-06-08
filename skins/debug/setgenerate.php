<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>setgenerate</b><hr />
<?php 


	isset( $this->setgenerate )
		? print_r($this->setgenerate)
		: print "Error: setgenerate not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>