<?php

use UrlMonitor\Monitor;

require_once "../libs/Tools/PublicIP.php";
require_once "../libs/Tools/Cookies.php";

require_once "../libs/Output/Console.php";

require_once "../libs/Monitor.php";

$Monitor = new Monitor();

if (isset($argv[1])) {
	$domain = filter_var($argv[1], FILTER_SANITIZE_STRING);
} else {
	throw new InvalidArgumentException("Empty Domain Parameter - Example: php UrlMonitor.php www.github.com' ");
}

$Monitor->run($domain);
