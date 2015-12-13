<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter\Value;

class NativeDate extends Date
{
    protected $timestamp;

    public function __construct($timestamp)
    {
        $month_day = date('n', $timestamp);
        $month = date('j', $timestamp);
        $year = date('Y', $timestamp);
        $this->timestamp = $timestamp;

        parent::__construct($month_day, $month, $year);
    }

    /**
     * {@inheritdoc}
     */
    public function getJulianDay()
    {
        return unixtojd($this->timestamp);
    }

    /**
     * {@inheritdoc}
     */
    public function setJulianDay($julian_day)
    {
        return new static(jdtounix($julian_day));
    }

}
