<?php

namespace App\Exceptions;


use RuntimeException;

/** @noinspection PhpClassNamingConventionInspection */

/**
 * Class NoQuestionInProcedure
 * @package App\Exceptions
 */
class NoQuestionInProcedure extends RuntimeException
{
    protected $message;
    protected $code;

    /**
     * InvalidKeysException constructor.
     * @param $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        $this->message = $message;
        $this->code = $code;

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode()
    {

        return $this->code;
    }
}