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
?>
<table cellspacing='0'>

	<!-- Table Header -->
	<thead>
		<tr>
			<th>Task Details</th>
			<th>Progress</th>
			<th>Vital Task</th>
		</tr>
	</thead>
	<!-- Table Header -->

	<!-- Table Body -->
	<tbody>

		<tr>
			<td>Create pretty table design</td>
			<td>100%</td>
			<td>Yes</td>
		</tr><!-- Table Row -->

		<tr class="even">
			<td>Take the dog for a walk</td>
			<td>100%</td>
			<td>Yes</td>
		</tr><!-- Darker Table Row -->

		<tr>
			<td>Waste half the day on Twitter</td>
			<td>20%</td>
			<td>No</td>
		</tr>

		<tr class="even">
			<td>Feel inferior after viewing Dribble</td>
			<td>80%</td>
			<td>No</td>
		</tr>

		<tr>
			<td>Wince at "to do" list</td>
			<td>100%</td>
			<td>Yes</td>
		</tr>

		<tr class="even">
			<td>Vow to complete personal project</td>
			<td>23%</td>
			<td>yes</td>
		</tr>

		<tr>
			<td>Procrastinate</td>
			<td>80%</td>
			<td>No</td>
		</tr>

		<tr class="even">
			<td><a href="#yep-iit-doesnt-exist">Hyperlink 	Example</a></td>
			<td>80%</td>
			<td><a href="#inexistent-id">Another</a></td>
		</tr>

	</tbody>
	<!-- Table Body -->

</table>
<?php
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