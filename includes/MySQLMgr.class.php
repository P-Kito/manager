<?php

/*
 *	Manager für alle MySQL Bedingten Funktionen
 */
 
class MySQLMgr
{
	static $c1 = null; // Auth
	static $c2 = null; // General Website
	
	static function connectDB($user, $pass, $host)
	{
		// Used for Auth
		self::$c1 = mysql_connect($host,$user,$pass);
		// Used for general website
		self::$c2 = mysql_connect($host,$user,$pass);
	}
	
	static function selectDB($db1, $db2)
	{
		mysql_select_db($db1, self::$c1);
		mysql_select_db($db2, self::$c2);
	}
	
	static function executeSingle($query, $db = false /* always auth db*/)
	{
		if ($db)
			$result = mysql_query($query, self::$c2);
		else
			$result = mysql_query($query, self::$c1);
		$row = mysql_fetch_array($result);
		return($row[0]);
	}
	
	static function executeUpdate($query, $db = false)
	{
		if ($db) 
			$result = mysql_query($query, self::$c2);
		else
			$result = mysql_query($query, self::$c1);
	}
	
	static function executeMulti($query, $db = false)
	{
		if ($db) 
			$result = mysql_query($query, self::$c2);
		else
			$result = mysql_query($query, self::$c1);
		return($result);
	}
	
	static function closeDB ()
	{
		mysql_close(self::$c1);
		mysql_close(self::$c2);
	}
}
?>