<?php

/*
 *	Manager für Account
 */

class AccountMgr
{
	static function checkExist(string $username)
	{
		$query = "SELECT id FROM account WHERE username='".$username."'";
		if (MySQLMgr::executeSingle($query, false) != "")
			return true;
		else
			return false;
	}

}
?>