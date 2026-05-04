<?php

declare(strict_types=1);

namespace Behatch\HttpCall;

use Behat\Mink\Mink;

class Request
{
    private Mink $mink;
    private $client;

    /**
     * Request constructor.
     */
    public function __construct(Mink $mink)
    {
        $this->mink = $mink;
    }

    public function __call(string $name, mixed $arguments)
    {
        return \call_user_func_array([$this->getClient(), $name], $arguments);
    }

    private function getClient(): Request\BrowserKit
    {
        if (null === $this->client) {
            $this->client = new Request\BrowserKit($this->mink);
        }

        return $this->client;
    }
}
