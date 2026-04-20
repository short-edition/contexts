<?php

namespace Behatch\HttpCall;

class HttpCallResult
{
    public $value {
        get {
            return $this->value;
        }
    }

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function update($value): void
    {
        $this->value = $value;
    }

}
