<?php
namespace CuriousCoder\TelegramBot;

/*
 * This file is part of the TelegramPHPBot package.
 *
 * (c) Vinay Kumar aka CuriousCoder
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

Class Request{

	private static $telegramBot;

	public static function Initialize(TelegramBot $telegramBot) {
		self::$telegramBot = $telegramBot;
	}

	public static function Send($action, array $data = null) {
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL					=> 'https://api.telegram.org/bot'.self::$telegramBot->getApiKey().'/'.$action,
		    CURLOPT_POST 				=> true,
		    CURLOPT_RETURNTRANSFER		=> true,
		    CURLOPT_PORT				=> 443,
		    //CURLOPT_HTTPHEADER 		=> array('Content-Type: application/x-www-form-urlencoded'),
		    //CURLOPT_HTTPHEADER 		=> array('Content-Type: text/plain'),
		);
		if( count($data) > 0 ){
			$datas = '';
			foreach($data as $dk=>$dv){
				$datas .= $dk."=".$dv."&";
			}

			$datas = substr($datas, 0, -1);
			$curlConfig[CURLOPT_POSTFIELDS] = $datas;
			if(is_file($dv)){
				$curlConfig[CURLOPT_HTTPHEADER] = array('Content-Type: multipart/form-data');
			}
		}
		$curlConfig[CURLOPT_HTTPHEADER] = array('Content-Type: multipart/form-data');
		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch); //Convert object to Array

		if(curl_errno($ch))
		{
		    $result = ["curlError"=>curl_error($ch)];
		}

		curl_close($ch);
		return $result;
	}
}