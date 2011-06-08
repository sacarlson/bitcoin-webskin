<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>
<pre><a href="https://mtgox.com" target="mtgox">MtGox</a>   <a 
href="./?a=mtgox">Ticker</a>   <a 
href="./?a=mtgox&a1=depth">Depth Chart</a>   <a 
href="./?a=mtgox&a1=trades">Recent Trades</a>   <a 
href="./?a=mtgox&a1=calc">Calculator</a> 
 
Last:<b><?php print $this->info['mtgox_ticker']->ticker->last; 
?></b>  Buy:<?php print $this->info['mtgox_ticker']->ticker->buy; 
?>  Sell:<?php print $this->info['mtgox_ticker']->ticker->sell; 
?>  High:<?php print $this->info['mtgox_ticker']->ticker->high; 
?>  Low:<?php print $this->info['mtgox_ticker']->ticker->low; 
?>  Volume:<?php print $this->info['mtgox_ticker']->ticker->vol; ?>  
 
<?php




if( isset($this->info['mtgox_depth']) ) { ?>Market Depth 
<table border="0" cellpadding="5" cellspacing="0">
 <tr>
   <td valign="top"><textarea rows="20" cols="30">Ask   Price      Amount 
<?php 
	while( list(,$x) = each( $this->info['mtgox_depth']->asks ) ) {
		list($price,$amount) = $x;
		$price  = str_pad( number_format($price ,4), 8, ' ', STR_PAD_LEFT);
		$amount = str_pad( number_format($amount,4), 10, ' ', STR_PAD_LEFT);
		print "Ask $price $amount\n";
	}
?></textarea></td>
  <td valign="top"><textarea rows="20" cols="30">Bid   Price      Amount 
<?php 
	while( list(,$x) = each( $this->info['mtgox_depth']->bids ) ) {
		list($price,$amount) = $x;
		$price  = str_pad( number_format($price ,4), 8, ' ', STR_PAD_LEFT);
		$amount = str_pad( number_format($amount,4), 10, ' ', STR_PAD_LEFT);
		print "Bid $price $amount\n";
	}
?></textarea></td>
 </tr>
</table>
<?php
} // end depth
	
	
	

	
	
	
if( isset($this->info['mtgox_trades']) ) { 

?><textarea rows="20" cols="66">  MtGox Recent Trades 
  Price      Amount  Date                             Tid 
<?php 
	while( list(,$x) = each( $this->info['mtgox_trades'] ) ) {
		$x->price  = str_pad( number_format($x->price ,4), 8, ' ', STR_PAD_LEFT);
		$x->amount = str_pad( number_format($x->amount,4), 10, ' ', STR_PAD_LEFT);
		$x->date = date('r', $x->date);
		print "$x->price $x->amount  $x->date  $x->tid\n";
	}


} // end trades
?></textarea><?



if( isset($_GET['a1']) && $_GET['a1'] == 'calc' ) {

	$mtgox_fee = 0.0065;

	isset($_GET['buy_btc']) && is_numeric($_GET['buy_btc']) 
		? $buy_btc = number_format($_GET['buy_btc'], 4)
		: $buy_btc = number_format(1,4);
	isset($_GET['sell_btc']) && is_numeric($_GET['sell_btc']) 
		? $sell_btc = number_format($_GET['sell_btc'],4) 
		: $sell_btc = number_format(1,4);
	isset($_GET['buy_usd']) && is_numeric($_GET['buy_usd']) 
		? $buy_usd = number_format($_GET['buy_usd'],4)  
		: $buy_usd = number_format($this->info['mtgox_ticker']->ticker->last,4);
	isset($_GET['sell_usd']) && is_numeric($_GET['sell_usd']) 
		? $sell_usd = number_format($_GET['sell_usd'],4) 
		: $sell_usd = number_format($this->info['mtgox_ticker']->ticker->last,4);
	
	$total_usd_income = $total_usd_cost = $total_btc_income = $total_btc_cost = 0;
	
	?><form><input type="hidden" name="a" value="mtgox"><input type="hidden" name="a1" value="calc">Calculator:

 Buy <input name="buy_btc" type="text" size="6" value="<?php print $buy_btc; ?>"> BTC @ <input 
 name="sell_usd" type="text" size="6" value="<?php print $sell_usd; ?>"> USD per with <?php print ($mtgox_fee * 100); ?> % BTC fee

Sell <input name="sell_btc" type="text" size="6" value="<?php print $sell_btc?>"> BTC @ <input 
name="buy_usd" type="text" size="6" value="<?php print $buy_usd; ?>"> USD per with <?php print ($mtgox_fee * 100); ?> % USD fee

<input type="submit" value="         Calculate          "> 
<?

	if(    isset($_GET['buy_btc']) && is_numeric($_GET['buy_btc']) 
		&& isset($_GET['sell_usd']) && is_numeric($_GET['sell_usd']) ) {
		$total_usd_cost = number_format($buy_btc * $sell_usd,4);
		$fee = number_format($buy_btc*$mtgox_fee,4);
		$total_btc_income = number_format($buy_btc - $fee,4);
		print "\nBuy $buy_btc BTC @ $sell_usd USD per Bitcoin costs $total_usd_cost USD\n";
		print "Get $total_btc_income BTC after " . ($mtgox_fee * 100) . " % fee of $fee BTC\n";

	}

	if(    isset($_GET['sell_btc']) && is_numeric($_GET['sell_btc']) 
		&& isset($_GET['buy_usd']) && is_numeric($_GET['buy_usd']) ) {
		$total_btc_cost = number_format($sell_btc,4);
		$sub_usd_income = number_format( $sell_btc * $buy_usd,4);
		$fee = number_format($sub_usd_income * $mtgox_fee,4);		
		$total_usd_income = number_format($sub_usd_income - $fee,4);
		print "\nSell $sell_btc BTC @ $buy_usd USD per Bitcoin earns $sub_usd_income USD\n";
		print "        After " . ($mtgox_fee * 100) . " % fee of $fee USD, receive $total_usd_income USD\n";
	}
	
	if( isset($_GET['buy_btc']) || isset($_GET['sell_btc']) ) {
		print "\nP/L: " . number_format($total_usd_income - $total_usd_cost,4) . " USD\n"
		. "P/L: " . number_format($total_btc_income - $total_btc_cost,4) . " BTC\n";
	}
	
} // end calc

?></pre></form>
<?php $this->template('footer'); ?>

