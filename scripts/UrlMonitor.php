<?php

require_once "../libs/Tools/PublicIP.php";
require_once "../libs/Tools/Cookies.php";

require_once "../libs/Output/Console.php";

require_once "../libs/Monitor.php";

$Monitor = new \UrlMonitor\Monitor();

$Monitor->run($argv[1]);


