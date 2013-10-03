<?php

/*
 *	Manager für den Style
 */

include_once('../conf/site.conf.php');

class StyleMgr 
{
	static function loadPage($p)
	{
		if(file_exists('/var/www/modules/'.$p.'.mod.php'))
		{
			ob_start();
			include('../modules/'.$p.'.mod.php');
			$contents = ob_get_clean();
			return($contents);
		} else {
			return("<h2>Seite noch im Aufbau - 404</h2>Dieses Modul noch existiert nicht!");
		}
	}
}