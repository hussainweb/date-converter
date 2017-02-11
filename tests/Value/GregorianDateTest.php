<?php

namespace Hussainweb\DateConverter\Tests\Value;

use Hussainweb\DateConverter\Value\GregorianDate;

/**
 * Test for class GregorianDate
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
     */
    public function testGregorianDates($d, $m, $y)
    {
        $gregorian_date = new GregorianDate($d, $m, $y);
        $this->assertEquals($d, $gregorian_date->getMonthDay());
        $this->assertEquals($m, $gregorian_date->getMonth());
        $this->assertEquals($y, $gregorian_date->getYear());
    }

    /**
     * @dataProvider gregorianDateProvider
     * @covers ::getDateTime
     */
    public function testGregorianDatesDateTime($d, $m, $y)
    {
        $gregorian_date = new GregorianDate($d, $m, $y);
        $dt = $gregorian_date->getDateTime();
        $this->assertEquals($d, $dt->format('j'));
        $this->assertEquals($m, $dt->format('n'));
        $this->assertEquals($y, $dt->format('Y'));
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
            [24, 6, 2015],
            [28, 2, 2015],
            [29, 2, 2016],
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
