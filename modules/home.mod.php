<?php
$news = TextMgr::getText('wichtige_news', true);
if ($news != "") echo "<h4>".$news."</h4>";
?>
<h1>Willkommen im StraMa!</h1>

<br />
<br />
<?php echo TextMgr::getText('home_introduction', false); ?>

