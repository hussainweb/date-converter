<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter\Strategy\Algorithm;

use Hussainweb\DateConverter\Strategy\AlgorithmInterface;
use Hussainweb\DateConverter\Value\DateInterface;
use Hussainweb\DateConverter\Value\NativeDate;

/**
 * Class NativeAlgorithm
 * @package Hussainweb\DateConverter\Strategy\Algorithm
 */
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
}
