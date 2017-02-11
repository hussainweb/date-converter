<?php

namespace Hussainweb\DateConverter\Tests\Value;

use Hussainweb\DateConverter\Strategy\Algorithm\Hijri\HijriAlgorithmBase;
use Hussainweb\DateConverter\Value\HijriDate;

/**
 * Test for class HijriDate
 *
 * @coversDefaultClass \Hussainweb\DateConverter\Value\HijriDate
 */
class HijriDateTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Hussainweb\DateConverter\Strategy\Algorithm\Hijri\HijriAlgorithmBase
     */
    protected $algorithm;

    public function setUp()
    {
        $this->algorithm = $this->getMockForAbstractClass(HijriAlgorithmBase::class);
    }

    /**
     * @dataProvider hijriDateProvider
     * @covers ::__construct
     * @covers ::getMonthDay
     * @covers ::getMonth
     * @covers ::getYear
     */
    public function testHijriDates($d, $m, $y)
    {
        $hijri_date = new HijriDate($d, $m, $y, $this->algorithm);
        $this->assertEquals($d, $hijri_date->getMonthDay());
        $this->assertEquals($m, $hijri_date->getMonth());
        $this->assertEquals($y, $hijri_date->getYear());
    }

    /**
     * @dataProvider invalidHijriDateProvider
     * @covers ::__construct
     * @covers \Hussainweb\DateConverter\Strategy\Algorithm\Hijri\HijriAlgorithmBase::isValidDate
     * @expectedException \Hussainweb\DateConverter\InvalidDateException
     */
    public function testInvalidHijriDates($d, $m, $y)
    {
        $hijri_date = new HijriDate($d, $m, $y, $this->algorithm);
    }

    public function hijriDateProvider()
    {
        return
          [
            [24, 6, 1436],
            [28, 2, 1438],
            [29, 2, 1389],
          ];
    }

    public function invalidHijriDateProvider()
    {
        return
          [
            [30, 2, 1430],
            [31, 11, 1435],
            [1, 13, 1438],
          ];
    }
}
