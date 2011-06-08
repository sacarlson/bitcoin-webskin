<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><b>listtransactions</b><hr />
<?php 


	isset( $this->listtransactions )
		? print_r($this->listtransactions)
		: print "Error: listtransactions not set";
		
?> 
</pre>
<?php $this->template('footer'); ?>