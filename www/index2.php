<?php
//ini_set('display_errors', true);
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

// 偽装ログインページ
if ($_SERVER['HTTP_HOST'] == 'login.ssid.setting') {
	include('./login2.php');
	exit();
} else {
	header('Location: http://login.ssid.setting');
	exit();
}

