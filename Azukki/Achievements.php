<?php

namespace Azukki;

use Azukki\Model\Achievement;
use Azukki\Model\ProfileAchievement;
use Azukki\Data\Mapper;

class Achievements extends Resource {

	public function getAll()
	{
		$response = $this->client->get('/achievements');
		$achievementObjects = new Collection;

		if($response->success === true) {
			foreach($response->achievements as $achievement) {
				$obj = new Achievement;
				$map = new Mapper($obj, $achievement);
				$achievementObjects->append($map->getObj());
			}
			$response->achievements = $achievementObjects;
		}

		return $response;
	}

	public function getProfileList()
	{
		$response = $this->client->get('/achievements/profile_list');
		$achievementObjects = new Collection;

		if($response->success === true) {
			foreach($response->achievements as $achievement) {
				$obj = new ProfileAchievement;
				$map = new Mapper($obj, $achievement);
				$achievementObjects->append($map->getObj());
			}
			$response->achievements = $achievementObjects;
		}

		return $response;
	}

	public function grant($key, $data = array()) {
		$uri = '/achievments/'.$key.'/grant';
		return $this->client->post($uri, $data);
	}
}