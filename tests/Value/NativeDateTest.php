<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter\Tests\Value;

use Hussainweb\DateConverter\Value\NativeDate;

/**
 * Class NativeDateTest
 * @package Hussainweb\DateConverter\Tests\Value
 *
 * @coversDefaultClass \Hussainweb\DateConverter\Value\NativeDate
 */
class NativeDateTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider nativeDateProvider
     * @covers ::__construct
     * @covers ::getMonthDay
     * @covers ::getMonth
     * @covers ::getYear
     */
    public function testNativeDates($ts, $d, $m, $y)
    {
        $native_date = new NativeDate($ts);
        $this->assertEquals($d, $native_date->getMonthDay());
        $this->assertEquals($m, $native_date->getMonth());
        $this->assertEquals($y, $native_date->getYear());
    }

    /**
     * @dataProvider nativeDateProvider
     * @covers ::getTimestamp
     */
    public function testNativeDatesTimestamps($ts, $d, $m, $y)
    {
        $native_date = new NativeDate($ts);
        $this->assertEquals($ts, $native_date->getTimestamp());
    }

    public function nativeDateProvider()
    {
        return
          [
            [1435104000, 24, 6, 2015],
            [1425081600, 28, 2, 2015],
            [1456704000, 29, 2, 2016],
          ];
    }
}
