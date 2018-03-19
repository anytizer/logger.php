<?php
namespace tests;

require_once("./vendor/autoload.php");

use logger\HeaderLogger;

$hl = new HeaderLogger("/tmp/headers.log"); // headers-xxxxxx.log
$hl->capture();
