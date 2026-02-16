<?php

namespace Hussainweb\DateConverter\Tests\Algorithm\Hijri;

use Hussainweb\DateConverter\Algorithm\Hijri\HijriFatimidAstronomical;
use Hussainweb\DateConverter\Algorithm\Hijri\HijriAlgorithmBase;
use Hussainweb\DateConverter\InvalidDateException;
use Hussainweb\DateConverter\Value\HijriDate;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(HijriFatimidAstronomical::class)]
#[CoversClass(HijriAlgorithmBase::class)]
class HijriFatimidAstronomicalTest extends TestCase
{
    /**
     * @var \Hussainweb\DateConverter\Algorithm\Hijri\HijriFatimidAstronomical
     */
    protected $algorithm;

    public function setUp(): void
    {
        $this->algorithm = new HijriFatimidAstronomical();
    }

    #[DataProvider('hijriDateProvider')]
    public function testFromJulianDay($d, $m, $y, $jd)
    {
        $date = $this->algorithm->fromJulianDay($jd);
        $this->assertEquals($d, $date->getMonthDay());
        $this->assertEquals($m, $date->getMonth());
        $this->assertEquals($y, $date->getYear());
    }

    #[DataProvider('hijriDateProvider')]
    public function testToJulianDay($d, $m, $y, $jd)
    {
        $actual_jd = $this->algorithm->toJulianDay(new HijriDate($d, $m, $y, $this->algorithm));
        $this->assertEquals($jd, $actual_jd);
    }

    #[DataProvider('invalidHijriDateProvider')]
    public function testInvalidToJulianDay($d, $m, $y)
    {
        $this->expectException(InvalidDateException::class);
        $actual_jd = $this->algorithm->toJulianDay(new HijriDate($d, $m, $y, $this->algorithm));
    }

    #[DataProvider('hijriDateProvider')]
    public function testIsValidDate($d, $m, $y)
    {
        $this->assertTrue($this->algorithm->isValidDate($d, $m, $y));
    }

    #[DataProvider('invalidHijriDateProvider')]
    public function testIsValidDateInvalid($d, $m, $y)
    {
        $this->assertFalse($this->algorithm->isValidDate($d, $m, $y));
    }

    #[DataProvider('kabisaYears')]
    public function testKabisaYears($year, $is_kabisa)
    {
        $this->assertEquals($is_kabisa, $this->algorithm->isKabisa($year));
    }

    public function testGetMonthDays()
    {
        $this->assertSame(29, $this->algorithm->getMonthDays(1439, 2));
        $this->assertSame(29, $this->algorithm->getMonthDays(1439, 4));
        $this->assertSame(30, $this->algorithm->getMonthDays(1439, 5));
        $this->assertSame(30, $this->algorithm->getMonthDays(1439, 9));
    }

    #[DataProvider('kabisaYears')]
    public function testGetMonthDaysInKabisa($year, $is_kabisa)
    {
        $this->assertSame(
            $is_kabisa ? 30 : 29,
            $this->algorithm->getMonthDays($year, 12)
        );
    }

    #[DataProvider('hijriDateProvider')]
    public function testConstructDateValues($d, $m, $y)
    {
        $date = $this->algorithm->constructDateValue($d, $m, $y);
        $this->assertSame($d, $date->getMonthDay());
        $this->assertSame($m, $date->getMonth());
        $this->assertSame($y, $date->getYear());
    }

    public static function hijriDateProvider()
    {
        return
          [
            [8, 9, 1436, 2457198],
            [30, 12, 1437, 2457663],
            [30, 12, 1439, 2458372],
          ];
    }

    public static function invalidHijriDateProvider()
    {
        return
          [
            [30, 12, 1436],
          ];
    }

    public static function kabisaYears()
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
