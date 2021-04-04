<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\FqcnSpecification;
use FlexFqcnFinder\Filter\ReflectionSpecificationTrait;
use ReflectionClass;

class ImplementsInterface implements FqcnSpecification
{
    use ReflectionSpecificationTrait;

    /**
     * @var string
     */
    protected $interface;

    public function __construct(string $interface)
    {
        $this->interface = $interface;
    }

    protected function isSatisfiedByReflection(string $fqcn, ReflectionClass $reflectionClass): bool
    {
        return
            $reflectionClass->implementsInterface($this->interface) &&
            $this->interface !== $fqcn;
    }
}
