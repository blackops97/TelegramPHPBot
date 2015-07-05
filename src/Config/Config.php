<?php
/*
 * This file is part of the TelegramPHPBot package.
 *
 * (c) Vinay Kumar aka CuriousCoder
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
namespace CuriousCoder\TelegramBot\Config;

Class Config{

	private  $ApiUrl, $ApiKey, $RequestUrl, $PhotoFormats, $VideoFormats, $AudioFormats, $StickerFormats, $HttpOptions;

	function __construct(){

		$this->ApiUrl = 'https://api.telegram.org/bot';
		$this->PhotoFormats = ['jpg','jpeg','png'];
		$this->VideoFormats = ['mp4'];
		$this->AudioFormats = ['mp3','mp4'];
		$this->StickerFormats = ['webp'];
		$this->HttpOptions = ['timeout' => 30];
	}

	public function getApiUrl(){
		return $this->ApiUrl;
	}

	public function setApiKey($key){
		$this->ApiKey = $key;
		$this->RequestUrl = $this->ApiUrl.$this->ApiKey;
	}

	public function getRequestUrl(){
		return 	$this->RequestUrl;
	}

	public function getApiKey(){
		return $this->ApiKey;
	}

	public function setPhotoFormats(array $format){
		if(count($format) > 0){
			foreach($format as $f){
				if(!in_array($f,$this->PhotoFormats)){
					array_push($this->PhotoFormats,$f);
				}
			}
		}
	}

	public function getPhotoFormats(){
		return $this->PhotoFormats;
	}

	public function setVideoFormats(array $format){
		if(count($format) > 0){
			foreach($format as $f){
				if(!in_array($f,$this->VideoFormats)){
					array_push($this->VideoFormats,$f);
				}
			}
		}
	}

	public function getVideoFormats(){
		return $this->VideoFormats;
	}

	public function setAudioFormats(array $format){
		if(count($format) > 0){
			foreach($format as $f){
				if(!in_array($f,$this->AudioFormats)){
					array_push($this->AudioFormats,$f);
				}
			}
		}
	}

	public function getAudioFormats(){
		return $this->AudioFormats;
	}

	public function setStickerFormats(array $format){
		if(count($format) > 0){
			foreach($format as $f){
				if(!in_array($f,$this->PhotoFormats)){
					array_push($this->StickerFormats,$f);
				}
			}
		}
	}

	public function getStickerFormats(){
		return $this->StickerFormats;
	}


	public function setHttpOptions(array $options){
		if(count($options) > 0){
			foreach($options as $ok => $ov){
				$this->HttpOptions[$ok] = $ov;
			}
		}
	}

	public function getHttpOptions(){
		return $this->HttpOptions;
	}

	public function Others(){
		return [
			'timezone' => 'UTC'
		];
	}
}
