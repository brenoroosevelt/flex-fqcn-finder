<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\FqcnSpecification;
use FlexFqcnFinder\Filter\ReflectionSpecificationTrait;
use ReflectionClass;

class ClassNameStartsWith implements FqcnSpecification
{
    use ReflectionSpecificationTrait;

    /**
     * @var string
     */
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    protected function isSatisfiedByReflection(string $fqcn, ReflectionClass $reflectionClass): bool
    {
        $className = $reflectionClass->getShortName();
        return substr_compare($className, $this->value, 0, strlen($this->value)) === 0;
    }
}
