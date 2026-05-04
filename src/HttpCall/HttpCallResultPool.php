<?php

declare(strict_types=1);

namespace Behatch\HttpCall;

class HttpCallResultPool
{
    public ?HttpCallResult $result {
        get => $this->result;
    }

    public function store(HttpCallResult $result): void
    {
        $this->result = $result;
    }
}
