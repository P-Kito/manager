<?php

/*
 *	Manager für Account
 */

class AccountMgr
{
	static function checkExist(string $username)
	{
		$query = "SELECT id FROM account WHERE username='".$username."'";
		$result = MySQLMgr::executeSingle($query, false);
		if ($result != "")
			return true;
		else
			return false;
	}

}
?>