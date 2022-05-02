<!doctype html>
<html>
<head>
	<title>OM contest table</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="styles.css" rel="stylesheet" type="text/css">
	<!-- <script src="netteForms.js"></script> -->
	<style>
	BODY {
	margin: 0px;
	border: 0px;
	padding: 0px;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	font-size: 10pt;
	color : #444;
}

/* MENU & GRADIENT */
	#header {
		background: #cfcfcf; /* Old browsers */
		background: -moz-linear-gradient(top,  #cfcfcf 0%, #666666 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#cfcfcf), color-stop(100%,#666666)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  #cfcfcf 0%,#666666 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  #cfcfcf 0%,#666666 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  #cfcfcf 0%,#666666 100%); /* IE10+ */
		background: linear-gradient(to bottom,  #cfcfcf 0%,#666666 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cfcfcf', endColorstr='#666666',GradientType=0 ); /* IE6-9 */
		position: absolute;
		top: 0px;
		left: 0px;
		right: 0px;
		height: 80px;
		width: 100%;
	}
	#leftmenu {
		position: absolute;
		top: 80px;
		left: 0px;
		bottom: 0px;
		width: 150px;
		height: expression(document.body.clientHeight - 120);
		background: #eee;
	}
	#obsah {
		position: absolute;
		top: 80px;
		left: 170px;
		bottom: 0px;
		right: 0px;
		height: expression(document.body.clientHeight - 120);
		width: expression(document.body.clientWidth - 150);
		background: #ffffff;
		overflow: auto;
	}

.deb	{
	position: absolute;
	margin: 150px 25px 25px 25px;
	}

/* MENU & GRADIENT */
h1, h2, h3, h4 {
	font-size: 130%;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	color: #336600;
	font-weight: bold;
	text-align: left;
	margin-top: 20px;
	margin-bottom: 30px;
	margin-left: 0px;
	margin-right: 50px;
	padding-left: 15px;
	border-bottom: 2px dotted #c0c0c0;
	}
.h1 {
	color: #f23f37;
	}
a:link  {
	color : #888;
	font-weight : bold;
	text-decoration : none
	border: 0px;
	}
a:visited  {
	color : #888;
	font-weight : bold;
	text-decoration : none
	border: 0px;
	}
a:hover  {
	color : #080;
	font-weight : bold;
	text-decoration : none
	border: 0px;
	}
a.external:after{
	content: "\2197";
	target: "_blank"
	}
pre	{
	border: 1px dotted #999999;
	padding: 4px;
	width: ;
	overflow: auto;
	color: #505050;
	background-color: #eeeeee;
	margin-top: 0px;
	margin-left: 15px;
	margin-right: 50px;
	}
.info	{
	max-width: 350px;
	color: #787;
	background-color: #eeeeee;
	margin-left: 0px;
	margin-right: 0px;
	}


.qr	{
	font-size: 120%;
	line-height: 95%;
	letter-spacing: 0px;
	width: ;
	text-align: center;
	color: #606060;
	background-color: #ffffff;
	margin-top: 0px;
	margin-left: 0px;
	float: right;
	}

.text2	{
	font-size: 100%;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	color: #505050;
	margin-top: 10px;
	margin-bottom: 0px;
	margin-right: 50px;
	margin-left: 0px;
	}
.calibrate	{
	margin-right: 20px;
	margin-left: 20px;
	}
.center	{
	text-align: center;
	margin: 5px auto 0 auto;
	}

@font-face {
	font-family: "lcd";
	src: url("digital-7_italic-webfont.woff") format('woff');
}

#freq, #band	{
	font-size: 400%;
	font-family: 'Roboto Condensed',sans-serif,Arial,Tahoma,Verdana;
	font-weight: bold;
	color: #333;
	margin: 20px 0 20px 0;
	background-color: #FAAC58;
	border: 0px solid gray;
	padding: 10px 40px 10px 40px;
	border-radius:         8px;
	-webkit-border-radius: 8px;
	-moz-border-radius:    8px;
	-khtml-border-radius:  8px;
	}
.lcd	{
	font-family: lcd ;
	font-weight: normal;
	font-size: 120%;
	}
.khz	{
	font-weight: normal;
	font-size: 40%;
	}
