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
		$wirkung = explode(';', $text);
		while ($row = mysql_fetch_row($result))
		{
			$html .= "<tr>";
			$html .= "<td>" . $row[0] . "</td>";
			$html .= "<td>" . $wirkung[$row[1]-1] . "</td>";
			$html .= "<td>" . $row[2] . "</td>";
			$html .= "<td>" . $row[3] . "</td>";
			$html .= "</tr>";
		}
		if ($html == "") 
			$html .= "<tr><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
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

	static function getLastVerwarnstufe($guid)
	{
		$query = "SELECT max(Verwarnstufe) FROM account_verwarnung WHERE ACCGUID = " . $guid;
		$result = MySQLMgr::executeSingle($query, false);
		return($result);
	}

	static function buildStufenSelect($lastStufe)
	{
		$html = "";
		$text = TextMgr::getText('auswirkungen', false);
		$wirkung = explode(';', $text);
		
		for ($i = $lastStufe+1; $i <= 5; $i++)
		{
			$html .= "<option value=\"\">  </option>";
		}
		return($html);
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