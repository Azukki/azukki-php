<?php

namespace Azukki;

class Resource {

	protected $client;

	public function __construct(AzukkiPestJSON $client) 
	{
		$this->client = $client;
	}
}