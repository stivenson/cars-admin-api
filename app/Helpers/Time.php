<?php 


namespace Helpers; // optional

/**
 *
 * Dependence for Time operations
 *
 * @author stivenson
 *
 */

class Time {

	const DEFAUTL_TIME_ZONE = 'america/bogota';

	public static function getCurrentHour($timezone =self::DEFAUTL_TIME_ZONE, $format = 'H:i') {
		date_default_timezone_set($timezone);
		return date($format);
	}

}