<?php
session_start();
ini_set( 'error_reporting', E_ALL ^ E_NOTICE );

require_once('conf/site.conf.php');
require_once('includes/MySQLMgr.class.php');
require_once('includes/StyleMgr.class.php');
require_once('includes/TextMgr.class.php');
require_once('includes/AccountMgr.class.php');

MysqlMgr::connectDB(CONFIG::USERNAME, CONFIG::PASSWORD, CONFIG::HOSTNAME);

if (isset($_GET["p"]))
	$p = $_GET["p"];
else
	$p = "home";
?>

<?php
require_once('modules/header.mod.php');
echo StyleMgr::loadPage($p);
require_once('modules/footer.mod.php');
?>