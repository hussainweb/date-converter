<?php

namespace Hussainweb\DateConverter\Tests\Algorithm;

use Hussainweb\DateConverter\Algorithm\NativeAlgorithm;
use Hussainweb\DateConverter\Algorithm\ValidDateTimeCheck;
use Hussainweb\DateConverter\Value\GregorianDate;
use Hussainweb\DateConverter\Value\NativeDate;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(NativeAlgorithm::class)]
#[CoversTrait(ValidDateTimeCheck::class)]
class NativeAlgorithmTest extends TestCase
{
    /**
     * @var \Hussainweb\DateConverter\Algorithm\NativeAlgorithm
     */
    protected $algorithm;

    public function setUp(): void
    {
        $this->algorithm = new NativeAlgorithm();
    }

    #[DataProvider('nativeDateProvider')]
    public function testFromJulianDay($ts, $d, $m, $y, $jd)
    {
        $date = $this->algorithm->fromJulianDay($jd);
        $this->assertSame($d, $date->getMonthDay());
        $this->assertSame($m, $date->getMonth());
        $this->assertSame($y, $date->getYear());
        $this->assertSame($ts, $date->getTimestamp());
    }

    #[DataProvider('nativeDateProvider')]
    public function testToJulianDay($ts, $d, $m, $y, $jd)
    {
        $actual_jd = $this->algorithm->toJulianDay(new NativeDate($ts));
        $this->assertSame($jd, $actual_jd);
    }

    #[DataProvider('nativeDateProvider')]
    public function testOtherToJulianDay($ts, $d, $m, $y, $jd)
    {
        $this->expectException(InvalidArgumentException::class);
        $actual_jd = $this->algorithm->toJulianDay(new GregorianDate($d, $m, $y));
    }

    #[DataProvider('nativeDateProvider')]
    public function testIsValidDate($ts, $d, $m, $y)
    {
        $this->assertTrue($this->algorithm->isValidDate($d, $m, $y));
    }

    #[DataProvider('invalidNativeDateProvider')]
    public function testIsValidDateInvalid($d, $m, $y)
    {
        $this->assertFalse($this->algorithm->isValidDate($d, $m, $y));
    }

    public function testExceptionOnGetMonthDays()
    {
        $this->expectException(InvalidArgumentException::class);
        $days = $this->algorithm->getMonthDays(2017, 1);
    }

    #[DataProvider('nativeDateProvider')]
    public function testConstructDateValues($ts, $d, $m, $y)
    {
        $date = $this->algorithm->constructDateValue($d, $m, $y);
        $this->assertSame($ts, $date->getTimestamp());
        $this->assertSame($d, $date->getMonthDay());
        $this->assertSame($m, $date->getMonth());
        $this->assertSame($y, $date->getYear());
    }

    public static function nativeDateProvider()
    {
        return
        [
            [1435104000, 24, 6, 2015, 2457198],
            [1425081600, 28, 2, 2015, 2457082],
            [1456704000, 29, 2, 2016, 2457448],
        ];
    }

    public static function invalidNativeDateProvider()
    {
        return
        [
            [29, 2, 2015],
        ];
    }
}
