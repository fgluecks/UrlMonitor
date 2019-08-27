<?php

namespace UrlMonitor\Tools;

class PublicIP
{
	public static function get($ipType = 'v4')
	{
		$userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://www.wieistmeineip.de");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		if ($ipType != 'v6') {
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			$pattern = '/([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})/';
		} else {
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V6);
			$pattern = '/([a-z0-9]{3,4}\:[a-z0-9]{3,4}\:[a-z0-9]{3,4}\:[a-z0-9]{3,4}\:[a-z0-9]{3,4}\:[a-z0-9]{3,4}\:[a-z0-9]{3,4}\:[a-z0-9]{3,4})/';
		}

		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		$output = curl_exec($ch);

		$matches = array();

		preg_match($pattern, $output, $matches);

		$yourIP = 'N/A';
		if (count($matches) > 1) {
			$yourIP = $matches[1];
		}

		curl_close($ch);

		return $yourIP;
	}
}
