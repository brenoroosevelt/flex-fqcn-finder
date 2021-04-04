<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter;

use FlexFqcnFinder\Filter\Specifications\AllOf;
use FlexFqcnFinder\Filter\Specifications\AlwaysFalse;
use FlexFqcnFinder\Filter\Specifications\AlwaysTrue;
use FlexFqcnFinder\Filter\Specifications\AnyOf;

class Filter
{
    public static function by(): FqcnSpecificationChain
    {
        return new FqcnSpecificationChain(new AllOf(new AlwaysTrue));
    }

    public static function anyOf(): FqcnSpecificationChain
    {
        return new FqcnSpecificationChain(new AnyOf(new AlwaysFalse));
    }
}
