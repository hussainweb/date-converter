<?php

namespace Hussainweb\DateConverter\Tests\Strategy\Algorithm;

use Hussainweb\DateConverter\Strategy\Algorithm\NativeAlgorithm;
use Hussainweb\DateConverter\Value\GregorianDate;
use Hussainweb\DateConverter\Value\NativeDate;

/**
 * Test for class NativeAlgorithm
 *
 * @coversDefaultClass \Hussainweb\DateConverter\Strategy\Algorithm\NativeAlgorithm
 */
class NativeAlgorithmTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Hussainweb\DateConverter\Strategy\Algorithm\NativeAlgorithm
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
        $this->assertEquals($d, $date->getMonthDay());
        $this->assertEquals($m, $date->getMonth());
        $this->assertEquals($y, $date->getYear());
        $this->assertEquals($ts, $date->getTimestamp());
    }

    /**
     * @dataProvider nativeDateProvider
     * @covers ::toJulianDay
     */
    public function testToJulianDay($ts, $d, $m, $y, $jd)
    {
        $actual_jd = $this->algorithm->toJulianDay(new NativeDate($ts));
        $this->assertEquals($jd, $actual_jd);
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
     * @covers \Hussainweb\DateConverter\Strategy\Algorithm\ValidDateTimeCheck::isValidDate
     */
    public function testIsValidDate($ts, $d, $m, $y)
    {
        $this->assertTrue($this->algorithm->isValidDate($d, $m, $y));
    }

    /**
     * @dataProvider invalidNativeDateProvider
     * @covers \Hussainweb\DateConverter\Strategy\Algorithm\ValidDateTimeCheck::isValidDate
     */
    public function testIsValidDateInvalid($d, $m, $y)
    {
        $this->assertFalse($this->algorithm->isValidDate($d, $m, $y));
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
