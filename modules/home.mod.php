<?php
$news = TextMgr::getText('wichtige_news', true);
if ($news != "") echo "<h4>".$news."</h4>";
?>

<?php
echo TextMgr::getText('home_title', false);
echo TextMgr::getText('home_info_lastbans', false);

echo "
<table cellspacing='0'>
	<thead>
		<tr>
			<th>Account ID</th>
			<th>Name</th>
			<th>Verwarnstufe</th>
			<th>Kommentar</th>
			<th>Datum</th>
		</tr>
	</thead>
	<tbody>
		".AccountMgr::getLastTenBans()."
	</tbody>
</table>
		";
?>


