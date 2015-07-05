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

use Carbon\Carbon;

Class Helper{

	public function DateFormat($unixtime,$timezone,$format){
		 switch($format){
		 	case 'DateTime':
		 		$formatted = Carbon::createFromTimeStamp($unixtime,$timezone)->toDateTimeString();
		 	break;
		 	case 'DayDateTime':
		 		$formatted = Carbon::createFromTimeStamp($unixtime,$timezone)->toDayDateTimeString();
		 	break;
		 }
		 return $formatted;
	}

	public function CheckFile($path,array $format){
		if(file_exists($path) && is_readable($path)){
			if(in_array(pathinfo($path,PATHINFO_EXTENSION),$format))
			{
				return true;
			}else{
				return "Not Accepted File Etension";
			}
		}
	}
}
