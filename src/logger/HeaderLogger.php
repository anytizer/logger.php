<?php
namespace logger;

class HeaderLogger
{
	private $path;
	private $keys = array(
		"time"   => "REQUEST_TIME",
		"ip"     => "REMOTE_ADDR",
		"scheme" => "REQUEST_SCHEME",
		"method" => "REQUEST_METHOD",
		"uri"    => "REQUEST_URI",
		"https"  => "HTTPS",
		"agent"  => "HTTP_USER_AGENT",
		"token"  => "HTTP_X_AUTHENTICATION",
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
		$bytes = file_put_contents($filename, print_r($values, true), FILE_APPEND|FILE_BINARY);
		
		return $bytes;
	}
	
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
	
	private function values($key="")
	{
		return $_SERVER[$key]??"";
	}
}
