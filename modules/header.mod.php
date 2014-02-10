<!DOCTYPE html>
<html>
<head>
	<title>StraMa Laenalith</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<!--[if gte IE 5.5]>
    <style type="text/css">@import url(ie.css);</style>
	<![endif]-->
</head>
<body>
<div id="center">
<div id="shadowbox">
<div id="logobox">
</div>
<div id="content-menu"> 
<div id="menu">
<div id='cssmenu'>
<ul>
<?php
if (isset($_SESSION['login']))
{
?>
   <li <?php if ($p == "home") echo "class=\"active\""; ?>><a href='index.php?p=home'><span><?php echo TextMgr::getText('menu_home', false); ?></span></a></li>
   <li <?php if ($p == "newissue") echo "class=\"active\""; ?>><a href='index.php?p=newissue'><span><?php echo TextMgr::getText('menu_newissue', false); ?></span></a></li>
   <li <?php if ($p == "logout") echo "class=\"active\""; ?>><a href='index.php?p=logout'><span><?php echo TextMgr::getText('menu_logout', false); ?></span></a></li>
   <?php
} else {
?>
   <li <?php if ($p == "login") echo "class=\"active\""; ?>><a href='index.php?p=login'><span><?php echo TextMgr::getText('menu_login', false); ?></span></a></li>
<?php
}
?>
</ul>
</div>
</div>
</div>
<div id="content">