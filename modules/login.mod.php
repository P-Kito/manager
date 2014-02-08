<?php
if (isset($_POST["send"]))
{
	$username = mysql_real_escape_string($_POST["name"]);
	$password = sha1(mysql_real_escape_string($_POST["password"]));

	if (AccountMgr::checkExistStramaAcc($username))
	{
		$accdata = AccountMgr::fetchDataStramaAcc($username);
		$accdata = mysql_fetch_array($accdata);
		/*
		 *  $accdata[0] = id
		 *	$accdata[1] = passhash
		 *	$accdata[2] = rank
		 */
		if ($password == $accdata[1])
		{
			echo TextMgr::getText('login_success', false);
		} else {
			echo TextMgr::getText('login_failed', false);
		}
	}
}
?>
<?php
echo TextMgr::getText('login_menu', false);
?>

<form class="form" action="<?php echo $_SERVER['PHP_SELF'].'?p=login'; ?>" method="post" id="login">
    <p class="name">  
        <input type="text" name="name" id="name" />
        <label for="name"><?php echo TextMgr::getText('login_username', false); ?></label>
    </p>
    <p class="password">  
        <input type="text" name="password" id="password" />
        <label for="password"><?php echo TextMgr::getText('login_password', false); ?></label>
    </p>
    <p class="submit">  
        <input type="submit" name="send" value="<?php echo TextMgr::getText('login_confirm', false); ?>" />  
    </p> 
</form>