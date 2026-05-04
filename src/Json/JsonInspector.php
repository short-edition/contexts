<?php

declare(strict_types=1);

namespace Behatch\Json;

use JsonSchema\Validator;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class JsonInspector
{
    private mixed $evaluationMode;

    private PropertyAccessor $accessor;

    public function __construct(mixed $evaluationMode)
    {
        $this->evaluationMode = $evaluationMode;
        $this->accessor = new PropertyAccessor();
    }

    public function evaluate(Json $json, mixed $expression)
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

    public function validate(Json $json, JsonSchema $schema): bool
    {
        $validator = new Validator();

        $resolver = new \JsonSchema\SchemaStorage(new \JsonSchema\Uri\UriRetriever(), new \JsonSchema\Uri\UriResolver());
        $schema->resolve($resolver);

        return $schema->validate($json, $validator);
    }
}
