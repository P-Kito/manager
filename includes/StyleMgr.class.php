<?php

/*
 *	Manager für den Style
 */

class StyleMgr 
{
	static function loadPage($p)
	{
		if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/manager/modules/'.$p.'.mod.php'))
		{
			ob_start();
			include($_SERVER['DOCUMENT_ROOT'] . '/manager/modules/'.$p.'.mod.php');
			$contents = ob_get_clean();
			return($contents);
		} else {
			return("<h2>Seite noch im Aufbau - 404</h2>Dieses Modul noch existiert nicht!");
		}
	}
}