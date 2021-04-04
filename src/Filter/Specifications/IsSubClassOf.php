<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\FqcnSpecification;
use FlexFqcnFinder\Filter\ReflectionSpecificationTrait;
use ReflectionClass;

class IsSubClassOf implements FqcnSpecification
{
    use ReflectionSpecificationTrait;

    /**
     * @var string
     */
    protected $class;

    protected function isSatisfiedByReflection(string $fqcn, ReflectionClass $reflectionClass): bool
    {
        return $reflectionClass->isSubclassOf($this->class);
    }
}
