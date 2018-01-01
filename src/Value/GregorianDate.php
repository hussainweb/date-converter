<?php

namespace Hussainweb\DateConverter\Value;

use Hussainweb\DateConverter\Formatter\GregorianDateFormatter;
use Hussainweb\DateConverter\InvalidDateException;
use Hussainweb\DateConverter\Algorithm\GregorianAlgorithm;

class GregorianDate extends Date
{

    /**
     * @var \DateTimeInterface
     */
    protected $datetime;

    public function __construct($month_day, $month, $year)
    {
        $errors = [];
        $algorithm = new GregorianAlgorithm();
        if (!$algorithm->isValidDate($month_day, $month, $year, $errors)) {
            throw new InvalidDateException($errors);
        }

        // Create a DateTime object directly.
        $this->datetime = \DateTimeImmutable::createFromFormat('n/j/Y', sprintf('%d/%d/%d', $month, $month_day, $year));

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
    public function getFormatter()
    {
        return new GregorianDateFormatter(new GregorianAlgorithm(), $this);
    }
}
