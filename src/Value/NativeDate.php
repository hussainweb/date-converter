<?php

namespace Hussainweb\DateConverter\Value;

class NativeDate extends Date
{

    /**
     * @var int
     */
    protected $timestamp;

    public function __construct($timestamp)
    {
        $month_day = date('j', $timestamp);
        $month = date('n', $timestamp);
        $year = date('Y', $timestamp);
        $this->timestamp = $timestamp;

        parent::__construct($month_day, $month, $year);
    }

    /**
     * @return int Timestamp for this NativeDate.
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
