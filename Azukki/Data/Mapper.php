<?php

namespace Azukki\Data;

use ReflectionClass;

class Mapper {

	protected $obj;

	public function __construct($obj, $data)
	{
		$r = new ReflectionClass($obj);

		foreach($data as $k => $v) {
			$newKey = $this->inflectName($k);

			if($r->hasProperty($newKey)) {
				$obj->$newKey = $v;
			}
		}
		
		$this->obj = $obj;
	}

	public function getObj()
	{
		return $this->obj;
	}

	protected function inflectName($name) 
	{
		$tmp = str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
		return substr($name, 0, 1).substr($tmp, 1);
	}
}