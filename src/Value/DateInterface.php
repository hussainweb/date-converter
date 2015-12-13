<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter\Value;

interface DateInterface
{

    /**
     * @return \DateTimeInterface
     */
    public function getDateTime();

    /**
     * @return int The Julian Day count for this date.
     */
    public function getJulianDay();

    /**
     * @param int $julian_day The Julian Day count for the date.
     * @return DateInterface
     */
    public function setJulianDay($julian_day);

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
