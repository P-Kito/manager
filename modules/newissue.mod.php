<?php
if (isset($_GET["ban"]) && isset($_POST["edit"]))
{
	$guid = mysql_real_escape_string($_GET["guid"]);
	$kommentar = mysql_real_escape_string($_POST["kommentar"]);
	$query = "INSERT INTO account_verwarnung VALUES(".$guid.", '', ".$_POST["stufe"].", '".$kommentar."', '".date("Y-m-d H:i:s")."', 0)";
	MySQLMgr::executeUpdate($query, false);
	if ($result)
		echo TextMgr::getText('verwarnung_ok', false, true, array($_GET["guid"], $_POST["stufe"], $_POST["kommentar"]));
	else
		echo TextMgr::getText('internal_error', false);
}
if (isset($_POST["send"]))
{
	$username = mysql_real_escape_string($_POST["name"]);
	if (AccountMgr::checkExist($username))
	{
		$accdata = AccountMgr::fetchData($username);
		$accdata = mysql_fetch_array($accdata);
		/* [0] = GUID */
		echo TextMgr::getText('case_header', false, true, array($username));
		echo "
		<form class=\"form\" action=\"".$_SERVER['PHP_SELF'].'?p=newissue&ban=ok&guid='.$accdata[0].''."\" method=\"post\" id=\"editacc\">
		<table cellspacing='0'>
			<thead>
				<tr>
					<th>#</th>
					<th>Verwarnstufe</th>
					<th>Kommentar</th>
					<th>Datum</th>
				</tr>
			</thead>
			<tbody>
			".AccountMgr::getHistory($accdata[0])."
			</tbody>
		</table>
		<br />";
?>
			<p class="submit">
				<input type="submit" name="edit" value="<?php echo TextMgr::getText('account_edit', false); ?>" />  
			</p> 
		</form>
<?php		
	}
	else
		echo TextMgr::getText('account_not_found', false);
} else {
echo TextMgr::getText('titel_newissue', false);
echo TextMgr::getText('new_issue', false);
?>
<form class="form" action="<?php echo $_SERVER['PHP_SELF'].'?p=newissue'; ?>" method="post" id="searchacc">
    <p class="name">  
        <input type="text" name="name" id="name" />
        <label for="name">Accountname</label>
    </p>
    <p class="submit">  
        <input type="submit" name="send" value="<?php echo TextMgr::getText('account_search', false); ?>" />  
    </p> 
</form>
<?php
}
?>