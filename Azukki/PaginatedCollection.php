<?php

namespace Azukki;

class PaginatedCollection extends Collection {

	protected $client;
	protected $count;
	protected $prevUri;
	protected $nextUri;

	public function __construct($client, $meta)
	{
		parent::__construct();

		$this->client = $client;
		
		$this->count   = $meta['count'];
		$this->prevUri = $meta['prev_uri'];
		$this->nextUri = $meta['next_uri'];
	}

	public function getCount()
	{
		return $this->count;
	}

	public function getPrevUri()
	{
		return $this->prevUri;
	}

	public function getNextUri()
	{
		return $this->nextUri;
	}
}