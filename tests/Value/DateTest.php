<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter\Tests\Value;

use Hussainweb\DateConverter\Value\Date;

/**
 * Class DateTest
 * @package Hussainweb\DateConverter\Tests\Value
 *
 * @coversDefaultClass \Hussainweb\DateConverter\Value\Date
 */
class DateTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider gregorianDateProvider
     * @covers ::__construct
     * @covers ::getMonthDay
     * @covers ::getMonth
     * @covers ::getYear
     */
    public function testDates($d, $m, $y)
    {
        $date = $this->getMockForAbstractClass(Date::class, [$d, $m, $y]);
        $this->assertEquals($d, $date->getMonthDay());
        $this->assertEquals($m, $date->getMonth());
        $this->assertEquals($y, $date->getYear());
    }

    public function gregorianDateProvider()
    {
        return
          [
            [24, 6, 2015, 2457198],
            [28, 2, 2015, 2457082],
            [29, 2, 2016, 2457448],
          ];
    }
}
