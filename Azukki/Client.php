<?php

namespace Azukki;

use Azukki\Model\AuthToken;

class Client {

	protected $apiKey;
	protected $apiSecret;
	protected $gameKey;
	protected $baseUrl;

	protected $authToken;

	protected $client;

	public $players;
	public $profile;
	public $actions;
	public $item;
	public $leaderboards;

	public function __construct($apiKey, $apiSecret, $gameKey, $baseUrl='http://api.azukki.com/v1')
	{
		$this->apiKey    = $apiKey;
		$this->apiSecret = $apiSecret;
		$this->gameKey   = $gameKey;
		$this->baseUrl   = $baseUrl;

		$this->client = $this->createRestClient();
		$this->initResources();
	}

	public function setPlayerAuth($token)
	{
		$this->authToken = $token;

		$this->client->addHeader('X-AuthToken: '.$token);
	}

	public function ping()
	{
		return $this->client->get('/ping');
	}

	protected function createRestClient()
	{
		$headers = array(
			'X-ApiKey: '   .$this->apiKey,
			'X-ApiSecret: '.$this->apiSecret,
			'X-GameKey: '  .$this->gameKey
		);

		return new AzukkiPestJSON($this->baseUrl, $headers);
	}

	protected function initResources()
	{
		$this->players      = new Players($this->client);
		$this->profile      = new Profile($this->client);
		$this->achievements = new Achievements($this->client);
		$this->actions      = new Actions($this->client);
		$this->items        = new Items($this->client);
		$this->leaderboards = new Leaderboards($this->client);
	}
}