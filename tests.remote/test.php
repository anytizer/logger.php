<?php
namespace tests;

require_once("./vendor/autoload.php");

use logger\HeaderLogger;

$hl = new HeaderLogger("d:/headers.log"); // headers-xxxxxx.log
$hl->capture();
