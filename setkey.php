<?php
require dirname(dirname(__DIR__)) . '/inc/php/session.php';
error_reporting(0);

foreach($_GET as $k=>$v){  $_GET[$k]  = preg_replace('/\W/', '', $v); }

$projectName = $_GET['project'];
if (!isset($_SESSION[$projectName])) { exit('not logged in?'); }

$lang = $_SESSION[$projectName]['lang'];

$cryptFields = array();
$checkBoxes = '';

if(isset($_GET['killObject']) && isset($_GET['killField']) && $_SESSION[$projectName]['config']['crypt'][$_GET['killObject']][$_GET['killField']]) {
	unset($_SESSION[$projectName]['config']['crypt'][$_GET['killObject']][$_GET['killField']]);
}


foreach ($_SESSION[$projectName]['objects'] as $on => $obj)
{
	foreach($obj['col'] as $fn => $fo)
	{
		if(substr($fn, 0, 2) == 'c_') {
			
			$lbl =	(isset($obj['lang'][$lang]) ? $obj['lang'][$lang] : $on) .' &rArr; '.
					(isset($fo['lang'][$lang]) ? $fo['lang'][$lang] : $fn);
			
			if(isset($_SESSION[$projectName]['config']['crypt'][$on][$fn])) {
				$exst = ' - <a title="delete this Password" href="setkey.php?project='.$projectName.'&killObject='.$on.'&killField='.$fn.'"><img src="img/kill.png" /></a>';
				$check = '';
			}else {
				$exst = '';
				$check = ' checked="checked"';
			}
			
			$checkBoxes .= '<p><input type="checkbox" '.$check.' name="field['.$on.']['.$fn.']" value="1" /> '.$lbl . $exst.'</p>';
			$cryptFields[] = array($on, $fn);
		}
	}
}

if (count($cryptFields) == 0)
{
	exit('no encryptable Fields found');
}

$message = '';

if ($_POST['myPassword'])
{
	$message = 'password saved';
	foreach($_POST['field'] as $on => $obj)
	{
		foreach($obj as $fn => $x)
		{
			//echo $pn.'/'.$fn;
			$_SESSION[$projectName]['config']['crypt'][$on][$fn] = trim($_POST['myPassword']);
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>set Passwords</title>
<meta charset="utf-8" />
<!-- use the common password-generator -->
<script src="../../inc/js/gpw.js"></script>
<style>
body{
	background:#eee;
	font-family:sans-serif;
	font-size:.9em;
}
#frm {
	position: absolute;
	width:400px;
	top:30px;
	left:50%;
	margin-left:-200px;
}
#message{color:green;}
#frm span {color:purple;}
</style>
</head>
<body>

<form id="frm" action="setkey.php?project=<?php echo $projectName;?>" method="post">
	<div id="message"><?php echo $message;?></div>
	<p>Password:<br /><input type="password" id="myPassword" name="myPassword" /></p>
	Fields
	<?php echo $checkBoxes;?>
	<input type="submit" value="ok" />
	<hr />
	<input type="text" readonly="readonly" id="newpass" /><br />
	<input type="button" onclick="generatePassword('pronounceable')" value="generate pronouncable Password" />
	<input type="button" onclick="generatePassword('complex')" value="generate classic Password" />
</form>

<script>
function generatePassword (type)
{
	var l = prompt('enter password length', 10);
	if(l)
	{
		document.getElementById('newpass').value = GPW[type](parseInt(l));
	}
}

window.setTimeout(function(){document.getElementById('myPassword').value='';},1000);
</script>
</body>
</html>
