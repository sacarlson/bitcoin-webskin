<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<p><a href="./?a=sendescrow">sendescrow</a></p>

<table>
<form>
<input type="hidden" name="a" value="sendescrow">
 <tr>
   <td>Escrow Address:</td>
   <td><input type="text" name="escrowaddrs" value="<?php print $this->escrowaddrs; ?>" size="80"></td>
 </tr>
 <tr>
   <td>Amount</td>
   <td><input type="text" name="amount" value="<?php print $this->amount; ?>" size="20"></td>   
 </tr>
 <tr>
   <td>&nbsp;</td>
<?php  

if( !isset($_GET['preview']) && $this->escrowaddrs && $this->amount ) {
   print '<td><input type="submit" value="          Send Escrow        "></td>
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

Escrow Address: <?php print $this->escrowaddrs; ?> 

Amount: <?php print @$this->num( $this->amount ); ?> Coins
    
</pre>
<?

	}

	if( isset( $this->sendescrow ) ) {
		print '<pre>Send Escrow Result:<br />'; 
		print_r($this->sendescrow); 		
		print '</pre>';
	}
		
?> 
<?php $this->template('footer'); ?>
