<?php

/*
 *	Manager f�r alle MySQL Bedingten Funktionen
 */
 
class MySQLMgr
{
	static $c1 = null;
	static $c2 = null;
	
	static function connectDB($user, $pass, $host)
	{
		// Used for Character
		self::$c1 = mysql_connect($host,$user,$pass);
		// Used for general website
		self::$c2 = mysql_connect($host,$user,$pass);
	}
	
	static function selectDB($db1, $db2)
	{
		mysql_select_db($db1, self::$c1);
		mysql_select_db($db2, self::$c2);
	}
	
	static function executeSingle($query, $db = false /* always char db*/)
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
		mysql_close($c1);
		mysql_close($c2);
	}
}
?>