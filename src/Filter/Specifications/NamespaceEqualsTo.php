<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\FqcnSpecification;
use FlexFqcnFinder\Filter\ReflectionSpecificationTrait;
use ReflectionClass;

class NamespaceEqualsTo implements FqcnSpecification
{
    use ReflectionSpecificationTrait;

    /**
     * @var string
     */
    protected $namespace;

    public function __construct(string $namespace)
    {
        $this->namespace = $namespace;
    }

    protected function isSatisfiedByReflection(string $fqcn, ReflectionClass $reflectionClass): bool
    {
        return $reflectionClass->getNamespaceName() === $this->namespace;
    }
}
