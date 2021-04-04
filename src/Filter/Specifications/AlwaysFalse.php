<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\FqcnSpecification;

class AlwaysFalse implements FqcnSpecification
{
    public function isSatisfiedBy(string $fqcn): bool
    {
        return false;
    }
}
