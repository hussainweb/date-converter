<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter\Value;

abstract class Date implements DateInterface
{

    /**
     * @var int
     */
    protected $monthDay;

    /**
     * @var int
     */
    protected $month;

    /**
     * @var int
     */
    protected $year;

    public function __construct($month_day, $month, $year)
    {
        $this->monthDay = $month_day;
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * {@inheritdoc}
     */
    public function getMonthDay()
    {
        return $this->monthDay;
    }

    /**
     * {@inheritdoc}
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * {@inheritdoc}
     */
    public function getYear()
    {
        return $this->year;
    }
}
