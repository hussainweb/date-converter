<?php

namespace Hussainweb\DateConverter\Tests\Algorithm;

use Hussainweb\DateConverter\Algorithm\GregorianAlgorithm;
use Hussainweb\DateConverter\Algorithm\ValidDateTimeCheck;
use Hussainweb\DateConverter\InvalidDateException;
use Hussainweb\DateConverter\Value\GregorianDate;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(GregorianAlgorithm::class)]
#[CoversTrait(ValidDateTimeCheck::class)]
class GregorianAlgorithmTest extends TestCase
{
    /**
     * @var \Hussainweb\DateConverter\Algorithm\GregorianAlgorithm
     */
    protected $algorithm;

    public function setUp(): void
    {
        $this->algorithm = new GregorianAlgorithm();
    }

    #[DataProvider('gregorianDateProvider')]
    public function testFromJulianDay($d, $m, $y, $jd)
    {
        $date = $this->algorithm->fromJulianDay($jd);
        $this->assertEquals($d, $date->getMonthDay());
        $this->assertEquals($m, $date->getMonth());
        $this->assertEquals($y, $date->getYear());
    }

    #[DataProvider('gregorianDateProvider')]
    public function testToJulianDay($d, $m, $y, $jd)
    {
        $actual_jd = $this->algorithm->toJulianDay(new GregorianDate($d, $m, $y));
        $this->assertEquals($jd, $actual_jd);
    }

    #[DataProvider('invalidGregorianDateProvider')]
    public function testInvalidToJulianDay($d, $m, $y)
    {
        $this->expectException(InvalidDateException::class);
        $actual_jd = $this->algorithm->toJulianDay(new GregorianDate($d, $m, $y));
    }

    #[DataProvider('gregorianDateProvider')]
    public function testIsValidDate($d, $m, $y)
    {
        $this->assertTrue($this->algorithm->isValidDate($d, $m, $y));
    }

    #[DataProvider('invalidGregorianDateProvider')]
    public function testIsValidDateInvalid($d, $m, $y)
    {
        $this->assertFalse($this->algorithm->isValidDate($d, $m, $y));
    }

    #[DataProvider('gregorianMonthDaysProvider')]
    public function testGetMonthDays($m, $y, $days)
    {
        $this->assertSame(
            $days,
            $this->algorithm->getMonthDays($y, $m)
        );
    }

    #[DataProvider('gregorianDateProvider')]
    public function testConstructDateValues($d, $m, $y)
    {
        $date = $this->algorithm->constructDateValue($d, $m, $y);
        $this->assertSame($d, $date->getMonthDay());
        $this->assertSame($m, $date->getMonth());
        $this->assertSame($y, $date->getYear());
    }

    public static function gregorianDateProvider()
    {
        return
            [
                [24, 6, 2015, 2457198],
                [28, 2, 2015, 2457082],
                [29, 2, 2016, 2457448],
            ];
    }

    public static function gregorianMonthDaysProvider()
    {
        return
            [
                [6, 2015, 30],
                [2, 2015, 28],
                [2, 2016, 29],
                [2, 2017, 28],
                [12, 2017, 31],
            ];
    }

    public static function invalidGregorianDateProvider()
    {
        return
          [
            [29, 2, 2015],
          ];
    }
}
