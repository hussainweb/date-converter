<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter\Value;

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
        parent::__construct($month_day, $month, $year);
    }
}
