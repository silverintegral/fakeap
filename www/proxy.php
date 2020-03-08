<?php header('Content-Type: application/x-ns-proxy-autoconfig'); ?>
function FindProxyForURL(url, host) {
	if (host == 'localhost' || host == '127.0.0.1')
		return 'DIRECT';
	else if (host.endsWith('.onion'))
		return 'SOCKS5 127.0.0.1:9050';
	else if (host.endsWith('.i2p'))
		return 'PROXY 127.0.0.1:4444';
	else
		return 'DIRECT';
}

