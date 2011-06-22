Bitcoin Webskin 

an open source PHP web interface to bitcoind

Copyright (c) 2011 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS

http://webskin.bitcoincommons.org/
https://github.com/zamgo/bitcoin-webskin

---------------------------------------------------------------------
Version 0.0.2 - Prototype release

This is an early release of Bitcoin Webskin.  

This is development software. 
This software has many bugs, security holes, and missing functionality. 
This software is NOT ready for production use.
But it is ready for testnet use!

---------------------------------------------------------------------
Quicky Install Instructions:

- Download latest files from 
  https://github.com/zamgo/bitcoin-webskin

- put the files in a web-accessible directory

- copy config.sample.php to config.php, 
  and fill in correct info for your system

- setup bitcoind to allow access.  Sync your user/pass/host settings 
  of bitcoin.conf file and bitcoin-webskin/config.php

- run bitcoind

- load the top level index.php file in your browser


Files:

/index.php
/config.php
/license.txt 
/readme.txt
/libs/bitcoin-webskin.php - the main controller
/libs/bitcoin-interface.php - interface definition for bitcoind methods
/plugins/jsonRPCClient.php - json RPC client with webskin interface
/plugins/test.php - the debug interface
/plugins/mtgox.php - plugin to mtgox json public api
/skins/simple/*.php	- the simple html skin


---------------------------------------------------------------------
Making a new skin:

- copy the full /skins/simple/ directory to /skins/YOUR.NEW.SKIN/
- edit /libs/bitcoin-webskin.php, __construct() function, 
- change $this->skin = 'simple';  to $this->skin = 'YOUR.NEW.SKIN';
- edit the template PHP files in /skins/YOUR.NEW.SKIN/ 
  for your desired design

---------------------------------------------------------------------
Making a new bitcoin interface:

- create new php class in /plugins/ that implements the 
  Bitcoin interface (see /libs/bitcoin-interface.php)
- edit /libs/bitcoin-webskin.php, open_wallet() function, replace:
		include_once('plugins/jsonRPCClient.php');
		$this->wallet = new jsonRPCClientControler;
  with an include of your new interface file, and set $this->wallet.


---------------------------------------------------------------------
Donating to this project:

- bitcoin: 14STzHS8qjsDPtqpQgcnwWpTaSHadgEewS

  and/or 

- namecoin: NAGPRdQtxPazbjxK9KGe143fwsP1axQxDC

