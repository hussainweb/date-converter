<?php

namespace Hussainweb\DateConverter\Tests\Strategy\Algorithm\Hijri;

use Hussainweb\DateConverter\Strategy\Algorithm\Hijri\HijriFatimidAstronomical;
use Hussainweb\DateConverter\Value\HijriDate;

/**
 * Test for class HijriFatimidAstronomical
 *
 * @coversDefaultClass \Hussainweb\DateConverter\Strategy\Algorithm\Hijri\HijriFatimidAstronomical
 */
class HijriFatimidAstronomicalTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Hussainweb\DateConverter\Strategy\Algorithm\Hijri\HijriFatimidAstronomical
     */
    protected $algorithm;

    public function setUp()
    {
        $this->algorithm = new HijriFatimidAstronomical();
    }

    /**
     * @dataProvider hijriDateProvider
     * @covers ::fromJulianDay
     * @covers ::getEpoch
     * @covers ::getShift
     */
    public function testFromJulianDay($d, $m, $y, $jd)
    {
        $date = $this->algorithm->fromJulianDay($jd);
        $this->assertEquals($d, $date->getMonthDay());
        $this->assertEquals($m, $date->getMonth());
        $this->assertEquals($y, $date->getYear());
    }

    /**
     * @dataProvider hijriDateProvider
     * @covers ::toJulianDay
     * @covers ::getYearOffsetShift
     */
    public function testToJulianDay($d, $m, $y, $jd)
    {
        $actual_jd = $this->algorithm->toJulianDay(new HijriDate($d, $m, $y, $this->algorithm));
        $this->assertEquals($jd, $actual_jd);
    }

    /**
     * @dataProvider invalidHijriDateProvider
     * @covers ::toJulianDay
     * @covers ::getYearOffsetShift
     * @expectedException \Hussainweb\DateConverter\InvalidDateException
     */
    public function testInvalidToJulianDay($d, $m, $y)
    {
        $actual_jd = $this->algorithm->toJulianDay(new HijriDate($d, $m, $y, $this->algorithm));
    }

    /**
     * @dataProvider hijriDateProvider
     * @covers ::isValidDate
     */
    public function testIsValidDate($d, $m, $y)
    {
        $this->assertTrue($this->algorithm->isValidDate($d, $m, $y));
    }

    /**
     * @dataProvider invalidHijriDateProvider
     * @covers ::isValidDate
     */
    public function testIsValidDateInvalid($d, $m, $y)
    {
        $this->assertFalse($this->algorithm->isValidDate($d, $m, $y));
    }

    /**
     * @dataProvider kabisaYears
     * @covers ::isKabisa
     */
    public function testKabisaYears($year, $is_kabisa)
    {
        $this->assertEquals($is_kabisa, $this->algorithm->isKabisa($year));
    }

    /**
     * @covers ::getMonthDays
     */
    public function testGetMonthDays()
    {
        $this->assertSame(29, $this->algorithm->getMonthDays(1439, 2));
        $this->assertSame(29, $this->algorithm->getMonthDays(1439, 4));
        $this->assertSame(30, $this->algorithm->getMonthDays(1439, 5));
        $this->assertSame(30, $this->algorithm->getMonthDays(1439, 9));
    }

    /**
     * @dataProvider kabisaYears
     * @covers ::getMonthDays
     */
    public function testGetMonthDaysInKabisa($year, $is_kabisa)
    {
        $this->assertSame(
            $is_kabisa ? 30 : 29,
            $this->algorithm->getMonthDays($year, 12)
        );
    }

    public function hijriDateProvider()
    {
        return
          [
            [8, 9, 1436, 2457198],
            [30, 12, 1437, 2457663],
            [30, 12, 1439, 2458372],
          ];
    }

    public function invalidHijriDateProvider()
    {
        return
          [
            [30, 12, 1436],
          ];
    }

    public function kabisaYears()
    {
        $kabisa = [2, 5, 8, 10, 13, 16, 19, 21, 24, 27, 29];
        // Test a random sabt.
        $sabt = rand(1, 100);
        $return = [];
        foreach (range(1, 30) as $i) {
            $return[] = [($sabt * 30) + $i, in_array($i, $kabisa)];
        }

        return $return;
    }
}
