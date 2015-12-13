<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter\Value;

class GregorianDate extends Date
{

    public function __construct($month_day, $month, $year)
    {
        parent::__construct($month_day, $month, $year);
    }

    /**
     * {@inheritdoc}
     */
    public function getJulianDay()
    {
        return gregoriantojd($this->month, $this->monthDay, $this->year);
    }

    /**
     * {@inheritdoc}
     */
    public function setJulianDay($julian_day)
    {
        return new static(\DateTimeImmutable::createFromFormat('n/j/Y', jdtogregorian($julian_day)));
    }
}
