<?php
/*
	Bitcoin Webskin - an open source PHP web interface to bitcoind
	Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS
*/
?><?php $this->template('header'); ?>

<p>
<a href="#accounts">accounts</a> |
<a href="#transactions">transactions</a> |
<a href="#addresses">addresses</a> |
<a href="#sending">sending</a> |
<a href="#server">server</a> |
<a href="#namecoin">namecoin</a> |
<a href="#webskin">webskin</a> 
</p>	

<p>
Tests:
<br /><a href="./?a=listtransactions">List All Transactions</a>
<br /><a href="./?a=getinfo">Get Info</a>
<br /><a href="./?a=mtgox">MtGox market data</a>
<br /><a href="./?a=server.control">Server Control</a>
</p>

<hr /><a name="accounts">Accounts</a>

<form action="./" method="GET"><input type="hidden" name="a" value="listaccounts">
<input type="submit" value="listaccounts"> 
	minconf:<input type="text" name="minconf" value="1" size="3">
</form>

<form action="./" method="GET"><input type="hidden" name="a" value="listreceivedbyaccount">
<input type="submit" value="listreceivedbyaccount"> 
	minconf:<input type="text" name="minconf" value="1" size="3">
	includeempty:<select name="includeempty"><option value="true">true</option><option value="false">false</option></select>
</form>
	
<form action="./" method="GET"><input type="hidden" name="a" value="getaccountaddress">
<input type="submit" value="getaccountaddress"> 
	account:<input type="text" name="account" value='test' size="20">
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="getaddressesbyaccount">
<input type="submit" value="getaddressesbyaccount"> 
	account:<input type="text" name="account" value='test' size="20">
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="getreceivedbyaccount">
<input type="submit" value="getreceivedbyaccount"> 
	account:<input type="text" name="account" value='test' size="20">
	minconf:<input type="text" name="minconf" value="1" size="3">
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="getbalance">
<input type="submit" value="getbalance"> 
	account:<input type="text" name="account" value='*' size="20">
	minconf:<input type="text" name="minconf" value="1" size="3">
</form>	
	
<hr /><a name="transactions">Transactions</a>

<form action="./" method="GET"><input type="hidden" name="a" value="listtransactions">
<input type="submit" value="listtransactions"> 
	account:<input type="text" name="account" value="*" size="20">
	count:<input type="text" name="count" value="-1" size="3">
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="gettransaction">
<input type="submit" value="gettransaction"> 
	txid:<input type="text" name="txid" value="" size="68">
</form>	


<hr /><a name="addresses">Addresses</a>

<form action="./" method="GET"><input type="hidden" name="a" value="listreceivedbyaddress">
<input type="submit" value="listreceivedbyaddress"> 
	minconf:<input type="text" name="minconf" value="1" size="3">
	includeempty:<select name="includeempty"><option value="true">true</option><option value="false">false</option></select>
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="getnewaddress">
<input type="submit" value="getnewaddress"> 
	account:<input type="text" name="account" value="" size="20">
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="getreceivedbyaddress">
<input type="submit" value="getreceivedbyaddress"> 
	address:<input type="text" name="address" value="" size="40">
	minconf:<input type="text" name="minconf" value="1" size="3">	
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="getaccount">
<input type="submit" value="getaccount"> 
	address:<input type="text" name="address" value="" size="40">
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="setaccount">
<input type="submit" value="setaccount"> 
	address:<input type="text" name="address" value="" size="40">
	account:<input type="text" name="account" value="" size="20">	
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="validateaddress">
<input type="submit" value="validateaddress"> 
	address:<input type="text" name="address" value="" size="40">
</form>	

<hr /><a name="sending">Sending</a>

<form action="./" method="GET"><input type="hidden" name="a" value="sendtoaddress">
<input type="submit" value="sendtoaddress"> 
	address:<input type="text" name="address" value="" size="40">
	amount:<input type="text" name="amount" value="" size="20">
<br />	comment:<input type="text" name="comment" value="" size="20">
	comment_to:<input type="text" name="comment_to" value="" size="20">
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="sendfrom">
<input type="submit" value="sendfrom"> 
	from account:<input type="text" name="account" value="" size="20">
	to address:<input type="text" name="address" value="" size="40">
	amount:<input type="text" name="amount" value="" size="20">
	minconf:<input type="text" name="minconf" value="1" size="3">
