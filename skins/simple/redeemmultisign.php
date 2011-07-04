<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<p><a href="./?a=redeemmultisign">redeemmultisign</a></p>

<table>
<form>
<input type="hidden" name="a" value="redeemmultisign">
 <tr>
   <td>transaction ID:</td>
   <td><input type="text" name="inputtx" value="<?php print $this->inputtx; ?>" size="80"></td>
 </tr>
 <tr>
   <td>To Address</td>
   <td><input type="text" name="address" value="<?php print $this->address; ?>" size="20"></td>   
 </tr>
 <tr>
   <td>Amount</td>
   <td><input type="text" name="amount" value="<?php print $this->amount; ?>" size="20"></td>   
 </tr>
 <tr>
   <td>Txhex</td>
   <td><input type="text" name="txhex" value="<?php print $this->txhex; ?>" size="20"></td>   
 </tr>
 <tr>
   <td>&nbsp;</td>
<?php  

if( !isset($_GET['preview']) && $this->inputtx && $this->address ) {
   print '<td><input type="submit" value="          Redeem MultiSign        "></td>
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

transaction ID: <?php print $this->inputtx; ?> 

To Address: <?php print @$this->num( $this->address ); ?> 

Amount: <?php print @this->num( $this->amount ); ?>
    
</pre>
<?

	}

	if( isset( $this->redeemmultisign ) ) {
		print '<pre>Redeem MultiSign Result:<br />'; 
		print_r($this->redeemmultisign); 		
		print '</pre>';
	}
		
?> 
<?php $this->template('footer'); ?>
