<?php
/*
 * This file is part of the TelegramPHPBot package.
 *
 * (c) Vinay Kumar aka CuriousCoder
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace CuriousCoder\TelegramBot\Exception;


class FileFormatException extends \Exception{

  private $allowedFormats;

  protected $mesage;

  public function __construct($message, Exception $previous = null, $options = array('params')) {
      parent::__construct($message, $previous);
      $this->allowedFormats = $options;
      $this->message = $message;
  }

  public function showMessage(){
    foreach($this->allowedFormats as $aF){
      $this->message .= $aF." ";
    }
    echo($this->message);
  }
}
