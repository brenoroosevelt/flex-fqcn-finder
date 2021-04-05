<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter;

use ReflectionClass;
use ReflectionException;

trait ReflectionSpecificationTrait
{
    public function isSatisfiedBy(string $class): bool
    {
        try {
            $reflectionClass = new ReflectionClass($class);
        } catch (ReflectionException $exception) {
            return false;
        }

        return $this->isSatisfiedByReflection($class, $reflectionClass);
    }

    abstract protected function isSatisfiedByReflection(string $fqcn, ReflectionClass $reflectionClass): bool;
}
