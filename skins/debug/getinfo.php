<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>getinfo</b><hr />
<?php 

	isset( $this->info )
		? print_r($this->info)
		: print "Error: info not set";
/*		
	isset( $this->getinfo )
		? print_r($this->getinfo)
		: print "Error: getinfo not set";
*/		
?> 
</pre>
<?php $this->template('footer'); ?>