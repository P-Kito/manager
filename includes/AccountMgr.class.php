<?php

/*
 *	Manager für Account
 */

class AccountMgr
{
	static function checkExist($username)
	{
		$query = "SELECT id FROM account WHERE username='".$username."'";
		$result = MySQLMgr::executeSingle($query, false);
		if (!$result)
			die(TextMgr::getText('internal_error', false));
		if ($result == "")
			return(false);
		else
			return(true);
	}

}
?>