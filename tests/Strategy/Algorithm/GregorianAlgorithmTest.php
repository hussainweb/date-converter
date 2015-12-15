<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter\Tests\Strategy\Algorithm;

use Hussainweb\DateConverter\Strategy\Algorithm\GregorianAlgorithm;
use Hussainweb\DateConverter\Value\GregorianDate;

/**
 * Class GregorianAlgorithmTest
 * @package Hussainweb\DateConverter\Tests\Strategy\Algorithm
 *
 * @coversDefaultClass \Hussainweb\DateConverter\Strategy\Algorithm\GregorianAlgorithm
 */
class GregorianAlgorithmTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Hussainweb\DateConverter\Strategy\Algorithm\GregorianAlgorithm
     */
    protected $algorithm;

    public function setUp()
    {
        $this->algorithm = new GregorianAlgorithm();
    }

    /**
     * @dataProvider gregorianDateProvider
     * @covers ::fromJulianDay
     */
    public function testFromJulianDay($d, $m, $y, $jd)
    {
        $date = $this->algorithm->fromJulianDay($jd);
        $this->assertEquals($d, $date->getMonthDay());
        $this->assertEquals($m, $date->getMonth());
        $this->assertEquals($y, $date->getYear());
    }

    /**
     * @dataProvider gregorianDateProvider
     * @covers ::toJulianDay
     */
    public function testToJulianDay($d, $m, $y, $jd)
    {
        $actual_jd = $this->algorithm->toJulianDay(new GregorianDate($d, $m, $y));
        $this->assertEquals($jd, $actual_jd);
    }

    /**
     * @dataProvider invalidGregorianDateProvider
     * @covers ::toJulianDay
     * @expectedException \Hussainweb\DateConverter\InvalidDateException
     */
    public function testInvalidToJulianDay($d, $m, $y)
    {
        $actual_jd = $this->algorithm->toJulianDay(new GregorianDate($d, $m, $y));
    }

    /**
     * @dataProvider gregorianDateProvider
     * @covers \Hussainweb\DateConverter\Strategy\Algorithm\ValidDateTimeCheck::isValidDate
     */
    public function testIsValidDate($d, $m, $y)
    {
        $this->assertTrue($this->algorithm->isValidDate($d, $m, $y));
    }

    /**
     * @dataProvider invalidGregorianDateProvider
     * @covers \Hussainweb\DateConverter\Strategy\Algorithm\ValidDateTimeCheck::isValidDate
     */
    public function testIsValidDateInvalid($d, $m, $y)
    {
        $this->assertFalse($this->algorithm->isValidDate($d, $m, $y));
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
