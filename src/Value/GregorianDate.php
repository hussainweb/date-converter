<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter\Value;

use Hussainweb\DateConverter\InvalidDateException;

class GregorianDate extends Date
{

    /**
     * @var \DateTimeInterface
     */
    protected $datetime;

    public function __construct($month_day, $month, $year)
    {
        // Create a DateTime object directly.
        $this->datetime = \DateTimeImmutable::createFromFormat('n/j/Y', sprintf('%d/%d/%d', $month, $month_day, $year));
        $errors = $this->datetime->getLastErrors();
        if (!empty($errors['warning_count']) || !empty($errors['error_count'])) {
            throw new InvalidDateException($errors);
        }

        parent::__construct($month_day, $month, $year);
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
    public function getJulianDay()
    {
        return gregoriantojd($this->month, $this->monthDay, $this->year);
    }

    /**
     * {@inheritdoc}
     */
    public static function fromJulianDay($julian_day)
    {
        list($m, $d, $y) = explode('/', jdtogregorian($julian_day));
        return new static($d, $m, $y);
    }
}
