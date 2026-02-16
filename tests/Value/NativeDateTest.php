<?php

namespace Hussainweb\DateConverter\Tests\Value;

use Hussainweb\DateConverter\Value\NativeDate;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(NativeDate::class)]
class NativeDateTest extends TestCase
{
    #[DataProvider('nativeDateProvider')]
    public function testNativeDates($ts, $d, $m, $y)
    {
        $native_date = new NativeDate($ts);
        $this->assertEquals($d, $native_date->getMonthDay());
        $this->assertEquals($m, $native_date->getMonth());
        $this->assertEquals($y, $native_date->getYear());
    }

    #[DataProvider('nativeDateProvider')]
    public function testNativeDatesTimestamps($ts, $d, $m, $y)
    {
        $native_date = new NativeDate($ts);
        $this->assertEquals($ts, $native_date->getTimestamp());
    }

    public static function nativeDateProvider()
    {
        return
        [
            [1435104000, 24, 6, 2015],
            [1425081600, 28, 2, 2015],
            [1456704000, 29, 2, 2016],
        ];
    }
}
