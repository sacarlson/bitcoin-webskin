<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<p><a href="./?a=sendtoaddress">sendtoaddress</a></p>

<table>
<form>
<input type="hidden" name="a" value="sendtoaddress">
 <tr>
   <td>to Address</td>
   <td><input type="text" name="address" value="<?php print $this->address; ?>" size="45"></td>
 </tr>
 <tr>
   <td>Amount</td>
   <td><input type="text" name="amount" value="<?php print $this->amount; ?>" size="20"></td>   
 </tr>
 <tr>
   <td>&nbsp;</td>
<?php  

if( isset($_GET['preview']) && $this->address && $this->amount ) {
   print '<td><input type="submit" value="          Send Coins To Address        "></td>
   <input type="hidden" name="ok" value="1">';
 } else { 
   print '<td><input type="submit" value="               Preview                "></td>
   <input type="hidden" name="preview" value="1">';   
 } 
 
 ?>
</form>
</table>

<?php 

   if( !$this->ok ) { 
    ?>
<pre>
PREVIEW:

Validating Address: <?php print $this->address; ?> 
<?php print_r(@$this->validateaddress); ?> 

Amount: <?php print @$this->num( $this->amount ); ?> Coins
    
</pre>
<?

	}


	if( isset( $this->sendtoaddress ) ) {
		print '<pre>Send Result:<br />'; 
		print_r($this->sendtoaddress); 
		print '<p><a href="./?a=gettransaction&txid=' . urlencode($this->sendtoaddress) 
		. '">gettransaction( ' . $this->sendtoaddress . ' )</a>';
		print '</pre>';
	}
		
?> 
<?php $this->template('footer'); ?>