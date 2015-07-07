<?php

/*
* This file is part of the TelegramPHPBot package.
*
* (c) Vinay Kumar aka CuriousCoder
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace CuriousCoder\TelegramBot;

use CuriousCoder\TelegramBot\Http\TelegramHttp;
use CuriousCoder\TelegramBot\Config\Config;
use CuriousCoder\TelegramBot\Helper;
use CuriousCoder\TelegramBot\Exception\FileFormatException;


Class TelegramBot {

	private $TelegramHttp, $Config, $Helper;


	public function __construct(Config $Config){
		$this->Config = $Config;
		$this->TelegramHttp = new TelegramHttp($Config);
		$this->Helper = new Helper();
	}

	/**
	* A simple method for testing your bot's auth token.
	* Returns basic information about the bot in form of a User object.
	*
	* @link https://core.telegram.org/bots/api#getme
	*
	* @return array
	*/
	public function getMe()
	{
		return $this->TelegramHttp->request('post',$this->Config->getRequestUrl().'/getMe');
	}

	/**
	* Send text messages.
	*
	* @link https://core.telegram.org/bots/api#sendmessage
	*
	* @param int            $chat_id
	* @param string         $text
	* @param bool           $disable_web_page_preview
	* @param int            $reply_to_message_id
	* @param KeyboardMarkup $reply_markup
	*
	* @return array
	*/
	public function sendMessage(
	$chat_id,
	$text,
	$disable_web_page_preview = false,
	$reply_to_message_id = null,
	$reply_markup = null
	) {

		$params['body'] = compact('chat_id', 'text', 'disable_web_page_preview', 'reply_to_message_id', 'reply_markup');

		return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/sendMessage',$params);
	}

	/**
	* Forward messages of any kind.
	*
	* @link https://core.telegram.org/bots/api#forwardmessage
	*
	* @param int $chat_id
	* @param int $from_chat_id
	* @param int $message_id
	*
	* @return array
	*/
	public function forwardMessage($chat_id, $from_chat_id, $message_id)
	{
		$params['body'] = compact('chat_id', 'from_chat_id', 'message_id');

		return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/sendMessage',$params);
	}


	/**
	* Send Photos.
	*
	* @link https://core.telegram.org/bots/api#sendphoto
	*
	* @param int            $chat_id
	* @param string         $photo
	* @param string         $caption
	* @param int            $reply_to_message_id
	* @param KeyboardMarkup $reply_markup
	*
	* @return array
	*/
	public function sendPhoto($chat_id, $photo, $caption = null, $reply_to_message_id = null, $reply_markup = null){

		try{
			if($this->Helper->CheckFile($photo, $this->Config->getPhotoFormats()) === true )

			{
				$params['body'] = compact('chat_id', 'photo', 'caption', 'reply_to_message_id', 'reply_markup');

				return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/sendPhoto',$params);
			}
		}catch(FileFormatException $e){
			$e->showMessage();
		}
	}
	/**
	* Send audio files.
	*
	* @link https://core.telegram.org/bots/api#sendaudio
	*
	* @param int            $chat_id
	* @param string         $audio
	* @param int            $reply_to_message_id
	* @param KeyboardMarkup $reply_markup
	*
	* @return array
	*/
	public function sendAudio($chat_id, $audio, $reply_to_message_id = null, $reply_markup = null)
	{
		try{
			if($this->Helper->CheckFile($audio, $this->Config->getAudioFormats()) === true ){

				$params = compact('chat_id', 'audio', 'reply_to_message_id', 'reply_markup');

				return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/sendAudio',$params);
			}
		}catch(FileFormatException $e){
			$e->showMessage();
		}
	}

	/**
	* Send general files.
	*
	* @link https://core.telegram.org/bots/api#senddocument
	*
	* @param int            $chat_id
	* @param string         $document
	* @param int            $reply_to_message_id
	* @param KeyboardMarkup $reply_markup
	*
	* @return array
	*/
	public function sendDocument($chat_id, $document, $reply_to_message_id = null, $reply_markup = null)
	{
		$params = compact('chat_id', 'document', 'reply_to_message_id', 'reply_markup');

		return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/sendDocument',$params);
	}

	/**
	* Send .webp stickers.
	*
	* @link https://core.telegram.org/bots/api#sendsticker
	*
	* @param int            $chat_id
	* @param string         $sticker
	* @param int            $reply_to_message_id
	* @param KeyboardMarkup $reply_markup
	*
	* @return array
	*
	*
	*/
	public function sendSticker($chat_id, $sticker, $reply_to_message_id = null, $reply_markup = null)
	{

		try{
				if($this->Helper->CheckFile($sticker, $this->Config->getStickerFormats()) === true ){

				$params = compact('chat_id', 'sticker', 'reply_to_message_id', 'reply_markup');

				return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/sendSticker',$params);
			}
		}catch(FileFormatException $e){
			$e->showMessage();
		}
	}

	/**
	* Send Video File, Telegram clients support mp4 videos (other formats may be sent as Document).
	*
	* @see  sendDocument
	* @link https://core.telegram.org/bots/api#sendvideo
	*
	* @param int            $chat_id
	* @param string         $video
	* @param int            $reply_to_message_id
	* @param KeyboardMarkup $reply_markup
	*
	* @return array
	*/
	public function sendVideo($chat_id, $video, $reply_to_message_id = null, $reply_markup = null)
	{
		try{
			if($this->Helper->CheckFile($video, $this->Config->getVideoFormats()) === true ){

				$params = compact('chat_id', 'video', 'reply_to_message_id', 'reply_markup');

				return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/sendVideo',$params);
			}
		}catch(FileFormatException $e){
			$e->showMessage();
		}
	}

	/**
	* Send point on the map.
	*
	* @link https://core.telegram.org/bots/api#sendlocation
	*
	* @param int            $chat_id
	* @param float          $latitude
	* @param float          $longitude
	* @param int            $reply_to_message_id
	* @param KeyboardMarkup $reply_markup
	*
	* @return array
	*/
	public function sendLocation($chat_id, $latitude, $longitude, $reply_to_message_id = null, $reply_markup = null)
	{
		$params = compact('chat_id', 'latitude', 'longitude', 'reply_to_message_id', 'reply_markup');

		return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/sendLocation',$params);
	}

	/**
	* Broadcast a Chat Action.
	*
	* @link https://core.telegram.org/bots/api#sendchataction
	*
	* @param int    $chat_id
	* @param string $action
	*
	*
	*
	*
	*/
	public function sendChatAction($chat_id, $action)
	{
		$validActions = [
			'typing',
			'upload_photo',
			'record_video',
			'upload_video',
			'record_audio',
			'upload_audio',
			'upload_document',
			'find_location',
		];

		if (isset($action) && in_array($action, $validActions)) {

			$params['body'] = compact('chat_id', 'action');

			return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/sendChatAction',$params);
		}

		throw new TelegramException('Invalid Action! Accepted value: '.implode(', ', $validActions));
	}

	/**
	* Returns a list of profile pictures for a user.
	*
	* @link https://core.telegram.org/bots/api#getuserprofilephotos
	*
	* @param int $user_id
	* @param int $offset
	* @param int $limit
	*
	*/
	public function getUserProfilePhotos($user_id, $offset = null, $limit = null)
	{
		$params['body'] = compact('user_id', 'offset', 'limit');

		return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/getUserProfilePhotos',$params);
	}

	/**
	* Set a Webhook to receive incoming updates via an outgoing webhook.
	*
	* @param string $url HTTPS url to send updates to.
	*
	*
	*
	*
	*/
	public function setWebhook($url)
	{

		if($this->Helper->checkUrl($url) === true){

			$params['body'] = compact('url');

			return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/setWebhook',$params);

		}else{
			return "Url not valid!";
		}
	}

	/**
	* Removes the outgoing webhook (if any).
	*
	*
	*/
	public function removeWebhook()
	{
		$url = '';

		$params['body'] = compact('url');

		return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/setWebhook',$params);
	}

	/**
	* Use this method to receive incoming updates using long polling.
	*
	* @link https://core.telegram.org/bots/api#getupdates
	*
	* @param int $offset
	* @param int $limit
	* @param int $timeout
	*
	*/
	public function getUpdates($offset = null, $limit = null, $timeout = null)
	{

		$params['body'] = compact('offset', 'limit', 'timeout');

		return $this->TelegramHttp->request('POST',$this->Config->getRequestUrl().'/getUpdates',$params);

	}

	/**
	* Builds a custom keyboard markup.
	*
	* @link https://core.telegram.org/bots/api#replykeyboardmarkup
	*
	* @param array $keyboard
	* @param bool  $resize_keyboard
	* @param bool  $one_time_keyboard
	* @param bool  $selective
	*
	* @return string
	*/
	public function replyKeyboardMarkup(
	$keyboard,
	$resize_keyboard = false,
	$one_time_keyboard = false,
	$selective = false
	) {
		return json_encode(compact('keyboard', 'resize_keyboard', 'one_time_keyboard', 'selective'));
	}

	/**
	* Hide the current custom keyboard and display the default letter-keyboard.
	*
	* @link https://core.telegram.org/bots/api#replykeyboardhide
	*
	* @param bool $selective
	*
	* @return string
	*/
	public static function replyKeyboardHide($selective = false)
	{
		$hide_keyboard = true;

		return json_encode(compact('hide_keyboard', 'selective'));
	}

	/**
	* Display a reply interface to the user (act as if the user has selected the bot‘s message and tapped ’Reply').
	*
	* @link https://core.telegram.org/bots/api#forcereply
	*
	* @param bool $selective
	*
	* @return string
	*/
	public static function forceReply($selective = false)
	{
		$force_reply = true;

		return json_encode(compact('force_reply', 'selective'));
	}

}
