<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\FqcnSpecification;

/**
 * Operator 'NOT'
 */
class Not implements FqcnSpecification
{
    /**
     * @var FqcnSpecification
     */
    protected $specification;

    public function __construct(FqcnSpecification $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(string $fqcn): bool
    {
        return !$this->specification->isSatisfiedBy($fqcn);
    }
}
