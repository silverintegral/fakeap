<?php

if ($_SERVER['HTTP_HOST'] == 'login.kansai-wifi-foundation.jp') {
	// キャプティブポータルの表示
	include('./login3.php');
	exit();
}

header('Location: http://login.kansai-wifi-foundation.jp');
exit();
