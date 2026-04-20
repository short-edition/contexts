<?php

namespace Behatch\HttpCall;

class RestContextVoter implements ContextSupportedVoter, FilterableHttpCallResult
{
    public function vote(HttpCallResult $httpCallResult): bool
    {
        return $httpCallResult->value instanceof \Behat\Mink\Element\DocumentElement;
    }

    public function filter(HttpCallResult $httpCallResult)
    {
        return $httpCallResult->value->getContent();
    }
}
