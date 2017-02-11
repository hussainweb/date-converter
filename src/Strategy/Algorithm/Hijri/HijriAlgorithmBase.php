<?php

namespace Hussainweb\DateConverter\Strategy\Algorithm\Hijri;

use Hussainweb\DateConverter\Strategy\AlgorithmInterface;
use Hussainweb\DateConverter\Value\DateInterface;
use Hussainweb\DateConverter\Value\HijriDate;

abstract class HijriAlgorithmBase implements AlgorithmInterface
{

    const EPOCH_CIVIL = 1948085;

    const EPOCH_ASTRONOMICAL = 1948084;

    /**
     * return float
     */
    abstract protected function getEpoch();

    /**
     * @return double
     */
    abstract protected function getShift();

    /**
     * @return int
     */
    abstract protected function getYearOffsetShift();

    /**
     * @param int $year The Hijri year to check.
     * @return bool True if the year is kabisa.
     */
    abstract protected function isKabisa($year);

    /**
     * {@inheritdoc}
     */
    public function isValidDate($month_day, $month, $year, &$errors = [])
    {
        $errors['errors'] = $errors['warnings'] = [];
        if ($month > 12 || $month < 1) {
            $errors['errors'][] = 'Invalid month specified';
        }

        if ($month_day > 30 || $month_day < 1) {
            $errors['errors'][] = 'Invalid month day specified';
        }

        if ($month % 2 == 0 && $month != 12 && $month_day == 30) {
            $errors['errors'][] = 'Even numbered months cannot have 30 days';
        }

        if ($month == 12 && !$this->isKabisa($year) && $month_day == 30) {
            $errors['errors'][] = 'The last month cannot have 30 days unless it is kabisa';
        }

        $errors['error_count'] = count($errors['errors']);
        $errors['warning_count'] = count($errors['warnings']);

        return ($errors['error_count'] == 0 && $errors['warning_count'] == 0);
    }

    /**
     * {@inheritdoc}
     */
    public function fromJulianDay($julian_day)
    {
        $jd = floor($julian_day);
        $days_per_year = 10631 / 30;

        $shift = $this->getShift();

        $z = $jd - $this->getEpoch();
        $cyc = floor($z / 10631);
        $z -= 10631 * $cyc;
        $j = floor(($z - $shift) / $days_per_year);
        $year = 30 * $cyc + $j;
        $z -= floor($j * $days_per_year + $shift);
        $month = floor(($z + 28.5001) / 29.5);
        if ($month == 13) {
            $month = 12;
        }
        $day = $z - floor(29.5001 * $month - 29);

        return new HijriDate($day, $month, $year, $this);
    }

    /**
     * {@inheritdoc}
     */
    public function toJulianDay(DateInterface $date)
    {
        $day = $date->getMonthDay();
        $month = $date->getMonth();
        $year = $date->getYear();
        return ($day +
          ceil(29.5 * ($month - 1)) +
          (354 * ($year)) +
          floor(($this->getYearOffsetShift() + (11 * $year)) / 30) +
          $this->getEpoch());
    }
}
