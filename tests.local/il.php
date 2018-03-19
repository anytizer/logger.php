<?php
namespace tests;

require_once("./vendor/autoload.php");

use logger\InputLogger;

$il = new InputLogger("/tmp/input.log");
$il->capture();
