<?php

namespace Hussainweb\DateConverter\Value;

use Hussainweb\DateConverter\InvalidDateException;
use Hussainweb\DateConverter\Strategy\Algorithm\Hijri\HijriAlgorithmBase;

class HijriDate extends Date
{

    /**
     * @var \Hussainweb\DateConverter\Strategy\Algorithm\Hijri\HijriAlgorithmBase
     */
    protected $algorithm;

    public function __construct($month_day, $month, $year, HijriAlgorithmBase $algorithm)
    {
        $this->algorithm = $algorithm;
        if (!$this->algorithm->isValidDate($month_day, $month, $year, $errors)) {
            throw new InvalidDateException($errors);
        }

        parent::__construct($month_day, $month, $year);
    }
}
