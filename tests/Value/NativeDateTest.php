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
     * @covers ::getJulianDay
     * @covers ::setJulianDay
     */
    public function testNativeDates($ts, $d, $m, $y, $jd)
    {
        $native_date = new NativeDate($ts);
        $this->assertEquals($d, $native_date->getMonthDay());
        $this->assertEquals($m, $native_date->getMonth());
        $this->assertEquals($y, $native_date->getYear());
        $this->assertEquals($jd, $native_date->getJulianDay());

        $new_date = $native_date->setJulianDay($jd);
        $this->assertEquals($d, $new_date->getMonthDay());
        $this->assertEquals($m, $new_date->getMonth());
        $this->assertEquals($y, $new_date->getYear());
    }

    public function nativeDateProvider()
    {
        return
          [
            [1435104000, 24, 6, 2015, 2457198],
            [1425081600, 28, 2, 2015, 2457082],
            [1456704000, 29, 2, 2016, 2457448],
          ];
    }
}
