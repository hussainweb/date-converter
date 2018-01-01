<?php

namespace Hussainweb\DateConverter\Tests\Algorithm;

use Hussainweb\DateConverter\Algorithm\NativeAlgorithm;
use Hussainweb\DateConverter\Value\GregorianDate;
use Hussainweb\DateConverter\Value\NativeDate;

/**
 * Test for class NativeAlgorithm
 *
 * @coversDefaultClass \Hussainweb\DateConverter\Algorithm\NativeAlgorithm
 */
class NativeAlgorithmTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Hussainweb\DateConverter\Algorithm\NativeAlgorithm
     */
    protected $algorithm;

    public function setUp()
    {
        $this->algorithm = new NativeAlgorithm();
    }

    /**
     * @dataProvider nativeDateProvider
     * @covers ::fromJulianDay
     */
    public function testFromJulianDay($ts, $d, $m, $y, $jd)
    {
        $date = $this->algorithm->fromJulianDay($jd);
        $this->assertSame($d, $date->getMonthDay());
        $this->assertSame($m, $date->getMonth());
        $this->assertSame($y, $date->getYear());
        $this->assertSame($ts, $date->getTimestamp());
    }

    /**
     * @dataProvider nativeDateProvider
     * @covers ::toJulianDay
     */
    public function testToJulianDay($ts, $d, $m, $y, $jd)
    {
        $actual_jd = $this->algorithm->toJulianDay(new NativeDate($ts));
        $this->assertSame($jd, $actual_jd);
    }

    /**
     * @dataProvider nativeDateProvider
     * @covers ::toJulianDay
     * @expectedException \InvalidArgumentException
     */
    public function testOtherToJulianDay($ts, $d, $m, $y, $jd)
    {
        $actual_jd = $this->algorithm->toJulianDay(new GregorianDate($d, $m, $y));
    }

    /**
     * @dataProvider nativeDateProvider
     * @covers \Hussainweb\DateConverter\Algorithm\ValidDateTimeCheck::isValidDate
     */
    public function testIsValidDate($ts, $d, $m, $y)
    {
        $this->assertTrue($this->algorithm->isValidDate($d, $m, $y));
    }

    /**
     * @dataProvider invalidNativeDateProvider
     * @covers \Hussainweb\DateConverter\Algorithm\ValidDateTimeCheck::isValidDate
     */
    public function testIsValidDateInvalid($d, $m, $y)
    {
        $this->assertFalse($this->algorithm->isValidDate($d, $m, $y));
    }

    /**
     * @covers \Hussainweb\DateConverter\Algorithm\NativeAlgorithm::getMonthDays
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionOnGetMonthDays()
    {
        $days = $this->algorithm->getMonthDays(2017, 1);
    }

    /**
     * @dataProvider nativeDateProvider
     * @covers ::constructDateValue
     */
    public function testConstructDateValues($ts, $d, $m, $y)
    {
        $date = $this->algorithm->constructDateValue($d, $m, $y);
        $this->assertSame($ts, $date->getTimestamp());
        $this->assertSame($d, $date->getMonthDay());
        $this->assertSame($m, $date->getMonth());
        $this->assertSame($y, $date->getYear());
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

    public function invalidNativeDateProvider()
    {
        return
          [
            [29, 2, 2015],
          ];
    }
}
