<?php

namespace Azukki;

use Azukki\Model\Leaderboard;
use Azukki\Model\Player;
use Azukki\Model\Score;
use Azukki\Data\Mapper;

class Leaderboards extends Resource {

	public function getAll()
	{
		$response = $this->client->get('/leaderboards');
		$leaderboardObjects = new Collection;

		if($response->success === true) {
			foreach($response->leaderboards as $leaderboard) {
				$obj = new Leaderboard;
				$map = new Mapper($obj, $leaderboard);
				$leaderboardObjects->append($map->getObj());
			}
			$response->leaderboards = $leaderboardObjects;
		}

		return $response;
	}

	public function get($key, $params = array())
	{
		$response = $this->client->get('/leaderboards/'.$key, $params);

		return $this->processResponse($response);
	}

	/*public function getByUri($uri)
	{
		$uri = '/'.implode('/', array_slice(explode('/', trim($uri, '/')), 1));

		if(strpos('/leaderboards') === 0) {
			$response = $this->client->get($uri);

			return $this->processResponse($response);
		}
	}*/

	public function pushScores($key, $scores)
	{
		return $this->client->push('/leaderboards/'.$key, $scores);
	}

	protected function processResponse($response)
	{
		if($response->success === true) {
			$leaderboard       = new Leaderboard;
			$leaderboard->name = $response->{'_leaderboard'}['name'];
			$leaderboard->key  = $response->{'_leaderboard'}['key'];

			$response->leaderboard = $leaderboard;

			$scoreCollection = new PaginatedCollection($this->client, $response->{'_meta'});

			foreach($response->scores as $score) {
				$scoreTmp = new Score;
				$scoreMap = new Mapper($scoreTmp, $score);
				$scoreObj = $scoreMap->getObj();

				$playerTmp = new Player;
				$playerMap = new Mapper($playerTmp, $score['player']);
				$playerObj = $playerMap->getObj();

				$scoreObj->player = $playerObj;

				$scoreCollection->append($scoreObj);
			}

			$response->scores = $scoreCollection;
		}

		return $response;
	}
}