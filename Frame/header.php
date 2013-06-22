<?php
	
	if(strpos("header.php",$_SERVER["PHP_SELF"])) {
  		exit;
	}
	$ausgabe.='<head> '."\n";
	$ausgabe.='<title>Datei Upload</title> '."\n";
	$ausgabe.='<!-- Php-Space.info / Datei Upload Version 1.09 - 23.12.2009 -->'."\n";
	$ausgabe.='<!-- (c) Nico Schuber '.date("Y").' - Kontakt: www.php-space.info - info[at]schubertmedia.de -->'."\n";
	$ausgabe.='<style type="text/css">'."\n";
	$ausgabe.='	<!--'."\n";
	$ausgabe.='	body, table{'."\n";
	$ausgabe.='		color: #000;'."\n";
	$ausgabe.='		font: 11px Verdana, Tahoma, Arial, Helvetica, sans-serif; '."\n";
	$ausgabe.='	}'."\n";
	$ausgabe.='	div{'."\n";
	$ausgabe.='		margin:0;'."\n";
	$ausgabe.='		padding:0;'."\n";
	$ausgabe.='	}'."\n";
	$ausgabe.='	-->'."\n";
	$ausgabe.='</style>'."\n";
	$ausgabe.='</head> '."\n";
	$ausgabe.='<body>'."\n";
?>