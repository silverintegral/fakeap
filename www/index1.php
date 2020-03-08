<?php
//ini_set('display_errors', true);
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

if ($_SERVER['HTTP_HOST'] == 'login.kansai-wifi-foundation.jp') {
	// キャプティブポータルの表示
	include('./login1.php');
	exit();
} else if ($_SERVER['HTTP_HOST'] == 'connectivitycheck.gstatic.com'
	|| $_SERVER['HTTP_HOST'] == 'captive.apple.com'
	|| $_SERVER['HTTP_HOST'] == 'connectivitycheck.gstatic.com') {
		// キャプティブポータルへリダイレクト
		header('Location: http://login.kansai-wifi-foundation.jp');
	exit();
}
exit();

// IPベースは無視
if (preg_match('/^[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+$/', $_SERVER['HTTP_HOST']) == 1) {
	//passthru(file_get_contents('https://google.com'));
	exit();
}

$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// 認証後はHTTPアクセスをパススルー
$opts['http']['method'] = $_SERVER['REQUEST_METHOD'];
$opts['http']['follow_location'] = false;
$opts['http']['ignore_errors'] = true;
$opts['http']['header'] = "Connection: Close\r\n";

foreach (apache_request_headers() as $key => $val) {
	if ($key == 'Connection')
		continue;
	if ($key == 'Upgrade-Insecure-Requests')
		continue;
	if ($key == 'Accept-Encoding')
		$val = 'aaa';

	$val = str_replace('http://', 'https://', $val);
	$opts['http']['header'] .= $key . ': ' . $val . "\r\n";
}

if (isset($_POST) && count($_POST)) {
	$opts['http']['content'] = http_build_query($_POST, '', '&');
}

$opts['ssl']['verify_peer'] = false;
$opts['ssl']['verify_peer_name'] = false;

//var_dump($opts['http']['header']);

$con = stream_context_create($opts);

clearstatcache();
if (!$fp = fopen($url, 'r', false, $con)) {
	echo 'SSL ERR';
	exit();
}

stream_set_blocking($fp, true);

$head = @stream_get_meta_data($fp);
$body = @stream_get_contents($fp);
@fclose($fp);
if (!$head) {
	exit();
}

$cookie = '';

foreach ($head['wrapper_data'] as $val) {
	if (strpos(strtolower($val), 'strict-transport-security:') === 0)
		continue;
	if (strpos(strtolower($val), 'content-security-policy:') === 0)
		continue;
	if (strpos(strtolower($val), 'set-cookie:') === 0)
		$cookie = substr($val, 11);
	if (strpos(strtolower($val), 'location:') === 0) {
		header(str_replace('https://', 'http://', $val));
		continue;
	}

	header($val);
}
//header('Connection: Close');


if (strpos($head['wrapper_data']['Content-Type'], 'text/') !== 0) {
	header('Content-Length: ' . strlen($body));
	echo $body;
	exit();
}


$body = str_replace(array('https://', 'https:\/\/', 'https%3A%2F%2F'), array('http://', 'http:\/\/', 'http%3A%2F%2F'), $body);
header('Content-Length: ' . strlen($body));
echo $body;
