<?php

/*
 *	Manager f�r Account
 */

class AccountMgr
{
	static function fetchData($username)
	{
		$query = "SELECT id FROM account WHERE username='".$username."'";
		return(MySQLMgr::executeMulti($query, false));
	}

	static function getHistory($guid)
	{
		$text = TextMgr::getText('auswirkungen', false);
		$query = "SELECT id, verwarnstufe, kommentar, datum FROM account_verwarnung WHERE ACCGUID='".$guid."' ORDER BY id";
		$result = MySQLMgr::executeMulti($query, false);
		$html = "";
		while ($row = mysql_fetch_row($result))
		{
			$html .= "<tr>";
			$html .= "<td>" . $row[0] . "</td>";
			$wirkung = split(';', $text);
			$html .= "<td>" . $wirkung[$row[1]-1] . "</td>";
			$html .= "<td>" . $row[2] . "</td>";
			$html .= "<td>" . $row[3] . "</td>";
			$html .= "</tr>";
		}
		return($html);
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