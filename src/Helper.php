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

Class Helper{

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
