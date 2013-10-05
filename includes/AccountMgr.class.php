<?php

/*
 *	Manager für Account
 */

class AccountMgr
{
	static function fetchData($username)
	{
		$query = "SELECT id, last_ip FROM account WHERE username='".$username."'";
		return(MySQLMgr::executeMulti($query, false));
	}

	static function checkExist($username)
	{
		$query = "SELECT id FROM account WHERE username='".$username."'";
		$result = MySQLMgr::executeSingle($query, false);
		if (!$result)
			return(false);
		else
			return(true);
	}
}
?>