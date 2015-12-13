<?php

/**
 * @file
 */

namespace Hussainweb\DateConverter;

use Hussainweb\DateConverter\Strategy\StrategyInterface;

class DateConverter
{

    /**
     * @var \Hussainweb\DateConverter\Strategy\StrategyInterface
     */
    protected $strategy;

    public function __construct(StrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }
}
