<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\FqcnSpecification;

class IsClass implements FqcnSpecification
{
    public function isSatisfiedBy(string $fqcn): bool
    {
        return class_exists($fqcn);
    }
}
