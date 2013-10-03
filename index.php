<?php
session_start();

require_once('conf/site.conf.php');
require_once('includes/MySQLMgr.class.php');
require_once('includes/StyleMgr.class.php');
require_once('includes/TextMgr.class.php');

MysqlMgr::connectDB(CONFIG::USERNAME, CONFIG::PASSWORD, CONFIG::HOSTNAME);
MysqlMgr::selectDB(CONFIG::DB1, CONFIG::DB2);

// Kein GET Variable ist automatisch home
if (isset($_GET["p"]))
{
$p = $_GET["p"];
} else {
$p = "home";
}
?>

<?php
include('modules/header.mod.php');
echo StyleMgr::loadPage($p);
include('modules/footer.mod.php');
?>