<?php
namespace App\Library;

/**
* 
*/
class Prime
{
	public static function check($number)
	{
		if ($number < 2) {
			return false;
		}

		$pembagi = 0;
		for ($i = $number; $i >= 1 ; $i--) { 
			if ($number % $i == 0) {
				$pembagi++;
			}
		}

		if ($pembagi == 2) {
			return true;
		}

		return false;
	}
}