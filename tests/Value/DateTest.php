<?php

namespace Hussainweb\DateConverter\Tests\Value;

use Hussainweb\DateConverter\Value\Date;

/**
 * Test for class Date
 *
 * @coversDefaultClass \Hussainweb\DateConverter\Value\Date
 */
class DateTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider dateProvider
     * @covers ::__construct
     * @covers ::getMonthDay
     * @covers ::getMonth
     * @covers ::getYear
     */
    public function testDates($d, $m, $y)
    {
        $date = $this->getMockForAbstractClass(Date::class, [$d, $m, $y]);
        $this->assertEquals($d, $date->getMonthDay());
        $this->assertEquals($m, $date->getMonth());
        $this->assertEquals($y, $date->getYear());
    }

    public function dateProvider()
    {
        return
          [
            [24, 6, 2015],
            [28, 2, 2015],
            [29, 2, 2016],
          ];
    }
}
