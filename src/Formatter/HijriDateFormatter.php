<?php

namespace Hussainweb\DateConverter\Formatter;

class HijriDateFormatter extends DateFormatter
{

    /**
     * @inheritDoc
     */
    public function getMonthNames()
    {
        return [
            1 => 'Moharramul Haram',
            2 => 'Safarul Muzaffar',
            3 => 'Rabiul Awwal',
            4 => 'Rabiul Aakhar',
            5 => 'Jumadil Awwal',
            6 => 'Jumadil Aakhar',
            7 => 'Rajabul Asab',
            8 => 'Shabanul Karim',
            9 => 'Ramadanul Moazzam',
            10 => 'Shawwalul Mukarram',
            11 => 'Zilqadatil Haram',
            12 => 'Zilhajjatil Haram',
        ];
    }

    /**
     * @inheritDoc
     */
    public function getShortMonthNames()
    {
        return [
            1 => 'Moharram',
            2 => 'Safar',
            3 => 'Rabiul Awwal',
            4 => 'Rabiul Aakhar',
            5 => 'Jumadil Awwal',
            6 => 'Jumadil Aakhar',
            7 => 'Rajab',
            8 => 'Shaban',
            9 => 'Ramadan',
            10 => 'Shawwal',
            11 => 'Zilqad',
            12 => 'Zilhajj',
        ];
    }
}
