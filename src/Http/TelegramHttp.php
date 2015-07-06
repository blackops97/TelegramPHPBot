<?php

/*
* This file is part of the TelegramPHPBot package.
*
* (c) Vinay Kumar aka CuriousCoder
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace CuriousCoder\TelegramBot\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Post\PostFile;
use GuzzleHttp\Post\PostBodyInterface;
use GuzzleHttp\Promise;
use GuzzleHttp\Message\FutureResponse;
use CuriousCoder\TelegramBot\Config\Config;

Class TelegramHttp{

	private $client, $httpOptions;

	public function __construct(Config $Config){

		$this->client = new Client();
		$this->httpOptions = $Config;
	}

	public function request(
	$method,
	$url,
	array $options = []
	){
		$body = isset($options['body']) ? $options['body'] : null;
		$request = $this->client->createRequest($method, $url, $this->httpOptions->getHttpOptions());
		$postBody = $request->getBody();
		if(count($body) > 0)
		{
			foreach($body as $key => $value){
				if(is_file($value)){
					$postBody->addFile(new PostFile($key, fopen($value, "r") ));
				}else{
					isset($key) ? $postBody->setField($key, $value) : '';
				}
			}
		}

		try{

			$response = $this->client->send($request);
			return $response->json();
			/*
				$response = $this->client->send($request)->then(function ($response) {
					return $response->json();
				});
			*/
		}catch(\Exception $e){
			echo($e->getMessage());
		}
	}

}
