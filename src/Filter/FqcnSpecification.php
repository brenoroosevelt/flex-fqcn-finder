<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter;

interface FqcnSpecification
{
    public function isSatisfiedBy(string $fqcn): bool;
}
