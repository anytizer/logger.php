# logger.php

Various purpose PHP Logger


## Installation

Use one of:

	composer require anytizer/logger.php:dev-master
	composer global require anytizer/logger.php:dev-master

## Usage

	<?php
	require_once("vendor/autoload.php");

	use logger\HeaderLogger;

	$hl = new HeaderLogger("/tmp/headers.log");
	$hl->capture();
