<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter;

use FlexFqcnFinder\Filter\Specifications\AllOf;
use FlexFqcnFinder\Filter\Specifications\AnyOf;
use RuntimeException;

final class FqcnSpecificationFactory
{
    const NAMESPACE = __NAMESPACE__ . '\\Specifications';

    public function __call($name, $arguments): FqcnSpecification
    {
        $class = sprintf("%s\%s", self::NAMESPACE, ucfirst($name));
        if (!class_exists($class)) {
            throw new RuntimeException(sprintf('FqcnSpecification not found: (%s).', $name));
        }

        return new $class(...$arguments);
    }

    public function or(FqcnSpecification $specification, FqcnSpecification ...$specifications): FqcnSpecification
    {
        return new AnyOf($specification, ...$specifications);
    }

    public function and(FqcnSpecification $specification, FqcnSpecification ...$specifications): FqcnSpecification
    {
        return new AllOf($specification, ...$specifications);
    }
}