.mob2	{
	font-size: 200%;
	font-family: 'Roboto Condensed',sans-serif,Arial,Tahoma,Verdana;
	font-weight: bold;
	text-align: center;
	color: #333;
	background-color: #FF8000;
	border: 2px solid #B45F04;
	padding: 5px 5px 5px 5px;
	margin: 0px 10px -2px 10px;
	border-radius: 8px;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	-khtml-border-radius: 8px;
	}

.status1	{
	font-size: 100%;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	font-weight: bold;
	color: #505050;
	margin-top: 10px;
	margin-bottom: 0px;
	margin-right: 50px;
	margin-left: 15px;
	}
.status2	{
	font-size: 100%;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	font-weight: normal;
	color: #505050;
	margin-top: 0px;
	margin-bottom: 0px;
	margin-right: 50px;
	margin-left: 15px;
	}
.status3	{
	font-size: 100%;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	color: #505050;
	margin-top: 0px;
	margin-bottom: 0px;
	margin-right: 0px;
	margin-left: 10px;
	}
.next	{
	text-align: right;
	margin-top: 50px;
	margin-right: 50px
	}
label	{
	text-align: left;
	font-size: 100%;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	color: #505050;
	margin-right: 0px;
	margin-left: 0px;
	}
legend	{
	font-size: 120%;
	font-weight: bold;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	color: #336600;
	}
.button {
	text-align: left;
	margin-left: 0px;
	}
.map {
	margin-top: 20px;
	margin-left: 0px;
	}
.warn	{
	max-width: 350px;
	color: #ff0000;
	text-align: left;
	margin-top: 0px;
	margin-left: 0px;
	z-index: 10;
	}
.mobtitul {
	margin: 5px 0 0px 0;
	text-align: center;
	color: #888;
	background-color: #000;
	font-weight: normal;
	}
br {
	color: #808080;
	}
img	{
	border: 0px;
	}

table.rot {
	margin: 30px auto 50px 0px;
	border: 1px solid #999;
	border-collapse:collapse;
	}
table.rot td {
	border-bottom:1px dotted black;
	padding:5px;
	text-align: left;
	}
table.rot td.center {
	text-align: center;
	}
table.rot th.center {
	text-align: center;
	}
table.rot tr:hover {
	background-color: #ffff99;
	}
/* relay sw */
table.white {
	margin: 0px;
	border: 0px solid #999;
	border-collapse:collapse;
	}
.white td {
	padding:3px;
	}
.white tr:hover {
	background-color: #d8e4cb;
	}
.border	{
	display: table-cell;
	border: 1px solid #999;
	padding:15px;
	border-radius: 12px;
	-webkit-border-radius: 12px;
	-moz-border-radius: 12px;
	-khtml-border-radius: 12px;
	}
table.black {
	margin: 0px;
	border: 0px solid #999;
	border-collapse:collapse;
	}
.black td {
	padding:3px;
	}
.black tr:hover {
	background-color: #250;
	}

table.rot tr.prvni th {
	color: #888;
	border-bottom:0px;
	padding:7px;
	border-bottom:1px dotted black;
	background-color: #D8E4CB;
	}
table.rot th {
	color: #008800;
	border-bottom:2px solid #aaa;
	padding:7px;
	background-color: #efefef;
	text-align: left;
	width: auto;
	}

table.rot2 {
	margin: 30px auto 50px 0px;
	border: 1px solid #999;
	border-collapse:collapse;
	}
table.rot2 td {
	border-bottom:1px dotted black;
	padding:10px;
	text-align: left;
	}
table.rot2 tr.prvni th {
	color: #888;
	border-bottom:0px;
	padding:10px;
	border-bottom:1px dotted black;
	background-color: #D8E4CB;
	}
table.rot2 th {
	color: #008800;
	border-bottom:2px solid #aaa;
	padding:10px;
	background-color: #efefef;
	text-align: left;
	width: auto;
	}

table {
	border: 0px dotted #999999;
	margin-left: 0px;
	}

.split-relay {
	margin-left: 10px;
	width: 320px;
	border: 0;
	}
.td1	{
	font-size: 100%;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	color: #555;
	vertical-align: top;
	}
.td2	{
	font-size: 100%;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	color: #888;
	vertical-align: top;
	}
