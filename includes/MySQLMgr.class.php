<?php

/*
 *	Manager f�r alle MySQL Bedingten Funktionen
 */
 
class MySQLMgr
{
	static $c = null;
	
	static function connectDB ($user, $pass, $host)
	{
		$c = mysql_connect($host,$user,$pass);
	}
	
	static function selectDB($db)
	{
		mysql_select_db($db);
	}
	
	static function executeSingle($query)
	{
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		return($row[0]);
	}
	
	static function executeUpdate($query)
	{
		mysql_query($query);
	}
	
	static function executeMulti($query)
	{
		$result = mysql_query($query);
		return($result);
	}
	
	static function closeDB ()
	{
		mysql_close();
	}
}
?>