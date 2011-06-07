<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<table>
 <tr>
  <td>Address</td>
  <td>Amount</td>
  <td>Confs</td>
  <td>Account</td>
 </tr>
<?php

	while( list(,$x) = @each($this->listreceivedbyaddress) ) {
		print '<tr><td class="address">' . $x['address'] .'</td>'
		. '<td class="amount">' . $x['amount'] .'</td>'
		. '<td class="conf">' .$x['confirmations'] .'</td>'
		. '<td class="account">' .'<a href="?a=listtransactions&account=' . urlencode($x['account']) . '">' 
		. $x['account'] . '</a></td></tr>'
		;

	}

?> 
</table>
<?php $this->template('footer'); ?>
