<?php

namespace UrlMonitor;

use InvalidArgumentException;
use RuntimeException;
use UrlMonitor\Output\Console;
use UrlMonitor\Tools\Cookies;
use \UrlMonitor\Tools\PublicIP;

class Monitor
{
	private $info
		= [
			"CURLINFO_HTTP_CODE",
			"CURLINFO_NAMELOOKUP_TIME",
			"CURLINFO_CONNECT_TIME",
			"CURLINFO_APPCONNECT_TIME",
			"CURLINFO_PRETRANSFER_TIME",
			"CURLINFO_STARTTRANSFER_TIME",
			"CURLINFO_TOTAL_TIME"
		];

	private $sleepTime = 5;

	public function run($domain)
	{
		$Console = new Console();

		if (!is_string($domain) or !preg_match("%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i", $domain)) {
			throw new InvalidArgumentException('Invalid Domain:' . $domain);
		}

		$Console->logLine("--- URL Monitoring " . date('Y-m-d H:i:s') . " ---");
		$Console->logLine("Url : " . $domain);
		$Console->logLine("Public IPv4: " . PublicIP::get('v4'));
		$Console->logLine("Public IPv6: " . PublicIP::get('v6'));
		$Console->logLine("----------");

		$lineNumber = 0;

		while (true) {
			$dataSet = $this->getResponse($domain);

			if (!$dataSet) {
				throw new RuntimeException('Invalid curl response');
			} else {
				$lineNumber++;

				if ($lineNumber == 1) {
					$Console->logCell(array_keys($dataSet));
				} elseif ($lineNumber == 10) {
					$lineNumber = 0;
				}

				$Console->logCell($dataSet);

				sleep($this->sleepTime);
			}
		}
	}

	private function getResponse($domain)
	{
		if (!defined("COOKIE_FILE")) {
			define("COOKIE_FILE", "../tmp/cookie_" . md5($domain) . ".txt");

			if (file_exists(COOKIE_FILE)) {
				unlink(COOKIE_FILE);
			}
		}

		$userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
		$sessionIdCookieName = "PHPSESSID";
		$loadBalancerCookieName = "AlteonP";

		$handle = curl_init($domain);
		if ($handle) {
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($handle, CURLOPT_HEADER, 1);
			curl_setopt($handle, CURLOPT_COOKIEJAR, COOKIE_FILE);
			curl_setopt($handle, CURLOPT_COOKIEFILE, COOKIE_FILE);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($handle, CURLOPT_TIMEOUT, 1000);
			curl_setopt($handle, CURLOPT_USERAGENT, $userAgent);

			$response = curl_exec($handle);

			$cookies = Cookies::get($response);

			$dataSet = [];
			$dataSet['date'] = date('Y-m-d H:i:s');

			foreach ($this->info as $lineInfo) {
				$dataSet[$lineInfo] = curl_getinfo($handle, constant($lineInfo));
			}

			$dataSet[$sessionIdCookieName] = (isset($cookies[$sessionIdCookieName])) ? $cookies[$sessionIdCookieName] : "";

			$dataSet[$loadBalancerCookieName] = (isset($cookies[$loadBalancerCookieName])) ? $cookies[$loadBalancerCookieName] : "";

			return $dataSet;
		} else {
			return false;
		}
	}
}
