<?php

namespace Hussainweb\DateConverter\Tests\Value;

use Hussainweb\DateConverter\Formatter\GregorianDateFormatter;
use Hussainweb\DateConverter\InvalidDateException;
use Hussainweb\DateConverter\Value\GregorianDate;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(GregorianDate::class)]
class GregorianDateTest extends TestCase
{
    #[DataProvider('gregorianDateProvider')]
    public function testGregorianDates($d, $m, $y)
    {
        $gregorian_date = new GregorianDate($d, $m, $y);
        $this->assertEquals($d, $gregorian_date->getMonthDay());
        $this->assertEquals($m, $gregorian_date->getMonth());
        $this->assertEquals($y, $gregorian_date->getYear());
    }

    #[DataProvider('gregorianDateProvider')]
    public function testGregorianDatesDateTime($d, $m, $y)
    {
        $gregorian_date = new GregorianDate($d, $m, $y);
        $dt = $gregorian_date->getDateTime();
        $this->assertEquals($d, $dt->format('j'));
        $this->assertEquals($m, $dt->format('n'));
        $this->assertEquals($y, $dt->format('Y'));
    }

    #[DataProvider('invalidGregorianDateProvider')]
    public function testInvalidGregorianDates($d, $m, $y)
    {
        $this->expectException(InvalidDateException::class);
        $gregorian_date = new GregorianDate($d, $m, $y);
    }

    #[DataProvider('gregorianDateProvider')]
    public function testFormatter($d, $m, $y)
    {
        $gregorian_date = new GregorianDate($d, $m, $y);
        $formatter = $gregorian_date->getFormatter();
        $this->assertTrue($formatter instanceof GregorianDateFormatter);
        $this->assertSame($y, (int) $formatter->format('Y'));
        $this->assertSame($m, (int) $formatter->format('m'));
    }

    public static function gregorianDateProvider()
    {
        return
        [
            [24, 6, 2015],
            [28, 2, 2015],
            [29, 2, 2016],
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
