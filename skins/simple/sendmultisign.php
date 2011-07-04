<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<p><a href="./?a=sendmultisign">sendmultisign</a></p>

<table>
<form>
<input type="hidden" name="a" value="sendmultisign">
 <tr>
   <td>MultiSign Address:</td>
   <td><input type="text" name="multiaddrs" value="<?php print $this->multiaddrs; ?>" size="80"></td>
 </tr>
 <tr>
   <td>Amount</td>
   <td><input type="text" name="amount" value="<?php print $this->amount; ?>" size="20"></td>   
 </tr>
 <tr>
   <td>&nbsp;</td>
<?php  

if( !isset($_GET['preview']) && $this->multiaddrs && $this->amount ) {
   print '<td><input type="submit" value="          Send MultiSign        "></td>
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

MultiSign Address: <?php print $this->multiaddrs; ?> 

Amount: <?php print @$this->num( $this->amount ); ?> Coins
    
</pre>
<?

	}

	if( isset( $this->sendmultisign ) ) {
		print '<pre>Send-Multi-Sign Result:<br />'; 
		print_r($this->sendmultisign); 		
		print '</pre>';
	}
		
?> 
<?php $this->template('footer'); ?>
