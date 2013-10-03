<?php

/*
 *	Manager für alle MySQL Bedingten Funktionen
 */
 
class MySQLMgr
{
	static $c1 = null;
	static $c2 = null;
	
	static function connectDB ($user, $pass, $host)
	{
		// Used for Character
		$c1 = mysql_connect($host,$user,$pass);
		// Used for general website
		$c2 = mysql_connect($host,$user,$pass, true);
	}
	
	static function selectDB($db1, $db2)
	{
		mysql_select_db($db1, $c1);
		mysql_select_db($db2, $c2);
	}
	
	static function executeSingle($query, $db = false)
	{
		if ($db == true) 
			$result = mysql_query($query, $c2);
		else
			$result = mysql_query($query, $c1);
		$row = mysql_fetch_array($result);
		return($row[0]);
	}
	
	static function executeUpdate($query, $db = false)
	{
		if ($db == true) 
			$result = mysql_query($query, $c2);
		else
			$result = mysql_query($query, $c1);
	}
	
	static function executeMulti($query, $db = false)
	{
		if ($db == true) 
			$result = mysql_query($query, $c2);
		else
			$result = mysql_query($query, $c1);
		return($result);
	}
	
	static function closeDB ()
	{
		mysql_close();
	}
}
?>