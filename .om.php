<!doctype html>
<html>
<head>
<?
// Support two IP interfaces
// 	- https://github.com/ok1hra/IC-705_Interface
//	- https://github.com/ok1hra/k3ng_cw_keyer
//
// CONFIGURE ------------------------------------------------------------------
// my ($mylat, $mylon) = (50.10, -14.40);  <--- PLEASE SET IN dxcc.pl
$locator   = 'JO60WA';		// QTH for 2m and up sending MSG
$IP1        = '192.168.1.52';	// CAT/UDP TRX interface - find IP with 'ping ic705.local'
$trx1name   = 'IC-705';
$IP2        = '192.168.1.44';	// CAT/UDP TRX interface
$trx2name   = 'TS-480';
$IP3        = '192.168.1.44';	// CAT/UDP TRX interface
$trx3name   = 'IC-746';

// default
$cwcliport  = '89';		// UDP port for CW message
$fskport    = '89';		// UDP port for RTTY message
$catport    = '81';		// http port for get ferquency/mode
$catcmdport = '90';		// UDP command trasfer to cat | FE FE A4 E0 <command> FD
$CAT        = '1';		// 1 = http CAT (default), 0 = hamlib (obsolete)
//-----------------------------------------------------------------------------

$REV = '2025-12-14';
$rigip     = '127.0.0.1';	// (obsolete) TRX IP - hamlib(rigctld) / OpenInterface3
$path = '';
$log = $_GET['log'];
$logpath = 'log/'.$log ;
$call = $_GET['call'];
$exch = $_GET['exch'];
$trx = $_GET['trx'];
$nr = isset($_GET['nr']) ? $_GET['nr'] : '0';	// <-- manual QSO number decrease


global $preset2;
?>
<title>ॐ  | <? echo $log.'-'.$call.' | '.$REV ?></title>

<!---------------------------------------------------

  Óm - very simple contest log

  see http://remoteqth.com/wiki/index.php?page=PHP+contest+Log

	Changelog
	2025-12 - fix autofocus
	2025-02 - manual QSO number decrease (start at 001 in exist log) via ?nr=xx in url
	2024-11 - Three button for switch between three TRX
	2024-01 - Add FM mode, add two TRX switch, TRX name and log it
	2023-12 - Clear RIT, add FSK mode (support IC705), fix configure
	2023-09 - add RTTYR mode, add CAT support for OpenInterface3
	2022-02 - occupant detector
	2021-11 - maidenhead QTH locators support by https://fkurz.net/ham/stuff.html?maidenhead
	2020-11 - first change for UHF
	2017-11 - show no QSO if check blank in SP mode
			- add reverse CW (CWR)
	2016-03 - fix show previous qso in SSB mode
	2016-01 - add FSK mode
	2015-11 - after press 'nr?' exchange do not clear
			- change wpm and tune don't clear input value
			- move '*?' button after call input field for use with Tab key
			- '*?' also check partial calls (grep)
			- redesigned
	2015-10 - disable autofill input forms
	2015-08 - new frequency cache - if hmlib short fail
	Todo
	- implement QSOMapper https://github.com/0150r/QSOMapper
	- in S&P mode after enter check, if call woked in same band (freq before dot - 14.)
	- button for change vfo between two icom trx

	INSTALL # Install apache web server with PHP support on Linux
			sudo apt install apache2 git
			sudo apt install php libapache2-mod-php php-mysql
			sudo sed -i "s/short_open_tag = Off/short_open_tag = On/g" /etc/php/$(php -r 'echo PHP_MAJOR_VERSION.".".PHP_MINOR_VERSION;')/apache2/php.ini
			sudo systemctl reload apache2
		# Setting access rights
			sudo mkdir /var/www/html/om/
			sudo chmod 774 /var/www/html/om
			sudo chown $USER:www-data /var/www/html/om
		# Download
			cd /var/www/html
			git clone https://github.com/ok1hra/om.git
		# Delete ok1hra logs | Hey Dan, don't do it ;)
			sudo rm /var/www/html/om/contest-table
			sudo rm -r /var/www/html/om/log/
		# Create and set log directory
			mkdir /var/www/html/om/log
			sudo chown -R $USER:www-data /var/www/html/om/
			chmod -R ugo=rw,ugo+X,o-w /var/www/html/om/

	RUN	configure IP IC-705/OpenInterface CAT interface in .om/php
		open url http://127.0.0.1/om/.tab.php

	-----------------
	OBSOLETE (hamlib)
		sudo apt install libhamlib-utils
		// ts480
		/usr/bin/rigctld -m 228 -r /dev/ttyUSB.cat -s 9600 &
		// ic746
		/usr/bin/rigctld -m 323 -r /dev/ttyUSB.cat -s 9600 &
		
		#rigctl -m 2 -r 192.168.11.80
		#/usr/bin/rigctld -m 228 -r /dev/ttyUSB.cat -s 9600

