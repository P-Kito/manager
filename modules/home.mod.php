<?php
$news = TextMgr::getText('wichtige_news', true);
if ($news != "") echo "<h4>".$news."</h4>";
?>

<?php
echo TextMgr::getText('home_title', false);
echo TextMgr::getText('home_info_lastbans', false);
?>


