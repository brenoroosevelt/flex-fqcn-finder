<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter;

use ReflectionClass;
use Throwable;

trait ReflectionSpecificationTrait
{
    public function isSatisfiedBy(string $class): bool
    {
        try {
            $reflectionClass = new ReflectionClass($class);
        } catch (Throwable $exception) {
            return false;
        }

        return $this->isSatisfiedByReflection($class, $reflectionClass);
    }

    abstract protected function isSatisfiedByReflection(string $fqcn, ReflectionClass $reflectionClass): bool;
}