---------------------------------------------->

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
	body {
		font-family: 'Roboto Condensed',sans-serif,Arial,Tahoma,Verdana;
		background: #ccc;
	}
	#obsah0 {
		position: absolute;
		top: 0px;
		left: 0px;
		bottom: 0px;
		right: 0px;
		height: 40px;
		width: expression(document.body.clientWidth - 150);
		background: #444;
		overflow-y: hidden;
		padding: 10px 0 0 10px;
	}
	#obsah1 {
		position: absolute;
		top: 40px;
		left: 0px;
		bottom: 0px;
		right: 0px;
		height: 100px;
		width: expression(document.body.clientWidth - 150);
		background: #ccc;
		overflow-y: hidden;
		padding: 10px 0 0 10px;
	}
	#obsah2 {
		position: absolute;
		top: 140px;
		left: 0px;
		bottom: 0px;
		right: 0px;
		height: expression(document.body.clientHeight - 120);
		width: expression(document.body.clientWidth - 150);
		background: #444;
		color: #ccc;
		overflow: auto;
		padding: 0 0 0 10px;
	}
	a.switch:link  {
		color : #ccc;
		background-color: #888;
		font-weight : bold;
		text-decoration : none;
		border-radius: 5px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
   		margin-left: 10px;
   	}
	a.switch:visited  {
		color : #ccc;
		background-color: #888;
		font-weight : bold;
		text-decoration : none;
		border-radius: 5px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		}
	a.switch:hover  {
		color : #fff;
		background-color: #080;
		font-weight : bold;
		text-decoration : none;
		border-radius: 5px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		}
	a.switch:after{
		content: "\00a0";
	}
	a.switch:before{
		content: "\00a0";
	}
	a:hover span {
		display: none;
	}
	a:hover span.onhover {
		display: inline;
	}
	a span {
		display: inline;
	}
	a span.onhover {
		display: none;
	}
	.check  {
		color : #c00;
	}
	.checkg  {
		color : #080;
	}
	.gray  {
		color : #888;
		font-weight:bold;
	}
	.red  {
		color : #d00;
		font-weight:bold;
	}
	input.wpm {
	    border: 0px solid #333;
	    background: #ccc;
	    margin: 0 5px 0 0;
	    -webkit-border-radius: 5px;
	    -moz-border-radius: 5px;
	    border-radius: 5px;
	    color : #333;
	}
	input.wpm:hover {
	    border: 0px solid #080;
	    background: #080;
	    color : #fff;
	}

	input[type=text] {
	    border: 2px solid #333;
	    padding: 5px 8px 4px 8px;
	    background: #333;
	    margin: 0 0 0px 5px;
	    -webkit-border-radius: 7px 0 0 7px;
	    -moz-border-radius: 7px 0 0 7px;
	    border-radius: 7px 0 0 7px;
	    font-size: 125%;
		font-weight: bold;
		letter-spacing: 1px;
	    color : #ccc;
	}
	input.qso {
	    border-top: 2px solid #333;
	    border-bottom: 2px solid #333;
	    border-right: 2px solid #333;
	    border-left: 0px solid #333;
	    padding: 5px 10px 5px 10px;
	    background: #ccc;
	    margin: 0 5px 0 -2px;
	    -webkit-border-radius: 0 7px 7px 0;
	    -moz-border-radius: 0 7px 7px 0;
	    border-radius: 0 7px 7px 0;
	    font-size: 125%;
	        font-weight: 100;
		letter-spacing: 1px;
	    color : #333;
	}
	input[type=text]:focus {
	    background: #080;
	    border: 2px solid #080;
	}
	input.qso:focus {
	    border-top: 4px solid #080;
	    border-bottom: 4px solid #080;
	    border-right: 4px solid #080;
	    border-left: 0px solid #080;
	    padding: 3px 8px 3px 8px;
	    color : #080;
	}
	</style>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,700,300&subset=latin-ext' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="mobile-web-app-capable" content="yes">
</head>
<body>
<div id="obsah0">
<?
// test HW naplni gobalni proennou $hw
function gethw() {
	global $hw;
//	$cpux = file('/proc/cpuinfo'); $cpu = $cpux[0];
//	$pi = substr('Processor	: ARMv6-compatible processor rev 7 (v6l)', 12, 5) ;
	$cpu = php_uname('m');
	$cpu2 = substr(exec('grep Geode /proc/cpuinfo'), 13, 5);
//	if ( substr($cpu, 12, 5) == $pi ) {
	if ( $cpu == 'armv6l' || $cpu == 'armv7l' ) {
		$hw = "PI";
	}
	elseif ( $cpu2 == 'Geode' ) {
		$hw = 'ALIX';
	}
#	Linux remoteqth 3.8.13-bone47 #1 SMP Fri Apr 11 01:36:09 UTC 2014 armv7l
	elseif ( preg_match("/bone(..)/",php_uname(''),$BBB) ) {
		$hw = 'BBB';
		//echo $BBB[0];
	}else {
		$hw = php_uname();
	}
}

// RPI board revision
function rpirev() {
	// HEX
	//$text = file('/proc/cmdline');
	//preg_match("/.boardrev=(....)/",$text[0],$matches);
	//return rtrim($matches[1]);
	// DEC
	$dec = file('/sys/module/bcm2708/parameters/boardrev');
	return trim($dec[0]);
}
function rpi2rev() {
	// nahrada grep
	$cpuinfo = file_get_contents ('/proc/cpuinfo');   // vypis filesystemu do promenne
	$findme   = 'Revision';                           // hledany retezec
	$pos = strpos($cpuinfo, $findme);                 // pozice hledaneho retezce v promenne
	$next = strpos($cpuinfo, 'Serial');               // pozice nasledujiciho retezce (radku)
	$long= $next-$pos-11;                             // rozdil pozic = delka hledaneho retezce
	$revision = trim (substr($cpuinfo, $pos+11, $long));          // hledana promenna je za hledanym retezcem na pozici $pos+11, dlouha $long
	return $revision;
}


function availableUrl($host, $port, $timeout) {
  $fp = fSockOpen($host, $port, $errno, $errstr, $timeout);
  return $fp!=false;
}
//Return "true" if the url is available, false if not.
//echo availableUrl("www.google.com");


// precteni souboru
//function rxfile($file) {
//	global $path;
//	$valuex = file($path.$file);
//	return $valuex[0];
//}

// precteni souboru, pokud neexistuje, vytvorit
function rxfile($file) {
	global $path;
	if (file_exists($path.$file)) {
		if ( 0 == filesize( $path.$file ) ) {
		    // file is empty
		} else {
			$valuex = file($path.$file);
			return $valuex[0];
		}
	} else {
		file_put_contents($path.$file, '');
		$valuex = file($path.$file);
		//return $valuex[0];
	}
}

// precteni souboru, pokud neexistuje, vytvorit - bez $path
function rxfile2($file) {
	if (file_exists($file)) {
		if ( 0 == filesize( $file ) ) {
		    // file is empty
		} else {
			$valuex = file($file);
			return $valuex[0];
		}
	} else {
		file_put_contents($file, '');
		$valuex = file($file);
		//return $valuex[0];
	}
}

// zapsani souboru
function txfile($file, $values) {
	global $path;
	$fp = fopen($path.$file, 'w');
	fwrite($fp, $values);
	fclose($fp);
}
// zapsani souboru
function txfile2($file, $values) {
	$fp = fopen($file, 'w');
	fwrite($fp, $values);
	fclose($fp);
}

