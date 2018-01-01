<?php

namespace Hussainweb\DateConverter\Formatter;

class GregorianDateFormatter extends DateFormatter
{

    /**
     * @inheritDoc
     */
    public function getMonthNames()
    {
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = date('F', mktime(0, 0, 0, $i, 1, 2017));
        }
        return $months;
    }

    /**
     * @inheritDoc
     */
    public function getShortMonthNames()
    {
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = date('M', mktime(0, 0, 0, $i, 1, 2017));
        }
        return $months;
    }
}
