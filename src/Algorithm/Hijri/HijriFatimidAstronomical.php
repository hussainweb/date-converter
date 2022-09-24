<?php

namespace Hussainweb\DateConverter\Algorithm\Hijri;

class HijriFatimidAstronomical extends HijriAlgorithmBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEpoch()
    {
        return HijriAlgorithmBase::EPOCH_ASTRONOMICAL;
    }

    /**
     * {@inheritdoc}
     */
    protected function getShift()
    {
        return 0.01 / 30;
    }

    /**
     * {@inheritdoc}
     */
    protected function getYearOffsetShift()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function isKabisa($year)
    {
        $kabisa = [2, 5, 8, 10, 13, 16, 19, 21, 24, 27, 29];
        return (in_array($year % 30, $kabisa));
    }
}
