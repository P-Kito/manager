<?php
if (isset($_POST["send"]))
{
	echo TextMgr::getText('player_info', false);
	$username = mysql_real_escape_string($_POST["name"]);
	if (AccountMgr::checkExist($username))
	{
		$accdata = AccountMgr::fetchData($username);
		$accdata = mysql_fetch_array($accdata);
		/* [0] = GUID */
		echo TextMgr::getText('case_header', false, array($username));
		echo "
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
		";
	}
	else
		echo TextMgr::getText('character_not_found', false);
} else {
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