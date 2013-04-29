<?php

namespace Azukki;

class Profile extends Resource {

	public function profile()
	{
		return $this->client->get('/profile');
	}

	public function coinsBalance()
	{
		return $this->client->get('/profile/coins/balance');
	}

	public function coinsCredit($coins)
	{
		$data = array(
			'coins' => $coins
		);
		return $this->client->post('/profile/coins/balance', $data);
	}
}