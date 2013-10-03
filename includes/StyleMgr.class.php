<?php

/*
 *	Manager für den Style
 */

include_once($_SERVER['DOCUMENT_ROOT'].'/conf/site.conf.php');

class StyleMgr 
{
	static function loadPage($p)
	{
		if(file_exists('../modules/'.$p.'.mod.php'))
		{
			// Ob_Start damit der code aus dem modul ausgefuehrt wird
			ob_start();
			include($_SERVER['DOCUMENT_ROOT'].'/modules/'.$p.'.mod.php');
			$contents = ob_get_clean();
			return($contents);
		} else {
			return("<h2>Seite noch im Aufbau - 404</h2>Dieses Modul noch existiert nicht!");
		}
	}
}