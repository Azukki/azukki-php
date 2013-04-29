<?php

namespace Azukki;

use Azukki\Data\Mapper;
use Azukki\Model\Action;
use Azukki\Model\ProfileAction;

class Actions extends Resource {

	public function getAll() 
	{
		$response = $this->client->get('/actions');
		$actionObjects = new Collection;

		if($response->success === true) {
			foreach($response->actions as $action) {
				$obj = new Action;
				$map = new Mapper($obj, $action);
				$actionObjects->append($map->getObj());
			}
			$response->actions = $actionObjects;
		}

		return $response;
	}

	public function getProfileList()
	{
		$response = $this->client->get('/actions/profile_list');
		$actionObjects = new Collection;

		if($response->success === true) {
			foreach($response->actions as $action) {
				$obj = new ProfileAction;
				$map = new Mapper($obj, $action);
				$actionObjects->append($map->getObj());
			}
			$response->actions = $actionObjects;
		}

		return $response;
	}

	public function run($key, $data = array()) {
		$uri = '/actions/'.$key.'/run';
		return $this->client->post($uri, $data);
	}
}