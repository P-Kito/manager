<?php
$_SESSION = array();
session_destroy();
echo "<meta http-equiv=\"refresh\" content=\"1.5; URL=" . $_SERVER['PHP_SELF']."?p=login\">";
echo TextMgr::getText('logout_success', false);
?>