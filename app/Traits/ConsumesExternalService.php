<?php
namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

trait ConsumesExternalService 
{
	/**
	 * Send a request to any service
	 * @return String
	 */
	
	private $prefix = '/api';

	public function performRequest($method, $requestUrl, $formParams = [], $headers = []) 
	{
		try {
	
			$client = new Client([
				'base_uri' => $this->baseUri
			]);

			if(session()->has('user')) {
				$headers['Authorization'] = 'Bearer '.session('user')->token; 
			}

			$response = $client->request($method, $this->prefix.$requestUrl, ['form_params' => $formParams, 'headers' => $headers]);

			return json_decode($response->getBody()->getContents());

		} catch (ClientException $e) {
			$message = $e->getResponse()->getBody();
            $code = $e->getCode();

            return json_decode($message);
		}
	}
}