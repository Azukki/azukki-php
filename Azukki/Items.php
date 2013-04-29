<?php

namespace Azukki;

use Azukki\Model\Item;
use Azukki\Model\ProfileItem;
use Azukki\Data\Mapper;

class Items extends Resource {

	public function getAll()
	{
		$response = $this->client->get('/items');
		$itemObjects = new Collection;

		if($response->success === true) {
			foreach($response->items as $item) {
				$obj = new Item;
				$map = new Mapper($obj, $item);
				$itemObjects->append($map->getObj());
			}
			$response->items = $itemObjects;
		}

		return $response;
	}

	public function getProfileList()
	{
		$response = $this->client->get('/items/profile_list');
		$itemObjects = new Collection;

		if($response->success === true) {
			foreach($response->items as $item) {
				$obj = new ProfileItem;
				$map = new Mapper($obj, $item);
				$itemObjects->append($map->getObj());
			}
			$response->items = $itemObjects;
		}

		return $response;
	}

	public function buy($key, $data = array())
	{
		$uri = '/items/'.$key.'/buy';
		return $this->client->post($key, $data);
	}

	public function consume($key, $data = array())
	{
		$uri = '/items/'.$key.'/consume';
		return $this->client->post($key, $data);
	}

	public function equip($key, $data = array())
	{
		$uri = '/items/'.$key.'/equip';
		return $this->client->post($key, $data);
	}

	public function gift($key, $data = array())
	{
		$uri = '/items/'.$key.'/gift';
		return $this->client->post($key, $data);
	}

	public function sell($key, $data = array())
	{
		$uri = '/items/'.$key.'/sell';
		return $this->client->post($key, $data);
	}

	public function unfurnish($key, $data = array())
	{
		$uri = '/items/'.$key.'/unfurnish';
		return $this->client->post($key, $data);
	}

	public function remove($key, $data = array())
	{
		$uri = '/items/'.$key.'/remove';
		return $this->client->post($key, $data);
	}
}
