<?php
session_destroy();
echo "<meta http-equiv=\"refresh\" content=\"0.5; URL=" . $_SERVER['PHP_SELF']."?p=login\">";
?>