<?php
if (isset($_GET["ban"]) && isset($_POST["edit"]))
{
	$guid = mysql_real_escape_string($_GET["guid"]);
	$kommentar = mysql_real_escape_string($_POST["kommentar"]);
	if ($kommentar == "")
		$kommentar = TextMgr::getText('ban_reason_if_noReason', false, true, array($_POST["stufe"]));
	$query = "INSERT INTO account_verwarnung VALUES(".$guid.", '', ".$_POST["stufe"].", '".$kommentar."', ".$_SESSION['id'].",'".date("Y-m-d H:i:s")."', 0)";
	$result = MySQLMgr::executeUpdate($query, false);
	if ($result)
		echo TextMgr::getText('verwarnung_ok', false, true, array($guid, $_POST["stufe"], $kommentar));
	else
		echo TextMgr::getText('internal_error', false);
}

if (!isset($_SESSION['login']))
{
	echo TextMgr::getText('login_error', false);
} elseif (isset($_POST["send"]))
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
		".AccountMgr::getHistory($accdata[0])
		 .TextMgr::getText('info_verwarnungen', false)."
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
}
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