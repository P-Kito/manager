<?php
echo TextMgr::getText('new_issue', false);

if (isset($_POST["send"]))
{
	$username = mysql_real_escape_string($_POST["name"]);
	if (AccountMgr::checkExist($username))
		echo TextMgr::getText('character_found', false);
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