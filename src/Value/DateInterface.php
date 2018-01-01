<?php

namespace Hussainweb\DateConverter\Value;

use Hussainweb\DateConverter\Formatter\DateFormatterInterface;

interface DateInterface
{

    /**
     * @return int The day of the month of this date.
     */
    public function getMonthDay();

    /**
     * @return int The month number of this date.
     */
    public function getMonth();

    /**
     * @return int The year of this date.
     */
    public function getYear();

    /**
     * @return DateFormatterInterface Date Formatter
     */
    public function getFormatter();
}