.cw	{
	font-size: 100%;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	color: #cfcfcf;
	margin-top: 10px;
	margin-bottom: 0px;
	margin-right: 0px;
	margin-left: 20px;
	}
.mob {
	/*float: left;
	width: 258px;
	height: 320px;*/
	border: 2px dotted #444;
	padding: 5px 5px 5px 5px;
	margin: 0px 10px -2px 10px;
	background-color: #000;
	border-radius: 12px;
	-webkit-border-radius: 12px;
	-moz-border-radius: 12px;
	-khtml-border-radius: 12px;
}
.mob3 {
	margin: 0px 10px -2px 10px;
}
.splitwindow {
	margin: 10px 10px 5px 10px;
}
.graph {
	position: relative; /* IE is dumb */
	width: 100%;
	border: 1px solid #888;
	padding: 2px;
	margin: 0px 0px -1px 0px;
	border-radius: 4px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	-khtml-border-radius: 4px;
}
.graph .bar {
	display: block;
	position: relative;
	background: #ddd;
	height: 1em;
	color: #000;
	line-height: 1em;
	text-align: left;
	padding: 1px 0px 1px 5px;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
}
.graph .bar span { position: absolute; left: 1em; }
.loadmenu {
        margin: 20px 0 0 10px;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	font-size: 10pt;
	color : #444;
}
img.mobwebcam {
	width: 100%;
	margin: 10px 0 10px 0;
}

/* progress bar */
.progress {
        border: 1px solid #888;
        height: 16px;
        width: 128px;
        margin: 30px 0 0 10px;
        background: #fff;
}
.progress .prgbar {
        background: #ccc;
        position: relative;
        height: 16px;
        z-index: 999;
}
.progress .prgtext {
        color: #000;
        text-align: left;
        font-size: 13px;
        padding: 0 0 0 6px;
        width: 128px;
        position: absolute;
        z-index: 1000;
}
.progress .prginfo {
        margin: 3px 0;
}



/* Nette */

.required label {
	font-weight: bold;
	}
.error {
	color: #D00;
	font-weight: bold;
	}
fieldset {
	padding: .5em;
	margin: .5em 0;
	background: #eaeaea;
	border: 1px dotted #d9d9d9;
	margin-top: 50px;
	margin-left: 0px;
	margin-right: 50px;
	}
p	{
	font-size: 100%;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	color: #505050;
	}

.changelog {
	font-size: 100%;
	font-family: Tahoma, Helvetica, Arial, sans-serif;
	color: #505050;
	}

input.button {
	font-size: 120%;
	}
th	{
	width: 10em;
	text-align: right;
	font-weight: normal;
	}



/* MENU */
/* Some stylesheet reset */
#cssmenu > ul {
	list-style: none;
	margin: 0;
	padding: 0;
	vertical-align: baseline;
	line-height: 1;
}

