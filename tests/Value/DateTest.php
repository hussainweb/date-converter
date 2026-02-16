<?php

namespace Hussainweb\DateConverter\Tests\Value;

use Hussainweb\DateConverter\Value\Date;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Date::class)]
class DateTest extends TestCase
{
    #[DataProvider('dateProvider')]
    public function testDates($d, $m, $y)
    {
        $date = new class ($d, $m, $y) extends Date {
        };
        $this->assertEquals($d, $date->getMonthDay());
        $this->assertEquals($m, $date->getMonth());
        $this->assertEquals($y, $date->getYear());
    }

    public function testFormatterIsNull()
    {
        $date = new class (1, 1, 1) extends Date {
        };
        $this->assertNull($date->getFormatter());
    }

    public static function dateProvider()
    {
        return
          [
            [24, 6, 2015],
            [28, 2, 2015],
            [29, 2, 2016],
          ];
    }
}
