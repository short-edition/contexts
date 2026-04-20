<?php

namespace Behatch\Json;

use Symfony\Component\PropertyAccess\PropertyAccessor;

class Json
{
    protected mixed $content {
        get => $this->content;
    }

    /**
     * @throws \Exception
     */
    public function __construct($content)
    {
        $this->content = $this->decode((string) $content);
    }

    public function read($expression, PropertyAccessor $accessor)
    {
        if (is_array($this->content)) {
            $expression =  preg_replace('/^root/', '', $expression);
        } else {
            $expression =  preg_replace('/^root./', '', $expression);
        }

        // If root asked, we return the entire content
        if (strlen(trim($expression)) <= 0) {
            return $this->content;
        }

        return $accessor->getValue($this->content, $expression);
    }

    public function encode($pretty = true): false|string
    {
        $flags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

        if (true === $pretty && defined('JSON_PRETTY_PRINT')) {
            $flags |= JSON_PRETTY_PRINT;
        }

        return json_encode($this->content, $flags);
    }

    public function __toString()
    {
        return $this->encode(false);
    }

    /**
     * @throws \Exception
     */
    private function decode($content)
    {
        $result = json_decode($content);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("The string '$content' is not valid json");
        }

        return $result;
    }
}
