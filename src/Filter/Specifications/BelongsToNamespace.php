<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\FqcnSpecification;
use FlexFqcnFinder\Filter\ReflectionSpecificationTrait;
use ReflectionClass;

class BelongsToNamespace implements FqcnSpecification
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
        $namespace = $reflectionClass->getNamespaceName();
        return substr_compare($namespace, $this->namespace, 0, strlen($this->namespace)) === 0;
    }
}