// txrxIP socket
function txrxtcp($IP, $port, $message) {
	if(!($sock = socket_create(AF_INET, SOCK_STREAM, 0)))
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		die("Couldn't create socket: [$errorcode] $errormsg \n");
	}
	//echo "Socket created \n";
	//Connect socket to remote server
	if(!socket_connect($sock , $IP , $port))
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		die("Could not connect: [$errorcode] $errormsg \n");
	}
	//echo "Connection established \n";
	//$message = "C\r";
	//Send the message to the server
	if( ! socket_send ( $sock , $message , strlen($message) , 0))
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		die("Could not send data: [$errorcode] $errormsg \n");
	}
	//echo "Message send successfully \n";
	//Now receive reply from server
	if(socket_recv ( $sock , $buf , 6 , MSG_WAITALL ) === FALSE)
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		die("Could not receive data: [$errorcode] $errormsg \n");
	}
	//print the received message
	socket_close($sock);
	return $buf;
}

// txIP socket
function txtcp($IP, $port, $message) {
	if(!($sock = socket_create(AF_INET, SOCK_STREAM, 0)))
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		die("Couldn't create socket: [$errorcode] $errormsg \n");
	}
	//echo "Socket created \n";
	//Connect socket to remote server
	if(!socket_connect($sock , $IP , $port))
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		die("Could not connect: [$errorcode] $errormsg \n");
	}
	//echo "Connection established \n";
	//$message = "M$rotate\r";
	//Send the message to the server
	if( ! socket_send ( $sock , $message , strlen($message) , 0))
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		die("Could not send data: [$errorcode] $errormsg \n");
	}
	//echo "Message send successfully \n";
	socket_close($sock);
}

// txUDP socket
// x=IP y=port z=message
function udpsocket($x, $y, $z)
{
	// SOCK_STREAM = full-duplex, connection-based byte streams
	// SOCK_DGRAM = UDP datagrams
	if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		die("Couldn't create socket: [$errorcode] $errormsg \n");
	}
	//echo "Socket created \n";
	//Connect socket to remote server
	if(!socket_connect($sock , $x , $y))
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		die("Could not connect: [$errorcode] $errormsg \n");
	}
	//echo "Connection established \n";
	//$message = "$cwmem\r";
	//Send the message to the server
	if( ! socket_send ( $sock , $z , strlen($z) , 0))
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		die("Could not send data: [$errorcode] $errormsg \n");
	}
	//echo "Message send successfully \n";
	socket_close($sock);
return true;
}

// actual page file
function actualpage() {
	$currentFile = $_SERVER["PHP_SELF"];
	$parts = Explode('/', $currentFile);
	return $parts[count($parts) - 1];
}

// disk space bar
function diskspace($cesta) {
	global $df, $dp, $du ;
	/* get disk space free (in bytes) */
	$df = disk_free_space("$cesta");
	/* and get disk space total (in bytes)  */
	$dt = disk_total_space("$cesta");
	/* now we calculate the disk space used (in bytes) */
	$du = $dt - $df;
	/* percentage of disk used - this will be used to also set the width % of the progress bar */
	$dp = sprintf('%.2f',($du / $dt) * 100);

	/* and we formate the size from bytes to MB, GB, etc. */
	$df = formatSize($df);
	$du = formatSize($du);
	$dt = formatSize($dt);
}
function formatSize( $bytes ) {
	$types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
	for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
		return( round( $bytes, 1 ) . " " . $types[$i] );
}

function temp($temp, $hw) {
	if ( $hw == "PI" ) {
		$i2cbus = rxfile('../cfg/rpii2cbus');
	}elseif ( $hw == "BBB" ) {
		$i2cbus = rxfile('../cfg/bbbi2cbus');
	}else {
	}
	$adress = rxfile("s-sensors-temp{$temp}");
	// rawdata z cidla
	$dataraw = exec("sudo i2cget -y $i2cbus 0x$adress 0x00 w");
	// prevod dvou bajtu na dekadicke
	$data = hexdec(substr($dataraw,4,2)) ;
	// bajt s hodnotou 0.5 stupne
	$half = substr($dataraw,2,1);
	if ($half > 1 ) { // pokud je vetsi, pricist
		$data= (0.5+$data);
	}
	if ($data > 128 ) { //detekce zaporneho bitu
		$data= (256-$data)*-1;
	}
	return $data;
}

// GET URL with password
function rxurlpass($ip, $file, $usr, $pass) {
	$url='http://'.$ip.'/'.$file;
	$opts = array('http' =>
	  array(
	    'method'  => 'POST',
	    'header'  => "Content-Type: text/xml\r\n".
	      "Authorization: Basic ".base64_encode("$usr:$pass")."\r\n",
	    'content' => $url, //$body
	    'timeout' => 60
	  )
	);
	$context  = stream_context_create($opts);
	$result = file_get_contents($url, false, $context, -1, 40000);
	return $result;
}

function qso($file) {
	$lines = count(file($file))-(int)$nr ;
	return $lines;
}

