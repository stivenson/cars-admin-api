<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Helpers\Time;
use DateTime;

class TimeTest extends TestCase
{
	/**
     * function getCurrentHour
     * 
     * @return void 
	 */
	/** @test */
	public function getCurrentHour()
	{

		$time = new Time;
		$this->assertTrue($this->validateHour($time->getCurrentHour()));

	}

	/**
	 * dunction for validate hour or others formats
	 *
	 */
	private function validateHour($date, $format = 'H:i')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}


}