/* The container */
#cssmenu > ul{
	display: block;
	position: relative;
	width: 150px;
}

	/* The list elements which contain the links */
	#cssmenu > ul li {
		display: block;
		position: relative;
		margin: 0;
		padding: 0;
		width: 150px;
	}

		/* General link styling */
		#cssmenu > ul li a {
			/* Layout */
			display: block;
			position: relative;
			margin: 0;
			border-top: 1px dotted #fff;
			border-bottom: 1px dotted #d9d9d9;
			padding: 11px 20px;
			width: 110px;

			/* Typography */
			font-family:  Helvetica, Arial, sans-serif;
			color: #666666;
			text-decoration: none;
			text-transform: uppercase;
			text-shadow: 0 1px 0 #fff;
			font-size: 13px;
			font-weight: 300;

			/* Background & effects */
			background: #d8e4cb;
		}

		/* Rounded corners for the first link of the menu/submenus */
		#cssmenu > ul li:first-child>a {
			border-top-left-radius: 4px;
			border-top-right-radius: 4px;
			border-top: 0;
		}

		/* Rounded corners for the last link of the menu/submenus */
		#cssmenu > ul li:last-child>a {
			border-bottom-left-radius: 4px;
			border-bottom-right-radius: 4px;
			border-bottom: 0;
		}


		/* The hover state of the menu/submenu links */
		#cssmenu > ul li a:hover, #cssmenu > ul li:hover>a {
			color: #fff;
			text-shadow: 0 1px 0 rgba(0, 0, 0, .25);
			background: #336600;
			background: -webkit-linear-gradient(bottom, #336600, #407000);
			background: -ms-linear-gradient(bottom, #336600, #407000);
			background: -moz-linear-gradient(bottom, #336600, #407000);
			background: -o-linear-gradient(bottom, #336600, #407000);
			border-color: transparent;
		}

		/* The arrow indicating a submenu */
		#cssmenu > ul .has-sub >a::after {
			content: '';
			position: absolute;
			top: 16px;
			right: 10px;
			width: 0px;
			height: 0px;

			/* Creating the arrow using borders */
			border: 4px solid transparent;
			border-left: 4px solid #666666;
		}

		/* The same arrow, but with a darker color, to create the shadow effect */
		#cssmenu > ul .has-sub >a::before {
			content: '';
			position: absolute;
			top: 17px;
			right: 10px;
			width: 0px;
			height: 0px;

			/* Creating the arrow using borders */
			border: 4px solid transparent;
			border-left: 4px solid #fff;
		}

		/* Changing the color of the arrow on hover */
		#cssmenu > ul li>a:hover::after, #cssmenu > ul li:hover>a::after {
			border-left: 4px solid #fff;
		}

		#cssmenu > ul li>a:hover::before, #cssmenu > ul li:hover>a::before {
			border-left: 4px solid rgba(0, 0, 0, .25);
		}


		/* THE SUBMENUS */
		#cssmenu > ul ul {
			position: absolute;
			left: 150px;
			top: -9999px;
			padding-left: 5px;
			opacity: 0;
			/* The fade effect, created using an opacity transition */
			-webkit-transition: opacity .3s ease-in;
			-moz-transition: opacity .3s ease-in;
			-o-transition: opacity .3s ease-in;
			-ms-transition: opacity .3s ease-in;
		}

		/* Showing the submenu when the user is hovering the parent link */
		#cssmenu > ul li:hover>ul {
			top: 0px;
			opacity: 1;
		}

/* webcam zoom */
.zoomPad{
	position:relative;
	float:left;
	z-index:99;
	cursor:crosshair;
}
.zoomPreload{
   -moz-opacity:0.8;
   opacity: 0.8;
   filter: alpha(opacity = 80);
   color: #333;
   font-size: 12px;
   font-family: Tahoma;
   text-decoration: none;
   border: 1px solid #CCC;
   background-color: white;
   padding: 8px;
   text-align:center;
   background-image: url(../images/zoomloader.gif);
   background-repeat: no-repeat;
   background-position: 43px 30px;
   z-index:110;
   width:90px;
   height:43px;
   position:absolute;
   top:0px;
   left:0px;
    * width:100px;
    * height:49px;
}

.zoomPup{
	overflow:hidden;
	background-color: #FFF;
	-moz-opacity:0.6;
	opacity: 0.6;
	filter: alpha(opacity = 60);
	z-index:120;
	position:absolute;
	border:1px solid #CCC;
  z-index:101;
  cursor:crosshair;
}

.zoomOverlay{
	position:absolute;
	left:0px;
	top:0px;
	background:#FFF;
	/*opacity:0.5;*/
	z-index:5000;
	width:100%;
	height:100%;
	display:none;
  z-index:101;
}

.zoomWindow{
	position:absolute;
	left:110%;
	top:40px;
	background:#FFF;
	z-index:6000;
	height:auto;
  z-index:10000;
  z-index:110;
}
.zoomWrapper{
	position:relative;
	border:1px solid #999;
  z-index:110;
}
.zoomWrapperTitle{
	display:block;
	background:#999;
	color:#FFF;
	height:18px;
	line-height:18px;
	width:100%;
  overflow:hidden;
	text-align:center;
	font-size:10px;
  position:absolute;
  top:0px;
  left:0px;
  z-index:120;
  -moz-opacity:0.6;
  opacity: 0.6;
  filter: alpha(opacity = 60);
}
.zoomWrapperImage{
	display:block;
  position:relative;
  overflow:hidden;
  z-index:110;

}
.zoomWrapperImage img{
  border:0px;
  display:block;
  position:absolute;
  z-index:101;
}

.zoomIframe{
  z-index: -1;
  filter:alpha(opacity=0);
  -moz-opacity: 0.80;
  opacity: 0.80;
  position:absolute;
  display:block;
}