//require 'function.php';
// txIP socket
function mode($ip) {
	global $style, $CAT, $IP, $catport;
	if ($CAT == '0') { // hamlib
		// $mode = 'CW'; //exec("rigctl -m 2 -r $ip m | head -n1");
		$mode = exec("/usr/bin/rigctl -m 2 -r $ip m | head -n1");
		if ($mode == 'CW' || $mode == 'CWR' || $mode == 'SSB' || $mode == 'FM'  || $mode == 'LSB' || $mode == 'USB' || $mode == 'FSK'  || $mode == 'RTTY' || $mode == 'RTTYR') { // mode OK
			$style = 'gray';
			txfile('/tmp/mode', $mode);  // save last mode
		}else{ // rig OFF
			$style = 'red';
			$mode = rxfile('/tmp/mode'); // use saved mode
		}
		//echo var_dump($mode)."<br>"; 
		return $mode;
	}elseif ($CAT == '1') { // http
		$url = 'http://'.$IP.':'.$catport ;
		//$url = 'http://'.$IP.':81' ;
		//$url = 'http://' . $IP . ':' . $catport ;
		$data = file_get_contents($url);
		if ($data !== false) {
			$field = explode("|", $data);
			$mode = $field[1];
			txfile('/tmp/mode', $mode);  // save last mode
			$style = 'gray';
		} else {
//			$style = 'red';
//			$mode = rxfile('/tmp/mode'); // use saved mode
		}
		return $mode;
	}
}
function freq($ip) {
	global $CAT, $IP, $catport;
	if ($CAT == '0') { // hamlib
		// $hz = exec("rigctl -m 2 -r $ip f");
		$mhz = exec("/usr/bin/rigctl -m 2 -r $ip f");
		if ($mhz == 0) { // rig OFF
			$mhz = rxfile('/tmp/freq');  // use saved freq
		}else{
			// $mhz = $hz/1000000;
			txfile('/tmp/freq', $mhz); // save last freq
		}
		// return round($mhz, 3);
		//echo var_dump($mhz)."<br>"; 
		return $mhz;
	}elseif ($CAT == '1') { // http
		$url = 'http://'.$IP.':'.$catport ;		// 14005000|RTTY|
		$data = file_get_contents($url);
		if ($data !== false) {
			$field = explode("|", $data);
			$mhz = $field[0];
			txfile('/tmp/freq', $mhz); // save last freq
		} else {
//			$mhz = rxfile('/tmp/freq');  // use saved freq
		}
		return $mhz;
	}

}

function GetDxcc($callsign) {
	$result = exec("/usr/bin/perl ./dxcc.pl $callsign");
	return $result;
}

function rst($mode) {
	if ($mode == 'CW' || $mode == 'CWR' || $mode == 'FSK'  || $mode == 'RTTY' || $mode == 'RTTYR'){
		$rst='599';
	}elseif ($mode == 'SSB' || $mode == 'USB' || $mode == 'LSB' || $mode == 'FM' ){
		$rst='59';
	}
	return $rst;
}
function setrit($ip, $hz) {
	global $CAT, $catcmdport, $IP;
	if ($CAT == '0') { // hamlib
		$hz = exec("/usr/bin/rigctl -m 2 -r $ip J $hz");
	}
	if ($CAT == '1') { // UDP cat
		$hexString = "\x21\x00\x00\x00\x00";	// clear RIT
		udpsocket($IP, $catcmdport, $hexString );
	}
}
function qsonr($log) {
	if (file_exists($log)) {
		$qsonrs = 0 ;
		$handle = fopen($log, "r");  // number lines in log = qso nr
		while(!feof($handle)){
			$line = fgets($handle);
			$qsonrs++;
		}
		fclose($handle);
		$qsonrs = $qsonrs - (int)$nr;
		return $qsonrs;
	} else {                              // if log dont exist, create
		file_put_contents($log, '');
		$valuex = file($log);
	}
}
function port() {
	global $cwcliport, $fskport, $mode;
	if ($mode == 'FSK' || $mode == 'RTTY' || $mode == 'RTTYR'){
		return $fskport;
	} else {
		return $cwcliport;
	}
}

/* 
 * PHP code snippet to calculate the distance and bearing between two
 * maidenhead QTH locators. 
 * Written by Fabian Kurz, DJ1YFK; losely based on wwl+db by VA3DB.
 * You can do whatever you want with this code.
 * Example usage: Distance and heading from JO60LK to JO61UA:
 * $bd = bearing_dist("JO60LK", "JO61UA");
 * echo "$bd[km]km, $bd[deg]deg";
 */

function valid_locator ($loc) {
	if (preg_match("/^[A-R]{2}[0-9]{2}[A-X]{2}$/", $loc)) {
		return 1;
	}
	else {
		return 0;
	}
}

function loc_to_latlon ($loc) {
	/* lat */
	$l[0] = 
	(ord(substr($loc, 1, 1))-65) * 10 - 90 +
	(ord(substr($loc, 3, 1))-48) +
	(ord(substr($loc, 5, 1))-65) / 24 + 1/48;
	$l[0] = deg_to_rad($l[0]);
	/* lon */
	$l[1] = 
	(ord(substr($loc, 0, 1))-65) * 20 - 180 +
	(ord(substr($loc, 2, 1))-48) * 2 +
	(ord(substr($loc, 4, 1))-65) / 12 + 1/24;
	$l[1] = deg_to_rad($l[1]);

	return $l;
}

function deg_to_rad ($deg) {
	return (M_PI * $deg/180);
}

function rad_to_deg ($rad) {
	return (($rad/M_PI) * 180);
}

function bearing_dist($loc1, $loc2) {

	if (!valid_locator($loc1) || !valid_locator($loc2)) {
		return 0;
	}
		
	$l1 = loc_to_latlon($loc1);
	$l2 = loc_to_latlon($loc2);

	$co = cos($l1[1] - $l2[1]) * cos($l1[0]) * cos($l2[0]) +
			sin($l1[0]) * sin($l2[0]);
	$ca = atan2(sqrt(1 - $co*$co), $co);
	$az = atan2(sin($l2[1] - $l1[1]) * cos($l1[0]) * cos($l2[0]),
				sin($l2[0]) - sin($l1[0]) * cos($ca));

	if ($az < 0) {
		$az += 2 * M_PI;
	}

	$ret['km'] = round(6371*$ca);
	$ret['deg'] = round(rad_to_deg($az));

	return $ret;
}

$conteststyle = $_GET['s'];
if (empty($conteststyle)){
	$conteststyle='run';
}
$trx = $_GET['trx'];
if (empty($trx)){
	$trx='1';
}
if ($trx == '1'){
	$IP=$IP1;
}
if ($trx == '2'){
	$IP=$IP2;
}
if ($trx == '3'){
	$IP=$IP3;
}

