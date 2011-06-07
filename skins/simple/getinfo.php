<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre>DEBUG: <b><?php print $this->a; ?></b><hr />
<?php 


	isset( $this->{$this->a} )
		? print_r($this->{$this->a})
		: print "Error: DEBUG template can not find property '" . $this->a . "'";
		
?> 
</pre>
<?php $this->template('footer'); ?>