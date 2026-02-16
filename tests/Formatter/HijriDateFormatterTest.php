<?php

/**
 * Created by PhpStorm.
 * User: hw
 * Date: 01/01/2018
 * Time: 19:25
 */

namespace Hussainweb\DateConverter\Tests\Formatter;

use Hussainweb\DateConverter\Algorithm\Hijri\HijriFatimidAstronomical;
use Hussainweb\DateConverter\Formatter\HijriDateFormatter;
use Hussainweb\DateConverter\Value\HijriDate;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(HijriDateFormatter::class)]
class HijriDateFormatterTest extends TestCase
{
    #[DataProvider('hijriFormatProvider')]
    public function testFormatterIsNull($d, $m, $y, $format, $return)
    {
        $date = new HijriDate($d, $m, $y, new HijriFatimidAstronomical());
        $formatter = $date->getFormatter();
        $this->assertSame($return, $formatter->format($format));
    }

    public function testGetMonthNames()
    {
        $date = new HijriDate(1, 1, 1438, new HijriFatimidAstronomical());
        $formatter = $date->getFormatter();
        $this->assertSame(12, count($formatter->getMonthNames()));
    }

    public function testGetShortMonthNames()
    {
        $date = new HijriDate(1, 1, 1438, new HijriFatimidAstronomical());
        $formatter = $date->getFormatter();
        $this->assertSame(12, count($formatter->getShortMonthNames()));
    }

    public static function hijriFormatProvider()
    {
        return [
            [1, 1, 1438, 'd-M-Y', '01-Moharram-1438'],
            [1, 1, 1438, 'd-F-Y', '01-Moharramul Haram-1438'],
            [1, 1, 1438, 'y', '38'],
            [1, 1, 1438, 'n', '1'],
            [1, 1, 1438, 'm', '01'],
            [1, 1, 1438, 'j', '1'],
            [1, 1, 1438, 'd', '01'],
            [1, 1, 1438, 'jS', '1st'],
            [2, 9, 1438, 'jS', '2nd'],
            [3, 2, 1438, 'jS', '3rd'],
            [7, 5, 1438, 'jS', '7th'],
            [1, 1, 1438, 't', '30'],
            [1, 9, 1438, 't', '30'],
            [1, 10, 1438, 't', '29'],
            [1, 12, 1439, 't', '30'],
            [1, 1, 1438, '\Y = Y', 'Y = 1438'],
        ];
    }
}
