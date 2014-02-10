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
		echo "<meta http-equiv=\"refresh\" content=\"0.5; URL=" . $_SERVER['PHP_SELF'].'?p=newissue&guid=' . $accdata[0] ."\">";	
	}
	else
		echo TextMgr::getText('account_not_found', false);
} elseif (isset($_GET["guid"]))
{
	$guid = mysql_real_escape_string($_GET["guid"]);
	if (AccountMgr::checkExistGUID($guid))
	{
		$accdata = AccountMgr::fetchDataGUID($guid);
		$accdata = mysql_fetch_array($accdata);
		/* [0] = USERNAME */
		echo TextMgr::getText('case_header', false, true, array($accdata[0]));
		echo "
		<form class=\"form\" action=\"".$_SERVER['PHP_SELF'].'?p=newissue&ban=ok&guid='.$guid.''."\" method=\"post\" id=\"editacc\">
		".AccountMgr::getHistory($guid)
		.TextMgr::getText('warn_legend', false)
		.TextMgr::getText('info_verwarnungen', false);
		echo "<p class=\"submit\">
				<input type=\"submit\" name=\"edit\" value=\"".TextMgr::getText('account_edit', false)."\" />  
			</p> 
		</form>";
	}
	else
		echo TextMgr::getText('character_not_found', false);
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