<?php

declare(strict_types=1);

namespace Behatch\HttpCall;

use Behat\Behat\Context\Argument\ArgumentResolver;

class HttpCallResultPoolResolver implements ArgumentResolver
{
    private array $dependencies;

    public function __construct(/* ... */)
    {
        $this->dependencies = [];

        foreach (\func_get_args() as $param) {
            $this->dependencies[$param::class] = $param;
        }
    }

    public function resolveArguments(\ReflectionClass $classReflection, array $arguments): array
    {
        $constructor = $classReflection->getConstructor();
        if (null !== $constructor) {
            $parameters = $constructor->getParameters();
            foreach ($parameters as $parameter) {
                if (
                    null !== $parameter->getClass()
                    && isset($this->dependencies[$parameter->getClass()->name])
                ) {
                    $arguments[$parameter->name] = $this->dependencies[$parameter->getClass()->name];
                }
            }
        }

        return $arguments;
    }
}
