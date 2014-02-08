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
			echo "<meta http-equiv=\"refresh\" content=\"0.5; URL=" . $_SERVER['PHP_SELF']."?p=home\">";
			$_SESSION['login'] = true;
			$_SESSION['rank'] = TextMgr::getText($accdata[2], false;
			$_SESSION['username'] = $username;
		}
		else
			echo TextMgr::getText('login_failed', false);
	} else
		echo TextMgr::getText('login_failed', false);
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
        <input type="password" name="password" id="password" />
        <label for="password"><?php echo TextMgr::getText('login_password', false); ?></label>
    </p>
    <p class="submit">  
        <input type="submit" name="send" value="<?php echo TextMgr::getText('login_confirm', false); ?>" />  
    </p> 
</form>