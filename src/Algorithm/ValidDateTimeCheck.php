<?php

namespace Hussainweb\DateConverter\Algorithm;

trait ValidDateTimeCheck
{
    /**
     * {@inheritdoc}
     */
    public function isValidDate($month_day, $month, $year, &$errors = null)
    {
        // Create a DateTime object directly.
        $datetime = \DateTimeImmutable::createFromFormat('n/j/Y', sprintf('%d/%d/%d', $month, $month_day, $year));
        $errors = $datetime->getLastErrors();
        return (empty($errors['warning_count']) && empty($errors['error_count']));
    }
}
