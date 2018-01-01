<?php

namespace Hussainweb\DateConverter\Strategy\Algorithm;

use Hussainweb\DateConverter\Strategy\AlgorithmInterface;
use Hussainweb\DateConverter\Value\DateInterface;
use Hussainweb\DateConverter\Value\GregorianDate;

class GregorianAlgorithm implements AlgorithmInterface
{

    use ValidDateTimeCheck;

    /**
     * {@inheritdoc}
     */
    public function fromJulianDay($julian_day)
    {
        list($m, $d, $y) = explode('/', jdtogregorian($julian_day));
        return new GregorianDate($d, $m, $y);
    }

    /**
     * {@inheritdoc}
     */
    public function toJulianDay(DateInterface $date)
    {
        return gregoriantojd($date->getMonth(), $date->getMonthDay(), $date->getYear());
    }

    /**
     * {@inheritdoc}
     */
    public function getMonthDays($year, $month)
    {
        $timestamp = mktime(12, 0, 0, $month, 1, $year);
        return (int) date('t', $timestamp);
    }
}
