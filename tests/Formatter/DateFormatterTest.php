<?php

namespace Hussainweb\DateConverter\Tests\Formatter;

use Hussainweb\DateConverter\Formatter\DateFormatter;
use Hussainweb\DateConverter\Algorithm\GregorianAlgorithm;
use Hussainweb\DateConverter\Value\GregorianDate;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(DateFormatter::class)]
class DateFormatterTest extends TestCase
{
    #[DataProvider('gregorianFormatProvider')]
    public function testFormatterIsNull($d, $m, $y, $format, $return)
    {
        $algorithm = new GregorianAlgorithm();
        $date = new GregorianDate($d, $m, $y);
        $formatter = new class ($algorithm, $date) extends DateFormatter {
            public function getMonthNames()
            {
                return [];
            }
            public function getShortMonthNames()
            {
                return [];
            }
        };
        $this->assertSame($return, $formatter->format($format));
    }

    public static function gregorianFormatProvider()
    {
        return [
            [1, 1, 2017, 'Y', '2017'],
            [1, 1, 2017, 'y', '17'],
            [1, 1, 2017, 'n', '1'],
            [1, 1, 2017, 'm', '01'],
            [1, 1, 2017, 'j', '1'],
            [1, 1, 2017, 'd', '01'],
            [1, 1, 2017, 'jS', '1st'],
            [2, 9, 2017, 'jS', '2nd'],
            [3, 2, 2017, 'jS', '3rd'],
            [7, 5, 2017, 'jS', '7th'],
            [1, 1, 2017, 't', '31'],
            [1, 2, 2017, 't', '28'],
            [1, 2, 2016, 't', '29'],
            [1, 1, 2017, '\Y = Y', 'Y = 2017'],
        ];
    }
}
