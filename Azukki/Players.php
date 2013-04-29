<?php

namespace Azukki;

use Azukki\Model\Player;

class Players extends Resource {

	public function create(Player $player)
	{
		$data = array(
			'key'    => $player->key,
			'secret' => $player->secret,
			'label'  => $player->label
		);

		return $this->client->post('/players/create', $data);
	}

	public function profile($key)
	{
		$uri = '/players/'.$key.'/profile';
		return $this->client->get($uri);
	}

	public function login($playerKey, $playerSecret)
	{
		$data = array(
			'key'    => $playerKey,
			'secret' => $playerSecret
		);

		return $this->client->post('/players/login', $data);
	}

	public function channel($key)
	{
		$uri = '/players/'.$key.'/channel';
		return $this->client->get($uri);
	}
}