$mode= mode($rigip);
if ($mode == 'CW' || $mode == 'CWR' || $mode == 'SSB'  || $mode == 'LSB' || $mode == 'USB' || $mode == 'FM' || $mode == 'FSK'  || $mode == 'RTTY' || $mode == 'RTTYR') {
	$qsonrs = qsonr("$logpath.txt");
	date_default_timezone_set('UTC');
	$date = date('Y-m-d H:i ', time());
	$dateadif = date('Ymd', time());
	$timeadif = date('Hi', time());
	$show = '';
	?><form action="<?echo basename($_SERVER['PHP_SELF']).'?s='.$conteststyle.'&log='.$log.'&call='.$call.'&exch='.$exch.'&trx='.$trx.'&nr='.$nr ;?>" method="POST"><?     //form self url
	$callr = trim(strtoupper($_POST['callr']));     // trim whitespace and change to UPERCASE
	$qsonrr = trim(strtoupper($_POST['qsonrr']));

	/////////////////// RTTY MEMORY ////////////////////////////
	if ($mode == 'FSK' || $mode == 'RTTY' || $mode == 'RTTYR'){
		$CQ = "\r\n ".$call.' '.$call.' '.$call.' TEST ';
		if (strtoupper($exch) == 'NR'){
			$TXEXCH = "\r\n ".$callr.' '.$callr.' 599-'.$qsonrs.' 599-'.$qsonrs.' ';    // $cwtwxt = call in input form, $qsonrs = QSO nr
			$TXEXCHSP = "\r\n ".$callr.' '.$callr.' 599-'.$qsonrs.' 599-'.$qsonrs.' ';
			$TXEXCHSP2 = "\r\n ".$callr.' '.$callr.' 599-'.($qsonrs-1).' 599-'.($qsonrs-1).' ';     // Exchange previous QSO
		}else{
			$TXEXCH = "\r\n ".$callr.' '.$callr.' 599-'.$exch.'-'.$exch.' ';
			$TXEXCHSP = "\r\n ".$callr.' '.$callr.' 599-'.$exch.'-'.$exch.' ';
			$TXEXCHSP2 = "\r\n ".$callr.' '.$callr.' 599-'.$exch.'-'.$exch.' ';
		}
		$TU = ' '.$callr.' tu '.$call.' ';
	/////////////////// CW MEMORY ////////////////////////////
	}else{
		$CQ = $call.' '.$call.' TEST';
		if (strtoupper($exch) == 'NR'){
			if (freq($rigip) > 140000000){
				$TXEXCH = $callr.' 5nn '.str_pad($qsonrs, 3, "T", STR_PAD_LEFT).' '.$locator;    // $cwtwxt = call in input form, $qsonrs = QSO nr
				$TXEXCHSP = '5nn '.str_pad($qsonrs, 3, "T", STR_PAD_LEFT).' '.$locator.' tu';
				$TXEXCHSP2 = '5nn '.str_pad(($qsonrs-1), 3, "T", STR_PAD_LEFT).' '.$locator;     // Exchange previous QSO
			}else{
				$TXEXCH = $callr.' 5nn '.str_pad($qsonrs, 3, "T", STR_PAD_LEFT);    // $cwtwxt = call in input form, $qsonrs = QSO nr
				$TXEXCHSP = '5nn '.str_pad($qsonrs, 3, "T", STR_PAD_LEFT);
				$TXEXCHSP2 = '5nn '.str_pad(($qsonrs-1), 3, "T", STR_PAD_LEFT);     // Exchange previous QSO
			}
		}else{
			$TXEXCH = $callr.' 5nn '.$exch;
			$TXEXCHSP = '5nn '.$exch;
			$TXEXCHSP2 = '5nn '.$exch;
		}
		$TU = 'tu '.$call ;

	}
	///////////////////////////////////////////////////////

	if (file_exists("$logpath.adif")) { } else {       // if adif dont exist, create
		file_put_contents("$logpath.adif", "Created by Óm PHP form rev.$REV - RemoteQTH.com\nPCall=$call\n<adif_ver:4>1.00 <eoh>\n");
		$valuex = file("$logpath.adif");
	}
	if ($_POST['send'] == '*?'){                 // detection button Call?
		udpsocket($IP, port(), $callr.'?' );    // TX cw text
		$show = $callr.'?' ;                    // Show cw text
		$preset = $callr;                       // call insert back in form field
		$search = preg_grep("/$callr/", file("$logpath.txt"));
	//	$preset2 = $qsonrr;                     // exch insert back in form field
		$af1 = 'autofocus="autofocus"';         // cursor in first field (call)
		$af2 = '';                              //            second      (nr)
	}elseif ($_POST['send'] == 'nr?'){
		if ($conteststyle == 'run'){
			udpsocket($IP, port(), 'NR' );
			$show = 'NR' ;
		}elseif ($conteststyle == 'sp'){
			udpsocket($IP, port(), 'NR?' );
			$show = 'NR?' ;
		}
		$preset = $callr;
		$preset2 = $qsonrr;
		$af1 = '';
		$af2 = 'autofocus="autofocus"';
	}elseif ($_POST['send'] == 'previous exchange'){
		udpsocket($IP, port(), $TXEXCHSP2 );
		$show = $TXEXCHSP2 ;
		$preset = $callr;
		$preset2 = $qsonrr;
		$af1 = 'autofocus="autofocus"';
		$af2 = '';
		$prevexch='<input type="submit" name="send" value="previous exchange" class="qso"><input type="submit" name="send" value="Check" class="qso">';
	}elseif ($_POST['send'] == 'Check' && isset($callr)){
		$search = preg_grep("/ $callr /", file("$logpath.txt"));
		$preset = $callr;
		$preset2 = $qsonrr;
		$af1 = 'autofocus="autofocus"';
		$af2 = '';
	}elseif (isset($_POST['callr']) && !isset($_POST['wpm15']) && !isset($_POST['wpm20']) && !isset($_POST['wpm25']) && !isset($_POST['wpm28']) && !isset($_POST['wpm30']) && !isset($_POST['wpm32']) && !isset($_POST['wpm35']) && !isset($_POST['tune'])) {             // if press enter in field call
		if (empty($callr) && empty($qsonrr)){  // if call and nr field clear, run CQ
			if ($mode == 'CW' || $mode == 'CWR' || $mode == 'FSK' || $mode == 'RTTY' || $mode == 'RTTYR'){            // CW only
				if ($conteststyle == 'run'){
					udpsocket($IP, port(), $CQ );
					$mhz = number_format(round(freq($rigip)/1000000, 3), 3);
					$show = $CQ.' <span class="'.$style.'">('.$mhz.' Mhz)</span>' ;
				}elseif ($conteststyle == 'sp'){
					//udpsocket($IP, port(), $call );
					//$mhz = number_format(round(freq($rigip)/1000000, 3), 3);
					//$show = $call.' <span class="'.$style.'">('.$mhz.' Mhz)</span>' ;
					$show = 'Please enter call ' ;
				}
			}
			$preset = '';
			$af1 = 'autofocus="autofocus"';
			$af2 = '';
		}elseif (isset($callr) && empty($qsonrr)){ // if call writed and nr clear, run EXCH
			if ($mode == 'CW' || $mode == 'CWR' || $mode == 'FSK' || $mode == 'RTTY' || $mode == 'RTTYR'){
				if ($conteststyle == 'run'){
					if (preg_match('*(Russia|Kaliningrad)*', GetDxcc($callr))) {
						udpsocket($IP, port(), $CQ );
						$mhz = number_format(round(freq($rigip)/1000000, 3), 3);
						$show = $CQ.' <span class="'.$style.'">('.$mhz.' Mhz) | Occupant detected!</span>' ;

						$search = preg_grep("/ $callr /", file("$logpath.txt"));  // Check call in log
						$callr = '';
						$preset = $callr;
						$af1 = 'autofocus="autofocus"';
						$af2 = '';
					} else {
						udpsocket($IP, port(), $TXEXCH);
					//	$search = preg_grep("/ $callr /", file("$logpath.txt"));  // Check call in log
							txfile('/tmp/callr', $callr);  // save call for test, if change
						$show = $TXEXCH ;

						$search = preg_grep("/ $callr /", file("$logpath.txt"));  // Check call in log
						$preset = $callr;
						$af1 = '';
						$af2 = 'autofocus="autofocus"';
					}

				}elseif ($conteststyle == 'sp'){
					if (preg_match('*(Russia|Kaliningrad)*', GetDxcc($callr))) {
						$show = 'Occupant detected! ' ;

						$search = preg_grep("/ $callr /", file("$logpath.txt"));  // Check call in log
						$callr = '';
						$preset = $callr;
						$af1 = 'autofocus="autofocus"';
						$af2 = '';
					} else {
						if ($mode == 'FSK' || $mode == 'RTTY' || $mode == 'RTTYR'){
							udpsocket($IP, port(), ' '.$call.' '.$call.' ' );	// DE call call RTTY
						} else {
							udpsocket($IP, port(), $call );
						}
					//	$search = preg_grep("/ $callr /", file("$logpath.txt"));  // Check call in log
						$mhz =number_format( round(freq($rigip)/1000000, 3), 3);
						$show = $call.' <span class="'.$style.'">('.$mhz.' Mhz)</span>' ;
						
						$search = preg_grep("/ $callr /", file("$logpath.txt"));  // Check call in log
						$preset = $callr;
						$af1 = '';
						$af2 = 'autofocus="autofocus"';			
					}
				}
			}
//			$search = preg_grep("/ $callr /", file("$logpath.txt"));  // Check call in log
//			$preset = $callr;
//			$af1 = '';
//			$af2 = 'autofocus="autofocus"';
		}elseif (isset($callr) && isset($qsonrr)){  // if call and nr writed, run TU
			if ($mode == 'CW' || $mode == 'CWR' || $mode == 'FSK' || $mode == 'RTTY' || $mode == 'RTTYR'){
				if ($conteststyle == 'run'){
					$callrtest = rxfile('/tmp/callr');
					if ($callrtest == $callr){                            // if call not changed
						udpsocket($IP, port(), $TU);
						$show = $TU;
					}else{                                                // if call changed
						udpsocket($IP, port(), $callr.' '.$TU);   // send changed $callr before TU
						$show = $callr.' '.$TU;
					}
				}elseif ($conteststyle == 'sp'){
					udpsocket($IP, port(), $TXEXCHSP );
					$show = $TXEXCHSP ;
				}
			$prevexch='<input type="submit" name="send" value="previous exchange" class="qso"><input type="submit" name="send" value="Check" class="qso">';
			}
			$mhz = number_format(round(freq($rigip)/1000000, 3), 3);
			if ($trx == '1'){
				$NOTE = $trx1name;
			}
			if ($trx == '2'){
				$NOTE = $trx2name;
			}
			if ($trx == '3'){
				$NOTE = $trx3name;
			}
			$DXCC = GetDxcc($callr);
			$DXCCarray = explode("|", $DXCC);
			if (freq($rigip) > 140000000){
				$locatorr = explode(" ", $qsonrr, 6);
				$lastElement = end($locatorr);
				$bd = bearing_dist($locator, $lastElement);

				file_put_contents("$logpath.txt", str_pad($qsonrs, 5, " ", STR_PAD_RIGHT)
				.$date
				.str_pad($callr, 13, " ", STR_PAD_RIGHT)
				.str_pad($mhz, 6, " ", STR_PAD_LEFT)
				.str_pad($mode, 5, " ", STR_PAD_LEFT)
				.str_pad($qsonrr, 12, " ", STR_PAD_LEFT)
				.str_pad("$bd[km]km", 7, " ", STR_PAD_LEFT)
				.str_pad("$bd[deg]°", 6, " ", STR_PAD_LEFT)
				.'   '
				.str_pad(rst($mode), 3, " ", STR_PAD_LEFT)
				.' '
				.rst($mode)
				.' |'
				.$NOTE
				.'|'
				.trim($DXCCarray[1])
				.'|'
				.trim($DXCCarray[6], " QRB ")
				."\n", FILE_APPEND);  // add VHF qso to txt log
			}else{
				file_put_contents("$logpath.txt", str_pad($qsonrs, 5, " ", STR_PAD_RIGHT)
				.$date
				.str_pad($callr, 14, " ", STR_PAD_RIGHT)
				.str_pad($mhz, 6, " ", STR_PAD_LEFT)
				.str_pad($mode, 6, " ", STR_PAD_LEFT)
				.str_pad($qsonrr, 12, " ", STR_PAD_LEFT)
				.'   '
				.str_pad(rst($mode), 3, " ", STR_PAD_LEFT)
				.' '
				.rst($mode)
				.' |'
				.$NOTE
				.'|'
				.trim($DXCCarray[1])
				.'|'
				.trim($DXCCarray[6], " QRB ")
				."\n", FILE_APPEND);  // add HF qso to txt log
			}
			file_put_contents("$logpath.adif", '<FREQ:'.strlen($mhz).'>'.$mhz.' <QSO_DATE:'.strlen($dateadif).'>'.$dateadif.' <TIME_ON:'.strlen($timeadif).'>'.$timeadif.' <CALL:'.strlen($callr).'>'.$callr.' <MODE:'.strlen($mode).'>'.$mode.' <RST_SEND:'.strlen(rst($mode)).'>'.rst($mode).' <STX:'.strlen($qsonrs).'>'.$qsonrs.' <RST_RCVD:'.strlen(rst($mode)).'>'.rst($mode).' <SRX:'.strlen($qsonrr).'>'.$qsonrr.' <EOR>'."\n", FILE_APPEND);  // add qso to adif log

			setrit($rigip, '0');
			$preset = '';
			$af1 = 'autofocus="autofocus"';
			$af2 = '';
		}
	}else{                                         // cursor after open php form
		$preset = '';
		$af1 = 'autofocus="autofocus"';
		$af2 = '';
	}
	if ($conteststyle == 'run'){
		echo '<a href="'.basename($_SERVER['PHP_SELF']).'?s=sp&log='.$log.'&call='.$call.'&exch='.$exch.'&trx='.$trx.'&nr='.$nr.'" class="switch"><span>RUN</span><span class="onhover" title="'.$call.'-'.$locator.'">S&P</span></a>';
	}
	if ($conteststyle == 'sp'){
		echo '<a href="'.basename($_SERVER['PHP_SELF']).'?s=run&log='.$log.'&call='.$call.'&exch='.$exch.'&trx='.$trx.'&nr='.$nr.'" class="switch"><span>S&P</span><span class="onhover" title="'.$call.'-'.$locator.'">RUN</span></a>';
	}
	// one button
//	if ($trx == '1'){
//		echo '<a href="'.basename($_SERVER['PHP_SELF']).'?s='.$conteststyle.'&log='.$log.'&call='.$call.'&exch='.$exch.'&trx=2" class="switch"><span>'.$trx1name.'</span><span class="onhover">'.$trx2name.'</span></a>';
//	}
//	if ($trx == '2'){
//		echo '<a href="'.basename($_SERVER['PHP_SELF']).'?s='.$conteststyle.'&log='.$log.'&call='.$call.'&exch='.$exch.'&trx=3" class="switch"><span>'.$trx2name.'</span><span class="onhover">'.$trx3name.'</span></a>';
//	}
//	if ($trx == '3'){
//		echo '<a href="'.basename($_SERVER['PHP_SELF']).'?s='.$conteststyle.'&log='.$log.'&call='.$call.'&exch='.$exch.'&trx=1" class="switch"><span>'.$trx3name.'</span><span class="onhover">'.$trx1name.'</span></a>';
//	}
	// three button
$cwcliport  = '89';		// UDP port for CW message
$fskport    = '89';		// UDP port for RTTY message
$catport    = '81';		// http port for get ferquency/mode
$catcmdport = '90';		// UDP command trasfer to cat | FE FE A4 E0 <command> FD

	echo '<a href="'.basename($_SERVER['PHP_SELF']).'?s='.$conteststyle.'&log='.$log.'&call='.$call.'&exch='.$exch.'&trx=1" class="switch" ';
		if ($trx == '1'){
			echo 'style="background-color: #080;"';
		}
		echo '><span>'.$trx1name.'</span><span class="onhover" title="'.$IP1.' | udpCW '.$cwcliport.' | udpFSK '.$fskport.' | udpCAT '.$catcmdport.' | httpCAT '.$catport.'">'.$trx1name.'</span></a>';
	echo '<a href="'.basename($_SERVER['PHP_SELF']).'?s='.$conteststyle.'&log='.$log.'&call='.$call.'&exch='.$exch.'&trx=2" class="switch" ';
		if ($trx == '2'){
			echo 'style="background-color: #080;"';
		}
		echo '><span>'.$trx2name.'</span><span class="onhover" title="'.$IP2.' | udpCW '.$cwcliport.' | udpFSK '.$fskport.' | udpCAT '.$catcmdport.' | httpCAT '.$catport.'">'.$trx2name.'</span></a>';
	echo '<a href="'.basename($_SERVER['PHP_SELF']).'?s='.$conteststyle.'&log='.$log.'&call='.$call.'&exch='.$exch.'&trx=3" class="switch" ';
		if ($trx == '3'){
			echo 'style="background-color: #080;"';
		}
		echo '><span>'.$trx3name.'</span><span class="onhover" title="'.$IP3.' | udpCW '.$cwcliport.' | udpFSK '.$fskport.' | udpCAT '.$catcmdport.' | httpCAT '.$catport.'">'.$trx3name.'</span></a>';
	echo '<span style="font-size:50%; color:#666; margin-left: 10px;"> rev.'.$REV.'</span>';
	?>
	<input style="display: none" type="submit" name='send' value="Send">	<!-- hidden button - use if press enter (without click any other button)-->  <?
	if ($mode == 'CW' || $mode == 'CWR'){?>
		<!-- <span class="gray">Freq: </span>
		<input type="submit" name="wpm15" value="15">
		<input type="submit" name="wpm20" value="20">
		<input type="submit" name="wpm25" value="25" class="wpm">
		<input type="submit" name="wpm28" value="28" class="wpm">
		<input type="submit" name="wpm30" value="30" class="wpm">
		<input type="submit" name="wpm32" value="32" class="wpm">
		<input type="submit" name="wpm35" value="35" class="wpm">
		<input type="submit" name="stop" value="STOP" class="wpm">-->
	<?}?>
		<!-- <input type="submit" name="tune" class="wpm" --> <?
			// if ($mode == 'CW' || $mode == 'CWR'){
				// echo 'value="Tune">';
			// }else{
				// echo 'value="PTT">';
			// }
		//  http://blog.radioartisan.com/arduino-cw-keyer/
		if (isset($_POST['tune'])) {udpsocket($IP, port(), '\t'."\r"); $preset = $callr; $preset2 = $qsonrr;}
		else if (isset($_POST['stop'])) {udpsocket($IP, port(), '\\'."\r"); $preset = $callr; $preset2 = $qsonrr;}
		else if (isset($_POST['wpm15'])) {udpsocket($IP, port(), '\w15'."\r"); $preset = $callr; $preset2 = $qsonrr;}
		else if (isset($_POST['wpm20'])) {udpsocket($IP, port(), '\w20'."\r"); $preset = $callr; $preset2 = $qsonrr;}
		else if (isset($_POST['wpm25'])) {udpsocket($IP, port(), '\w25'."\r"); $preset = $callr; $preset2 = $qsonrr;}
		else if (isset($_POST['wpm28'])) {udpsocket($IP, port(), '\w28'."\r"); $preset = $callr; $preset2 = $qsonrr;}
		else if (isset($_POST['wpm30'])) {udpsocket($IP, port(), '\w30'."\r"); $preset = $callr; $preset2 = $qsonrr;}
		else if (isset($_POST['wpm32'])) {udpsocket($IP, port(), '\w32'."\r"); $preset = $callr; $preset2 = $qsonrr;}
		else if (isset($_POST['wpm35'])) {udpsocket($IP, port(), '\w35'."\r"); $preset = $callr; $preset2 = $qsonrr;}?>
</div><div id="obsah1">

		<span class="<? echo $style;?>"><? echo $mode;?> &#10095</span> <? echo $show;
		if(!empty($show)){
		echo ' | ';
		}
		$string = GetDxcc($callr);
		echo $string;
		if(!empty($string)){
			echo '&deg;';
			$pieces = explode(' ', $string);
			$az = array_pop($pieces)-45;
		}
		?><br>
			<p class="text2">Call:
			<input type="text" <? echo $af1?> value="<? echo $preset?>" name="callr" id="Call" onblur="if (this.value == '') {this.value = '<? echo $preset?>';}" size="8" maxlength="30" autocomplete="off"/><?

		if (($mode == 'CW' || $mode == 'CWR' || $mode == 'FSK' || $mode == 'RTTY' || $mode == 'RTTYR')&& $conteststyle == 'run'){
			echo '<input type="submit" name="send" value="*?" class="qso">';
		}else if ($conteststyle == 'sp'){
				echo '<input type="submit" name="send" value="Check" class="qso">';
		}
		
		
		echo " Exch<input type=\"text\"$af2 value=\"$preset2\" name=\"qsonrr\" size=\"";
			if (freq($rigip) > 140000000){
				echo 11;
			}else{
				echo 1;
			}
			echo "\" maxlength=\"30\" autocomplete=\"off\">";
			// if (freq($rigip) > 140000000){
			// 	echo " Loc<input type=\"text\"$af2 value=\"$preset2\" name=\"qsonrr\" size=\"6\" maxlength=\"30\" autocomplete=\"off\">";
			// }
		if ($mode == 'CW' || $mode == 'CWR' || $mode == 'FSK' || $mode == 'RTTY' || $mode == 'RTTYR'){
		if ($conteststyle == 'run'){
			echo '<input type="submit" name="send" value="nr?" class="qso">';
		}
		if ($conteststyle == 'sp'){
			if (empty($prevexch)){
				echo '<input type="submit" name="send" value="nr?" class="qso">';
//				echo '<input type="submit" name="send" value="Check" class="qso">';
			}
			if(!empty($prevexch)){
				echo $prevexch;
			}
		}
	}
	?></form><?
	if (!empty($qsonrr) && freq($rigip) > 140000000){
		$locatorr = explode(" ", $qsonrr, 6);
		$lastElement = end($locatorr);
		$bd = bearing_dist($locator, $lastElement);
		?><span style="font-size: 150%; transform: rotate(<?echo $bd[deg]-45?>deg); display: inline-block;">&#10138;</span><?
		echo " $bd[deg]&#176; $bd[km] km";
	}else if (!empty($callr)){
		?><span style="font-size: 150%; transform: rotate(<?echo $az?>deg); display: inline-block;">&#10138;</span><?
	}
	?>
	</div><div id="obsah2">
	<pre class="<?
	if (isset($search)){
		if (count($search) ==0){
			echo 'checkg">';
			echo "$callr no QSO";
		}else{
			echo 'check">';
			foreach($search as $value){                            // print array value
			    echo $value;
			}
		}
	}else{
		echo '">' ;
	}?></pre>
	<pre><?$file = file("$logpath.txt");                               // viewing log reverse
		$file = array_reverse($file);
		foreach($file as $f){
		    echo $f;
		}?></pre>
	Download: <a href="<?echo "$logpath.txt" ?>">.txt&#8599;</a> <a href="<?echo "$logpath.adif" ?>">.adif&#8599;</a> | <a href="https://github.com/ok1hra/om" target="_blank">GitHub</a>
<?
}else{
	echo 'Switch TRX to <b>CW/SSB/FM/RTTY</b>, check IP or switch TRX <a href="'.basename($_SERVER['PHP_SELF']).'?s='.$conteststyle.'&log='.$log.'&call='.$call.'&exch='.$exch.'&trx=2" class="switch"><span>';
	if ($trx == '1'){
		echo $trx1name.'</span><span class="onhover">'.$trx2name.'</span></a>';
	}
	if ($trx == '2'){
		echo $trx2name.'</span><span class="onhover">'.$trx3name.'</span></a>';
	}
	if ($trx == '2'){
		echo $trx3name.'</span><span class="onhover">'.$trx1name.'</span></a>';
	}
	echo '<br> | CAT '.$CAT.' | IP '.$IP.' | MODE '.mode($rigip).' | MHz '.freq($rigip).' | <a href="'.'http://'.$IP.':'.$catport.'" target="_blank">URL</a> |'; 
}?>
</div>
</body>
</html>
