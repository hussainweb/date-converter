<?php

namespace Hussainweb\DateConverter\Tests\Value;

use Hussainweb\DateConverter\Formatter\HijriDateFormatter;
use Hussainweb\DateConverter\Algorithm\Hijri\HijriAlgorithmBase;
use Hussainweb\DateConverter\InvalidDateException;
use Hussainweb\DateConverter\Value\HijriDate;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(HijriDate::class)]
#[CoversClass(HijriAlgorithmBase::class)]
class HijriDateTest extends TestCase
{
    /**
     * @var \Hussainweb\DateConverter\Algorithm\Hijri\HijriAlgorithmBase
     */
    protected $algorithm;

    public function setUp(): void
    {
        $this->algorithm = new class extends HijriAlgorithmBase {
            protected function getEpoch()
            {
                return 0;
            }

            protected function getShift()
            {
                return 0.0;
            }

            protected function getYearOffsetShift()
            {
                return 0;
            }

            protected function isKabisa($year)
            {
                return false;
            }
        };
    }

    #[DataProvider('hijriDateProvider')]
    public function testHijriDates($d, $m, $y)
    {
        $hijri_date = new HijriDate($d, $m, $y, $this->algorithm);
        $this->assertEquals($d, $hijri_date->getMonthDay());
        $this->assertEquals($m, $hijri_date->getMonth());
        $this->assertEquals($y, $hijri_date->getYear());
    }

    #[DataProvider('invalidHijriDateProvider')]
    public function testInvalidHijriDates($d, $m, $y)
    {
        $this->expectException(InvalidDateException::class);
        $hijri_date = new HijriDate($d, $m, $y, $this->algorithm);
    }

    #[DataProvider('hijriDateProvider')]
    public function testFormatter($d, $m, $y)
    {
        $gregorian_date = new HijriDate($d, $m, $y, $this->algorithm);
        $formatter = $gregorian_date->getFormatter();
        $this->assertTrue($formatter instanceof HijriDateFormatter);
        $this->assertSame($y, (int) $formatter->format('Y'));
        $this->assertSame($m, (int) $formatter->format('m'));
    }

    public static function hijriDateProvider()
    {
        return
          [
            [24, 6, 1436],
            [28, 2, 1438],
            [29, 2, 1389],
          ];
    }

    public static function invalidHijriDateProvider()
    {
        return
          [
            [30, 2, 1430],
            [31, 11, 1435],
            [1, 13, 1438],
          ];
    }
}
