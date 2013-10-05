<?php

/*
 *	Manager für Account
 */

class AccountMgr
{
	static function fetchData($username)
	{
		$query = "SELECT id FROM account WHERE username='".$username."'";
		return(MySQLMgr::executeMulti($query, false));
	}

	static function fetchDataGUID($guid)
	{
		$query = "SELECT username FROM account WHERE id='".$guid."'";
		return(MySQLMgr::executeMulti($query, false));
	}
	
	static function getHistory($guid, $full = false)
	{
		$text = TextMgr::getText('auswirkungen', false);
		if ($full)
			$query = "SELECT id, verwarnstufe, kommentar, datum FROM account_verwarnung WHERE ACCGUID='".$guid."' ORDER BY id";
		else
			$query = "SELECT id, verwarnstufe, kommentar, datum FROM account_verwarnung WHERE ACCGUID='".$guid."' AND datum >= now()-interval 6 month ORDER BY id";
		$result = MySQLMgr::executeMulti($query, false);
		$html = "";
		$wirkung = split(';', $text);
		if (!$row = mysql_fetch_arry($result))
			$html .= "<tr><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
		else
			while ($row = mysql_fetch_row($result))
			{
				$html .= "<tr>";
				$html .= "<td>" . $row[0] . "</td>";
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
	
	static function checkExistGUID($guid)
	{
		$query = "SELECT id FROM account WHERE id='".$guid."'";
		$result = MySQLMgr::executeSingle($query, false);
		if (!$result)
			return(false);
		else
			return(true);
	}
}
?>