<br />	comment:<input type="text" name="comment" value="" size="20">
	comment_to:<input type="text" name="comment_to" value="" size="20">
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="sendmany">
<input type="submit" value="sendmany"> 
	from account:<input type="text" name="account" value="" size="20">
	to many:<input type="text" name="tomany" value="" size="60">
<br />	minconf:<input type="text" name="minconf" value="1" size="3">
	comment:<input type="text" name="comment" value="" size="20">
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="move">
<input type="submit" value="move"> 
	from account:<input type="text" name="fromaccount" value="" size="20">
	to account:<input type="text" name="toaccount" value="" size="20">
	amount:<input type="text" name="amount" value="" size="20">
<br />	minconf:<input type="text" name="minconf" value="1" size="3">
	comment:<input type="text" name="comment" value="" size="20">
</form>	

<hr /><a name="server">Server</a>

<p><a href="./?a=getinfo">getinfo</a></p>

<p>
<a href="./?a=getblockcount">getblockcount</a>
<a href="./?a=getblocknumber">getblocknumber</a>
<a href="./?a=getconnectioncount">getconnectioncount</a>
<a href="./?a=getdifficulty">getdifficulty</a>
<a href="./?a=getgenerate">getgenerate</a>
<a href="./?a=gethashespersec">gethashespersec</a>
</p>


<form action="./" method="GET"><input type="hidden" name="a" value="getwork">
<input type="submit" value="getwork"> 
	data:<input type="text" name="data" value="" size="70">
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="backupwallet">
<input type="submit" value="backupwallet"> 
	destination:<input type="text" name="destination" value="" size="70">
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="setgenerate">
<input type="submit" value="setgenerate"> 
	generate:<select name="generate"><option value="true">true</option><option value="false">false</option></select>
	genproclimit:<input type="text" name="genproclimit" value="-1" size="10">
</form>	

<form action="./" method="GET"><input type="hidden" name="a" value="help">
<input type="submit" value="help"> 
	command:<input type="text" name="command" value="" size="10">
</form>	

<a href="./?a=stop">stop</a>


<hr /><a name="namecoin">Namecoin</a>
<form action="./" method="GET">
<input type="hidden" name="a" value="name_list"><input type="submit" value="name_list">
	name:<input type="text" name="name" value="" size="40">
</form>	

<form action="./" method="GET">
<input type="hidden" name="a" value="name_scan"><input type="submit" value="name_scan">
	start_name:<input type="text" name="name" value="" size="40">
	max_returned:<input type="text" name="max_returned" value="100" size="5">

</form>	

<form action="./" method="GET">
<input type="hidden" name="a" value="name_new"><input type="submit" value="name_new">
	name:<input type="text" name="name" value="" size="40">
</form>	

<form action="./" method="GET">
<input type="hidden" name="a" value="name_firstupdate"><input type="submit" value="name_firstupdate">
	name:<input type="text" name="name" value="" size="40">
	rand:<input type="text" name="rand" value="" size="40">
	tx:<input type="text" name="tx" value="" size="40">		
	value:<input type="text" name="value" value="" size="40">		
</form>	
	
<form action="./" method="GET">
<input type="hidden" name="a" value="name_update"><input type="submit" value="name_update">
	name:<input type="text" name="name" value="" size="40">
	value:<input type="text" name="value" value="" size="40">	
	to address:<input type="text" name="address" value="" size="40">
</form>	

<a href="./?a=name_clean">name_clean</a>

	
<form action="./" method="GET">
<input type="hidden" name="a" value="deletetransaction"><input type="submit" value="deletetransaction">
	txid:<input type="text" name="txid" value="" size="68">
</form>	



<hr /><a name="webskin">Webskin</a>

<a href="./?a=start">start</a>
<a href="./?a=getprocess">getprocess</a>
<a href="./?a=kill">kill</a>
	
	
	
<p>
<a href="#accounts">accounts</a> |
<a href="#transactions">transactions</a> |
<a href="#addresses">addresses</a> |
<a href="#sending">sending</a> |
<a href="#server">server</a> |
<a href="#namecoin">namecoin</a> |
<a href="#webskin">webskin</a> 
</p>	
<?php $this->template('footer'); ?>