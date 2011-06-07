<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>

<p>List Accounts:</p>

<table>
 <tr><td>Account</td><td>Balance</td></tr><?php 

	while( list($name,$val) = @each($this->listaccounts) ) {
		print "<tr><td>$name</td><td class='amount'>" . $this->num($val) . "</td></tr>";
	}
		
?></table>
<?php $this->template('footer'); ?>