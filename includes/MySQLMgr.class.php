<?php

/*
 *	Manager für alle MySQL Bedingten Funktionen
 */
 
class MySQLMgr
{
	static $authDB = null; // Auth
	static $webDB = null; // General Website
	
	static function connectDB($user, $pass, $host)
	{
		// Used for Auth
		self::$authDB = mysql_connect($host,$user,$pass);
		// Used for general website
		self::$webDB = mysql_connect($host,$user,$pass);
	}
	
	static function selectDB($db1, $db2)
	{
		mysql_select_db($db1, self::$authDB);
		mysql_select_db($db2, self::$webDB);
	}
	
	static function executeSingle($query, $db = false /* always auth db*/)
	{
		if ($db)
			$result = mysql_query($query, self::$webDB);
		else
			$result = mysql_query($query, self::$authDB);
		$row = mysql_fetch_array($result);
		return($row[0]);
	}
	
	static function executeUpdate($query, $db = false)
	{
		if ($db) 
			$result = mysql_query($query, self::$webDB);
		else
			$result = mysql_query($query, self::$authDB);
	}
	
	static function executeMulti($query, $db = false)
	{
		if ($db) 
			$result = mysql_query($query, self::$webDB);
		else
			$result = mysql_query($query, self::$authDB);
		return($result);
	}
	
	static function closeDB ()
	{
		mysql_close(self::$authDB);
		mysql_close(self::$webDB);
	}
}
?>