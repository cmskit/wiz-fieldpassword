<?php
require dirname(dirname(__DIR__)) . '/inc/php/session.php';
error_reporting(0);
$projectName = preg_replace('/\W/', '', $_GET['project']);
$objectName = preg_replace('/\W/', '', $_GET['object']);
$objectId = preg_replace('/\W/', '', $_GET['objectId']);

if (!isset($_SESSION[$projectName])) { exit('not logged in?'); }
if (!isset($_SESSION[$projectName]['objects'][$objectName])) { exit('Object not accessible!'); }
if (!isset($_SESSION[$projectName]['objects'][$objectName]['col'][$_POST['fieldName']])) { exit('Field not accessible!'); }

$LL = array();
@include 'locales/'.$_GET['lang'].'.php';
function L($s) {
	global $LL;
	return (isset($LL[$s]) ? $LL[$s] : str_replace('_',' ',$s));
}

$message = '';

if (!empty($_POST['fieldName']) && !empty($_POST['myPassword']))
{
	$message = L('Password_registered');
	$_SESSION[$projectName]['config']['crypt'][$objectName][$_POST['fieldName']] = trim($_POST['myPassword']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>set Password</title>
<meta charset="utf-8" />

<style>
body{
	background:#eee;
	font-family:sans-serif;
}
#frm {
	position: absolute;
	width:360px;
	top:50%;
	left:50%;
	margin-left:-180px;
}
</style>
</head>
<body>
<form id="frm" action="index.php?<?php echo http_build_query($_GET);?>" method="post">
	<div id="message"><?php echo $message;?></div>
	<input type="hidden" id="fieldName" name="fieldName" value="<?php echo $objectId;?>" />
	<label><?php echo L('Password')?>:</label><input type="password" id="myPassword" name="myPassword" />
	<input type="submit" value="set" />
</form>

<script>
window.setTimeout(function()
{
	// clear the Password-Field
	document.getElementById('myPassword').value = '';
},1000);
</script>
</body>
</html>
