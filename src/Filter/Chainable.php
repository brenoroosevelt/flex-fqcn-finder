<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter;

interface Chainable extends FqcnSpecification
{
    public function append(FqcnSpecification $specification);
}
