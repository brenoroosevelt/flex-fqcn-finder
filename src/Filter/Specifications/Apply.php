<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use Closure;
use FlexFqcnFinder\Filter\FqcnSpecification;

class Apply implements FqcnSpecification
{
    /**
     * @var Closure
     */
    protected $fn;

    public function __construct(Closure $fn)
    {
        $this->fn = $fn;
    }

    public function isSatisfiedBy(string $fqcn): bool
    {
        return ($this->fn)($fqcn);
    }
}
