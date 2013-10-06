<?php

/*
 *	Manager f�r alle MySQL Bedingten Funktionen
 */
 
class MySQLMgr
{
	static $authDB = null; // Auth
	static $webDB = null; // General Website
	
	static function connectDB($user, $pass, $host)
	{
		// Used for Auth
		self::$authDB = mysql_connect($host,$user,$pass);
		mysql_select_db(CONFIG::DB1, self::$authDB);
		// Used for general website
		self::$webDB = mysql_connect($host,$user,$pass, true);
		mysql_select_db(CONFIG::DB2, self::$webDB);
	}
	
	static function executeSingle($query, $db)
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
		return($result);
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