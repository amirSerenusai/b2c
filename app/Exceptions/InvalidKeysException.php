<?php

namespace App\Exceptions;


use RuntimeException;

class InvalidKeysException extends RuntimeException
{
    protected $message;
    protected $code;
    protected $expression;
    protected $orignal_expression;
    protected $source;

    /**
     * InvalidKeysException constructor.
     * @param $message
     * @param int $code
     * @param \Exception|null $previous
     * @param object $source the source (question/answer) of the problem
     * 
     * @param $expression
     * @param $orignal_expression

     */
    public function __construct($message, $code = 406, \Exception $previous = null, $expression = '', $orignal_expression = '', $source = null)
    {
        $this->message = $message;
        $this->code = $code;
        $this->expression = $expression;
        $this->orignal_expression = $orignal_expression;
        $this->source = $source;
        
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode()
    {
        return $this->code;
    }

    public function getExpression()
    {
        return $this->expression;
    }
    public function getOriginalExpression()
    {
        return $this->orignal_expression;
    }
    public function getSource()
    {
        return $this->source;
    }
}