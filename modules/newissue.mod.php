<?php
echo TextMgr::getText('new_issue', false);

if (isset($_POST["send"]))
{
	$username = mysql_real_escape_string($_POST["name"]);
	if (AccountMgr::checkExist($username))
	{
		$accdata = AccountMgr::fetchData($username);
		$accdata = mysql_fetch_array($accdata);
		/* [0] = GUID // [1] = LAST_IP // [2] = username*/
		echo TextMgr::getText('character_found', false, true, array($accdata[2], $accdata[0]));
echo "
<table cellspacing='0'>
	<thead>
		<tr>
			<th>ID</th>
			<th>Accountname</th>
			<th>Verwarnstufe</th>
			<th>Kommentar</th>
			<th>Letzte &Auml;nderung</th>
			<th>Anzahl der &Auml;nderungen</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>".$accdata[0]."</td>
			<td>".$accdata[2]."</td>
			<td>Kommt noch</td>
			<td>Kommt noch</td>
			<td>Kommt noch</td>
			<td>Kommt noch</td>
		</tr>
	</tbody>
</table>
";
	}
	else
		echo TextMgr::getText('character_not_found', false);
} else {
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