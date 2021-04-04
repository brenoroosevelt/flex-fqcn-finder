<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\FqcnSpecification;

class HasMethod implements FqcnSpecification
{
    /**
     * @var string
     */
    protected $method;

    public function __construct(string $method)
    {
        $this->method = $method;
    }

    public function isSatisfiedBy(string $fqcn): bool
    {
        return in_array($this->method, get_class_methods($fqcn));
    }
}
