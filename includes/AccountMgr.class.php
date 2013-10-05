<?php

/*
 *	Manager für Account
 */

class AccountMgr
{
	static function checkExist($username)
	{
		$query = "SELECT id FROM account WHERE username='".$username."'";
		$result = MySQLMgr::executeSingle($query);
		if ($result != "")
			return true;
		else
			return false;
	}

}
?>