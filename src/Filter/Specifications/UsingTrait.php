<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\FqcnSpecification;
use FlexFqcnFinder\Filter\ReflectionSpecificationTrait;
use ReflectionClass;

class UsingTrait implements FqcnSpecification
{
    use ReflectionSpecificationTrait;

    /**
     * @var string
     */
    protected $trait;

    public function __construct(string $trait)
    {
        $this->trait = $trait;
    }

    protected function isSatisfiedByReflection(string $fqcn, ReflectionClass $reflectionClass): bool
    {
        return in_array($this->trait, $reflectionClass->getTraitNames());
    }
}
