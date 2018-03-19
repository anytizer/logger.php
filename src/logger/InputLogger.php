<?php
namespace logger;

class InputLogger
{
	/**
	 * Where to save the log file
	 */
	private $path;
	
	private $keys = array(
		"time"   => "REQUEST_TIME",
		"uri"    => "REQUEST_URI",
	);

	public function __construct($path="")
	{
		$this->path = $path;
		
		array_walk($this->keys, array($this, "nonempty"));
	}
	
	public function capture(): int
	{
		$filename = $this->filename();
		
		$values = array_map(array($this, "values"), $this->keys);
		$values["get"] = $_GET;
		$values["post"] = $_POST;
		$bytes = file_put_contents($filename, print_r($values, true), FILE_APPEND|FILE_BINARY);
		
		return $bytes;
	}
	
	/**
	 * Log filename handler
	 */
	private function filename()
	{
		$filename = $this->path;
		$paths = pathinfo($filename);
		$paths["timestamp"] = date("Ymdh", $_SERVER["REQUEST_TIME"]);
		$filename = "{$paths['dirname']}/{$paths['filename']}-{$paths['timestamp']}.{$paths['extension']}";
		
		return $filename;
	}
	
	private function nonempty($key="")
	{
		if(empty($_SERVER[$key]))
		{
			$_SERVER[$key] = "";
		}
		
		return $_SERVER[$key];
	}
	
	private function values($key=""): string
	{
		return $_SERVER[$key]??"";
	}
}
