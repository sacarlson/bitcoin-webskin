<?php $this->template('header'); ?>
<pre><a href="./?a=server.control">Server Control</a> 
<?php 
	if( isset($this->info['control'] ) ) {
		print "\n" . $this->info['control'] . "\n";
	}
?> 
<a href="./?a=server.control&a1=view">View Server Process</a> 

Server:  <a href="./?a=server.control&a1=start">Start</a>  <a href="./?a=stop">Stop</a>
<!-- <a href="./?a=server.control&a1=kill">Kill Server</a> (kill server process) (not yet in use) -->

Coin Generation:  <a href="./?a=setgenerate&generate=true&genproclimit=-1">Start</a>  <a href="./?a=setgenerate&generate=false&genproclimit=0">Stop</a>



Configuration:
SERVER_LOCALHOST     : <?php print SERVER_LOCALHOST; ?> 
SERVER_LOCALHOST_TYPE: <?php print SERVER_LOCALHOST_TYPE; ?> 
WINDOWS_TASKLIST     : <?php print WINDOWS_TASKLIST; ?> 

SERVER        : <?php print SERVER; ?> 
SERVER_NAME   : <?php print SERVER_NAME; ?> 
SERVER_DATADIR: <?php print SERVER_DATADIR; ?> 
SERVER_CONF   : <?php print SERVER_CONF; ?> 

</pre>
<?php $this->template('footer'); ?>