<?php

namespace Behatch\HttpCall;

class HttpCallResultPool
{
    public ?HttpCallResult $result {
        get => $this->result;
    }

    /**
     * @param HttpCallResult $result
     */
    public function store(HttpCallResult $result): void
    {
        $this->result = $result;
    }

}
