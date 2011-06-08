<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>help</b><hr />
<?php 


	isset( $this->help )
		? print_r($this->help)
		: print "Error: help not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>