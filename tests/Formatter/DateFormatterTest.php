<?php

namespace Hussainweb\DateConverter\Tests\Formatter;

use Hussainweb\DateConverter\Formatter\DateFormatter;
use Hussainweb\DateConverter\Algorithm\GregorianAlgorithm;
use Hussainweb\DateConverter\Value\GregorianDate;

/**
 * Test for class DateFormatter
 *
 * @coversDefaultClass \Hussainweb\DateConverter\Formatter\DateFormatter
 */
class DateFormatterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider gregorianFormatProvider
     * @covers ::format
     */
    public function testFormatterIsNull($d, $m, $y, $format, $return)
    {
        $algorithm = new GregorianAlgorithm();
        $date = new GregorianDate($d, $m, $y);
        $formatter = $this->getMockForAbstractClass(DateFormatter::class, [$algorithm, $date]);
        $this->assertSame($return, $formatter->format($format));
    }

    public function gregorianFormatProvider()
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
