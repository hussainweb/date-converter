<?php

namespace Hussainweb\DateConverter;

class InvalidDateException extends \RuntimeException
{

    /**
     * @var array
     */
    protected $errors;

    public function __construct(array $errors, $code = 0, \Exception $previous = null)
    {
        $this->errors = $errors;

        // Construct a message.
        $message = "";
        foreach ($errors['warnings'] as $code => $warning) {
            $message .= sprintf("WARNING: %s: %s\n", $code, $warning);
        }
        foreach ($errors['errors'] as $code => $error) {
            $message .= sprintf("ERROR: %s: %s\n", $code, $error);
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array Error information as returned by DateTime objects.
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
