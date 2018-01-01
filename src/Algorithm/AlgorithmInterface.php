<?php

namespace Hussainweb\DateConverter\Algorithm;

use Hussainweb\DateConverter\Value\DateInterface;

interface AlgorithmInterface
{

    /**
     * @param $julian_day The Julian Day count.
     * @return DateInterface
     */
    public function fromJulianDay($julian_day);

    /**
     * @param \Hussainweb\DateConverter\Value\DateInterface $date The date to convert
     * @return int The Julian Day Count for the $date
     */
    public function toJulianDay(DateInterface $date);

    /**
     * @param int $month_day The day of the month
     * @param int $month The month
     * @param int $year The year
     * @param array $errors The array to populate with errors and warnings
     * @return bool If the date is valid as per the algorithm, true.
     */
    public function isValidDate($month_day, $month, $year, &$errors);

    /**
     * @param int $year The year
     * @param int $month The month
     * @return int The number of days in the specified month/year.
     */
    public function getMonthDays($year, $month);
}
