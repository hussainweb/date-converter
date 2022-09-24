<?php

namespace Hussainweb\DateConverter\Tests\Formatter;

use Hussainweb\DateConverter\Formatter\GregorianDateFormatter;
use Hussainweb\DateConverter\Algorithm\GregorianAlgorithm;
use Hussainweb\DateConverter\Value\GregorianDate;
use PHPUnit\Framework\TestCase;

/**
 * Test for class GregorianDateFormatter
 *
 * @coversDefaultClass \Hussainweb\DateConverter\Formatter\GregorianDateFormatter
 */
class GregorianDateFormatterTest extends TestCase
{

    /**
     * @dataProvider gregorianFormatProvider
     * @covers ::__construct
     * @covers ::format
     * @covers ::getMonthNames
     * @covers ::getShortMonthNames
     */
    public function testFormatterIsNull($d, $m, $y, $format, $return)
    {
        $algorithm = new GregorianAlgorithm();
        $date = new GregorianDate($d, $m, $y);
        $formatter = new GregorianDateFormatter($algorithm, $date);
        $this->assertSame($return, $formatter->format($format));
    }

    /**
     * @covers ::getMonthNames
     */
    public function testGetMonthNames()
    {
        $date = new GregorianDate(1, 1, 2017);
        $formatter = new GregorianDateFormatter(new GregorianAlgorithm(), $date);
        $this->assertSame(12, count($formatter->getMonthNames()));
    }

    /**
     * @covers ::getShortMonthNames
     */
    public function testGetShortMonthNames()
    {
        $date = new GregorianDate(1, 1, 2017);
        $formatter = new GregorianDateFormatter(new GregorianAlgorithm(), $date);
        $this->assertSame(12, count($formatter->getShortMonthNames()));
    }

    public function gregorianFormatProvider()
    {
        return [
            [1, 1, 2017, 'd-M-Y', '01-Jan-2017'],
            [1, 1, 2017, 'd-F-Y', '01-January-2017'],
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
