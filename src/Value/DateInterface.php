<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter\Value;

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
}
