<?php
/**
 * Created by PhpStorm.
 * User: hw
 * Date: 13-Dec-15
 * Time: 21:22
 */

namespace Hussainweb\DateConverter\Tests\Value;

use Hussainweb\DateConverter\Value\GregorianDate;

/**
 * Class GregorianDateTest
 * @package Hussainweb\DateConverter\Tests\Value
 *
 * @coversDefaultClass \Hussainweb\DateConverter\Value\GregorianDate
 */
class GregorianDateTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider gregorianDateProvider
     * @covers ::__construct
     * @covers ::getMonthDay
     * @covers ::getMonth
     * @covers ::getYear
     * @covers ::getJulianDay
     * @covers ::setJulianDay
     */
    public function testGregorianDates($d, $m, $y, $jd)
    {
        $gregorian_date = new GregorianDate($d, $m, $y);
        $this->assertEquals($d, $gregorian_date->getMonthDay());
        $this->assertEquals($m, $gregorian_date->getMonth());
        $this->assertEquals($y, $gregorian_date->getYear());
        $this->assertEquals($jd, $gregorian_date->getJulianDay());

        $new_date = $gregorian_date->setJulianDay($jd);
        $this->assertEquals($d, $new_date->getMonthDay());
        $this->assertEquals($m, $new_date->getMonth());
        $this->assertEquals($y, $new_date->getYear());
    }

    /**
     * @dataProvider gregorianDateProvider
     * @covers ::fromJulianDay
     */
    public function testGregorianDatesFromJulianDay($d, $m, $y, $jd)
    {
        $new_date = GregorianDate::fromJulianDay($jd);
        $this->assertEquals($d, $new_date->getMonthDay());
        $this->assertEquals($m, $new_date->getMonth());
        $this->assertEquals($y, $new_date->getYear());
    }

    /**
     * @dataProvider invalidGregorianDateProvider
     * @covers ::__construct
     * @expectedException \Hussainweb\DateConverter\InvalidDateException
     */
    public function testInvalidGregorianDates($d, $m, $y)
    {
        $gregorian_date = new GregorianDate($d, $m, $y);
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

    public function invalidGregorianDateProvider()
    {
        return
        [
            [29, 2, 2015],
        ];
    }
}
