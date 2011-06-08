<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>sendmany</b><hr />
<?php 


	isset( $this->sendmany )
		? print_r($this->sendmany)
		: print "Error: sendmany not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>