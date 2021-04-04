<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Finder\Decorator;

use FlexFqcnFinder\Filter\FqcnSpecification;
use FlexFqcnFinder\FqcnFinderInterface;

/**
 * Decorator
 */
class FilteringFqcnFinder implements FqcnFinderInterface
{
    /**
     * @var FqcnFinderInterface
     */
    protected $fqcnFinder;

    /**
     * @var FqcnSpecification
     */
    protected $specification;

    public function __construct(FqcnFinderInterface $fqcnFinder, FqcnSpecification $filter)
    {
        $this->fqcnFinder = $fqcnFinder;
        $this->specification = $filter;
    }

    /**
     * @inheritDoc
     */
    public function find(): array
    {
        return
            array_filter($this->fqcnFinder->find(), function (string $fqcn) {
                return $this->specification->isSatisfiedBy($fqcn);
            });
    }
}
