<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter\Value;

abstract class Date implements DateInterface
{

    /**
     * @var \DateTimeInterface
     */
    protected $datetime;

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
    public function getDateTime()
    {
        return clone $this->datetime;
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

    /**
     * {@inheritdoc}
     */
    public function diff($datetime2, $absolute = false)
    {
        return $this->datetime->diff($datetime2, $absolute);
    }

    /**
     * {@inheritdoc}
     */
    public function format($format)
    {
        return $this->datetime->format($format);
    }

    /**
     * {@inheritdoc}
     */
    public function getOffset()
    {
        return $this->datetime->getOffset();
    }

    /**
     * {@inheritdoc}
     */
    public function getTimestamp()
    {
        return $this->datetime->getTimestamp();
    }

    /**
     * {@inheritdoc}
     */
    public function getTimezone()
    {
        return $this->datetime->getTimezone();
    }

    /**
     * {@inheritdoc}
     */
    public function __wakeup()
    {
        return $this->datetime->__wakeup();
    }

}
