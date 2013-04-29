<?php

namespace Azukki;

use PestJSON;

class AzukkiPestJSON extends PestJSON {

	protected $headers = array();

	public function __construct($baseUrl, $baseHeaders = array())
	{
		$this->curl_opts[CURLOPT_HTTPHEADER] = array();

		parent::__construct($baseUrl);

		$this->headers = $baseHeaders;
	}

	public function addHeader($header) {
		$this->headers[] = $header;
	}

	public function processBody($body)
	{
		$body = parent::processBody($body);

		$meta = $this->last_response['meta'];

		$response = new Response($meta['http_code']);
		$response->success = $body['success'];

		if(array_key_exists('message', $body)) {
			$response->message = $body['message'];
		}

		$response->tick    = $body['tick'];
		$response->load($body);

		return $response;
	}

	protected function prepRequest($opts, $url)
	{
		foreach($this->headers as $header) {
			$opts[CURLOPT_HTTPHEADER][] = $header;
		}

		return parent::prepRequest($opts, $url);
	}
}