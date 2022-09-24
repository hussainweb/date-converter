<?php

namespace Hussainweb\DateConverter\Algorithm;

use Hussainweb\DateConverter\Algorithm\AlgorithmInterface;
use Hussainweb\DateConverter\Value\Date;
use Hussainweb\DateConverter\Value\DateInterface;
use Hussainweb\DateConverter\Value\NativeDate;

class NativeAlgorithm implements AlgorithmInterface
{
    use ValidDateTimeCheck;

    /**
     * {@inheritdoc}
     */
    public function fromJulianDay($julian_day)
    {
        return new NativeDate(jdtounix($julian_day));
    }

    /**
     * {@inheritdoc}
     */
    public function toJulianDay(DateInterface $date)
    {
        if (!$date instanceof NativeDate) {
            throw new \InvalidArgumentException("The date must be NativeDate");
        }
        return unixtojd($date->getTimeStamp());
    }

    /**
     * {@inheritdoc}
     */
    public function getMonthDays($year, $month)
    {
        throw new \InvalidArgumentException("Native dates do not have a concept of month and year");
    }

    /**
     * @inheritDoc
     */
    public function constructDateValue($month_day, $month, $year)
    {
        return new NativeDate(mktime(0, 0, 0, $month, $month_day, $year));
    }
}
