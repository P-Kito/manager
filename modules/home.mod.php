<?php
if (!isset($_SESSION['login']))
	echo TextMgr::getText('login_error', false);
else {
$news = TextMgr::getText('wichtige_news', true);
if ($news != "") echo "<h4>".$news."</h4>";

echo TextMgr::getText('home_title', false, true, $_SESSION['username']);
echo TextMgr::getText('home_info_lastbans', false);

echo AccountMgr::getLastTenBansAsTable();
}
?>


