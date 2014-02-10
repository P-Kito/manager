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

	static function fetchDataStramaAcc($username)
	{
		$query = "SELECT id, pass_hash, rank FROM tbllogin WHERE username='".$username."'";
		return(MySQLMgr::executeMulti($query, true));
	}
	
	static function fetchDataGUID($guid)
	{
		$query = "SELECT username FROM account WHERE id='".$guid."'";
		return(MySQLMgr::executeMulti($query, false));
	}
	
	static function getHistory($guid, $full = true)
	{
		$text = TextMgr::getText('auswirkungen', false);
		if ($full)
			$query = "SELECT id, verwarnstufe, kommentar, datum, creator FROM account_verwarnung WHERE ACCGUID='".$guid."' ORDER BY id";
		else
			$query = "SELECT id, verwarnstufe, kommentar, datum, creator FROM account_verwarnung WHERE ACCGUID='".$guid."' AND datum >= now()-interval 6 month ORDER BY id";
		$result = MySQLMgr::executeMulti($query, false);
		$html = "
		<table cellspacing='0'>
			<thead>
				<tr>
					<th>#</th>
					<th>I</th>
					<th>Verwarnstufe</th>
					<th>Kommentar</th>
					<th>Datum</th>
					<th>Ersteller</th>
				</tr>
			</thead>
			<tbody>";
		$wirkung = explode(';', $text);
		while ($row = mysql_fetch_row($result))
		{
			$date = date('Y-m-d H:i:s', strtotime($row[3]));
			if ($date >= date('Y-m-d H:i:s', time() - 15778463 /* 6 Monate */))
			{
				$html .= "<tr>";
				$html .= "<td>" . $row[0] . "</td>";
				$html .= "<td class=\"info\"></td>";
				$html .= "<td>" . $wirkung[$row[1]-1] . "</td>";
				$html .= "<td>" . $row[2] . "</td>";
				$html .= "<td>" . $row[3] . "</td>";
				$html .= "<td><font color=\"".TextMgr::getText(self::getStramaAccRank($row[4]), false)."\">" . ucfirst(self::getUsernameByStramaAccID($row[4])) . "</font></td>";
				$html .= "</tr>";
			} else {
				$html .= "<tr>";
				$html .= "<td class=\"warn\">" . $row[0] . "</td>";
				$html .= "<td class=\"info\"><img src=\"images/warning.gif\"></td>";
				$html .= "<td class=\"warn\">" . $wirkung[$row[1]-1] . "</td>";
				$html .= "<td class=\"warn\">" . $row[2] . "</td>";
				$html .= "<td class=\"warn\">" . $row[3] . "</td>";
				$html .= "<td class=\"warn\"><font color=\"".TextMgr::getText(self::getStramaAccRank($row[4]), false)."\">" . ucfirst(self::getUsernameByStramaAccID($row[4])) . "</font></td>";
				$html .= "</tr>";			
			}
		}
		if ($html == "") 
			$html .= "<tr><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
		if (self::getLastVerwarnstufe($guid) < 5)
			$html .= "<tr><td>*</td><td>*</td><td>". self::buildStufenSelect(self::getLastVerwarnstufe($guid)) ."</td><td><textarea name=\"kommentar\" maxlength=\"255\"/></textarea></td><td>*</td><td><font color=\"".TextMgr::getText($_SESSION['rank'], false)."\">".$_SESSION['username']."</font></td></tr>";
		$html .= "</tbody></table>";
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

	static function checkExistStramaAcc($username)
	{
		$query = "SELECT id FROM tbllogin WHERE username='".$username."'";
		$result = MySQLMgr::executeSingle($query, true);
		if (!$result)
			return(false);
		else
			return(true);
	}
	
	static function getLastVerwarnstufe($guid)
	{
		$query = "SELECT max(Verwarnstufe) FROM account_verwarnung WHERE ACCGUID = " . $guid . " AND datum >= now()-interval 6 month";
		$result = MySQLMgr::executeSingle($query, false);
		return($result);
	}

	static function buildStufenSelect($lastStufe)
	{
		$html = "<select name=\"stufe\">";
		$text = TextMgr::getText('auswirkungen', false);
		$wirkung = explode(';', $text);
		
		for ($i = $lastStufe+1; $i <= 5; $i++)
		{
			$html .= "<option value=\"".$i."\">(".$i.") ".$wirkung[$i-1]."</option>";
		}
		$html .= "</select>";
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
	
	static function getUsernameByStramaAccID($id)
	{
		$query = "SELECT username FROM tbllogin WHERE id='".$id."'";
		$result = MySQLMgr::executeSingle($query, true);
		return($result);
	}
	
	static function getLastTenBansAsTable()
	{
		$text = TextMgr::getText('auswirkungen', false);
		$wirkung = explode(';', $text);
		$query = "SELECT ac.id, ac.username, av.verwarnstufe, av.kommentar, av.creator, av.datum FROM account_verwarnung av INNER JOIN account ac ON av.accguid = ac.id ORDER BY Datum DESC LIMIT 10";
		$result = MySQLMgr::executeMulti($query, false);
		$html = "<table cellspacing='0'>
				<thead>
					<tr>
						<th>Account ID</th>
						<th>Accountname</th>
						<th>Verwarnstufe</th>
						<th>Kommentar</th>
						<th>Ersteller</th>
						<th>Datum</th>
					</tr>
				</thead>
				<tbody>";
		while ($row = mysql_fetch_row($result))
		{
			$html .= "<tr>";
			$html .= "<td>" . $row[0] . "</td>";
			$html .= "<td>" . $row[1] . "</td>";
			$html .= "<td>" . $wirkung[$row[2]-1] . "</td>";
			$html .= "<td>" . $row[3] . "</td>";
			$html .= "<td><font color=\"".TextMgr::getText(self::getStramaAccRank($row[4]), false)."\">" . ucfirst(self::getUsernameByStramaAccID($row[4])) . "</font></td>";
			$html .= "<td>" . $row[5] . "</td>";
			$html .= "</tr>";
		}
		if ($html == "") 
			$html .= "<tr><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
		$html .= "</tbody>
				</table>";
		return($html);
	}
	
	static function getStramaAccRank($id)
	{
		$query = "SELECT rank FROM tbllogin WHERE id=".$id."";
		$result = MySQLMgr::executeSingle($query, true);
		return($result);
	}
}
?>