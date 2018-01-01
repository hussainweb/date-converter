<?php

namespace Hussainweb\DateConverter\Formatter;

use Hussainweb\DateConverter\Value\DateInterface;

interface DateFormatterInterface
{

    /**
     * Formats a date per the given format string.
     *
     * @param string $format
     *   Format in date() style specifiers.
     *
     * @return string The formatted date.
     */
    public function format($format);

    /**
     * @return string[] Name of months in the calendar system
     */
    public function getMonthNames();

    /**
     * @return string[] Name of months (short style) in the calendar system
     */
    public function getShortMonthNames();
}
