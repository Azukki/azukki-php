<?php

namespace Azukki;

class Response {

	public $status  = false;
	public $success = false;
	public $message = false;
	public $tick    = false;

	protected $data = array();

	public function __construct($status)
	{
		$this->status = $status;
	}

	public function load($data)
	{
		$this->data = $data;
	}

	public function __get($key)
	{
		if(array_key_exists($key, $this->data)) {
			return $this->data[$key];
		}
	}

	public function __set($key, $value)
	{
		$this->data[$key] = $value;
	}
}