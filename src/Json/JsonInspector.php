<?php

declare(strict_types=1);

namespace Behatch\Json;

use JsonSchema\Validator;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class JsonInspector
{
    private $evaluationMode;

    private $accessor;

    public function __construct($evaluationMode)
    {
        $this->evaluationMode = $evaluationMode;
        $this->accessor = new PropertyAccessor(false, true);
    }

    public function evaluate(Json $json, $expression)
    {
        if ('javascript' === $this->evaluationMode) {
            $expression = str_replace('->', '.', $expression);
        }

        try {
            return $json->read($expression, $this->accessor);
        } catch (\Exception $e) {
            throw new \Exception("Failed to evaluate expression '$expression'");
        }
    }

    public function validate(Json $json, JsonSchema $schema)
    {
        $validator = new Validator();

        $resolver = new \JsonSchema\SchemaStorage(new \JsonSchema\Uri\UriRetriever(), new \JsonSchema\Uri\UriResolver());
        $schema->resolve($resolver);

        return $schema->validate($json, $validator);
    }
}
