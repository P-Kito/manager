<?php

/*
 *	Manager f�r Account
 */

class AccountMgr
{
	static function checkExist($username)
	{
		$query = "SELECT id FROM account WHERE username='".$username."'";
		$result = MySQLMgr::executeSingle($query, true);
		if (!$result)
			die('Invalid query: ' . mysql_error());
		if ($result == "")
			return(false);
		else
			return(true);
	}

}
?>