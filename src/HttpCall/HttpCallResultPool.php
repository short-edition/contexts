<?php

namespace Behatch\HttpCall;

class HttpCallResultPool
{
    /**
     * @var HttpCallResult|null
     */
    private ?HttpCallResult $result {
        get {
            return $this->result;
        }
    }

    /**
     * @param HttpCallResult $result
     */
    public function store(HttpCallResult $result): void
    {
        $this->result = $result;
    }

}
