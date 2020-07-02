<?php

namespace shweshi\OpenGraph\Exceptions;

class FetchException extends \Exception
{
    private $data;

    public function __construct(
        $message = '',
        $code = 0,
        \Throwable $previous = null,
        $data = []
    ) {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
