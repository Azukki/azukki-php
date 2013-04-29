<?php

spl_autoload_register(function ($classname) {
	$ds     = DIRECTORY_SEPARATOR;
	$vendors = array(
		__DIR__.$ds,
		__DIR__.$ds.'vendor'.$ds
	);

	foreach($vendors as $vendor) {
		$file = $vendor.str_replace('\\', $ds, $classname).'.php';

		if(file_exists($file)) {
	    	include $file;
	    }
	}
});