/*********************************************************
/ When clicking on thumbs jqzoom will add the class
/ "zoomThumbActive" on the anchor selected
/ *********************************************************/


	</style>
</head>
<body scroll="no">
<!--<div id="obsah">-->
<!-- Obsah -->
<!-- <span style="position: absolute; top: 80px; left: 360px; z-index: 0"><img src="log.png"></span> -->

<?php
//require 'function.php';

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
	$lines = count(file($file));
	return $lines;
}

// require 'Nette/loader.php';
// use Nette\Forms\Form,
// //	Nette\Diagnostics\Debugger,
// 	Nette\Utils\Html;


////debugger::enable();
//$configurator = new Nette\Config\Configurator;
//$configurator->setDebugMode(TRUE);
//$configurator->enableDebugger(__DIR__ . '/../log');

// Need run on server
// /usr/bin/rigctld -m 228 -r /dev/ttyUSB.cat -s 9600
// for control use
// rigctl -m 2 -r 192.168.11.80 f

$path = "";	// ../cfg/
$warn = '';

// $rigctld = rxfile("s-rigctld-on");
date_default_timezone_set('UTC');
$date = date('Y-m-d-', time());
?>
<form action="<?echo basename($_SERVER['PHP_SELF']);?>" method="post"><?
		$name = trim(strtoupper($_POST['name']));     // trim whitespace and change to UPERCASE
		$call = trim(strtoupper($_POST['call']));
		$exch = trim(strtoupper($_POST['exch']));?>
	<label for="name">Contest name:</label>
	<input type="text" name="name" id="name" size="8" maxlength="30"/>
	<label for="call">Callsign:</label>
	<input type="text" name="call" id="call" size="8" maxlength="30"/>
	<label for="exch">Exchange (NR for number):</label>
	<input type="text" name="exch" id="exch" size="8" maxlength="30"/>
	<input type="submit" value="Create log">
</form><?

if(!empty($_POST['name']) && !empty($_POST['call']) && !empty($_POST['exch'] )){
	//if (file_exists("$path.'contest-table'")) { } else {       // if adif dont exist, create
	//	file_put_contents("$path.'contest-table'", '');
	//	$valuex = file("$path.'contest-table'");
	//}

	$content = file_get_contents('./contest-table', true);

	file_put_contents('./contest-table', '<tr>'."\n\t".'<td>'.$date.$name.'</td>'."\n\t".'<td>'.$call.'</td>'."\n\t".'<td class="center">'.$exch.'</td>'."\n\t".'<td><a href="log/'.$date.$name.'.txt">.txt</a></td>'."\n\t".'<td><a href="log/'.$date.$name.'.adif">.adif</a></td>'."\n\t".'<td class="center"><? if (file_exists("log/'.$date.$name.'.txt")) { echo qso("log/'.$date.$name.'.txt"); $sumqso=$sumqso+qso("log/'.$date.$name.'.txt");} else { echo "-";}?></td>'."\n\t".'<td class="center"><a href=".om.php?s=run&log='.$date.$name.'&call='.$call.'&exch='.$exch.'" onclick="window.open( this.href, this.href, \'width=550,height=300,left=0,top=0,menubar=no,location=no,status=no\' ); return false;"  title="SCL"><img src="split.png" alt="split window"></a></td>'."\n".'</tr>'."\n".$content);  // , FILE_APPEND
	echo "<br>Log created :)<br>";
	unset($name);
	unset($call);
	unset($exch);
}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
	echo "<br>Log NOT created :(<br>";
	echo '>'.rxfile(contest-table);
}
// echo $name.'|'.$call.'|'.$exch;
?>

<hr>
<table  class="rot">
	<tr class="prvni">
		<th>Date-Name</th>
		<th>Call</th>
		<th>Exch</th>
		<th colspan="2">LOG</th>
		<th>#QSO</th>
		<th>Open Log</th>
	</tr>
	<?if (file_exists('contest-table')) {
		include 'contest-table';
		echo '&sum; '.$sumqso.' QSO';
	}?>
</table>

<p class="warn"><?php echo $warn ?></p>

<p class="text2"><a href="om-install.txt" target="_blank" class="external">om_install</a></p>

</body>
</html>
