<?php

namespace UrlMonitor\Tools;

class Cookies
{
	public static function get($curlResponse)
	{
		$matches = array();
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $curlResponse, $matches);
		$cookies = array();
		foreach ($matches[1] as $item) {
			parse_str($item, $cookie);
			$cookies = array_merge($cookies, $cookie);
		}
		return $cookies;
	}

}
