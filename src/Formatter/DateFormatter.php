<?php

namespace Hussainweb\DateConverter\Formatter;

use Hussainweb\DateConverter\Algorithm\AlgorithmInterface;
use Hussainweb\DateConverter\Value\DateInterface;

abstract class DateFormatter implements DateFormatterInterface
{

    /**
     * @var AlgorithmInterface
     */
    protected $algorithm;

    /**
     * @var DateInterface
     */
    protected $date;

    public function __construct(AlgorithmInterface $algorithm, DateInterface $date)
    {
        $this->algorithm = $algorithm;
        $this->date = $date;
    }

    /**
     * {@inheritdoc}
     */
    public function format($format)
    {
        $timestamp = null;

        $year = $this->date->getYear();
        $month = $this->date->getMonth();
        $month_day = $this->date->getMonthDay();

        $return = "";
        $backslash = false;

        for ($i = 0; $i < strlen($format); $i++) {
            $format_char = $format[$i];
            if ($backslash) {
                $return .= $format_char;
                $backslash = false;
            } else {
                switch ($format_char) {
                    case "\\":
                        $backslash = true;
                        break;

                    case "Y":
                        $return .= $year;
                        break;

                    case "y":
                        $return .= substr($year, 2);
                        break;

                    case "M":
                        $return .= $this->getShortMonthNames()[$month];
                        break;

                    case "F":
                        $return .= $this->getMonthNames()[$month];
                        break;

                    case "m":
                        $return .= str_pad($month, 2, "0", STR_PAD_LEFT);
                        break;

                    case "n":
                        $return .= $month;
                        break;

                    case "d":
                        $return .= str_pad($month_day, 2, "0", STR_PAD_LEFT);
                        break;

                    case "j":
                        $return .= $month_day;
                        break;

                    case "S":
                        $d = (int) $month_day;
                        if ($d > 3 && $d < 21 || $d > 23 && $d < 31) {
                            $return .= "th";
                        } elseif ($d % 10 == 1) {
                            $return .= "st";
                        } elseif ($d % 10 == 2) {
                            $return .= "nd";
                        } elseif ($d % 10 == 3) {
                            $return .= "rd";
                        }
                        break;

                    case "t":
                        $return .= $this->algorithm->getMonthDays($year, $month);
                        break;

                    default:
                        // Pass it on to date() function.
                        if (is_null($timestamp)) {
                            $timestamp = jdtounix($this->algorithm->toJulianDay($this->date));
                        }
                        $return .= date($format_char, $timestamp);
                }
            }
        }

        return $return;
    }
}
