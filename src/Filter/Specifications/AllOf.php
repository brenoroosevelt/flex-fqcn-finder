<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\Chainable;
use FlexFqcnFinder\Filter\FqcnSpecification;

/**
 * 'AND' operator
 */
class AllOf implements FqcnSpecification, Chainable
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
            if (!$fqcnSpecification->isSatisfiedBy($fqcn)) {
                return false;
            }
        }

        return true;
    }

    public function append(FqcnSpecification $specification)
    {
        $this->specifications[] = $specification;
    }
}
