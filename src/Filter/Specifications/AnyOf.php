<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\Chainable;
use FlexFqcnFinder\Filter\FqcnSpecification;

/**
 * 'OR' operator
 */
class AnyOf implements FqcnSpecification, Chainable
{
    /**
     * @var FqcnSpecification[]
     */
    protected $specifications;

    public function __construct(FqcnSpecification $specification, FqcnSpecification ...$specifications)
    {
        $this->specifications = $specifications;
        $this->append($specification);
    }

    public function isSatisfiedBy(string $fqcn): bool
    {
        foreach ($this->specifications as $fqcnSpecification) {
            if ($fqcnSpecification->isSatisfiedBy($fqcn)) {
                return true;
            }
        }

        return false;
    }

    public function append(FqcnSpecification $specification)
    {
        $this->specifications[] = $specification;
    }
}
