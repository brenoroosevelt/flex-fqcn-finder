<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\FqcnSpecification;

class IsTrait implements FqcnSpecification
{
    public function isSatisfiedBy(string $fqcn): bool
    {
        return trait_exists($fqcn);
    }
}
