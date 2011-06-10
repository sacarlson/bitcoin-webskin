<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>sendfrom</b><hr />
<?php 


	isset( $this->sendfrom )
		? print_r($this->sendfrom)
		: print "Error: sendfrom not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>