<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter\Specifications;

use FlexFqcnFinder\Filter\FqcnSpecification;

class IsInstanceOf implements FqcnSpecification
{
    /**
     * @var string
     */
    protected $subject;

    public function __construct(string $subject)
    {
        $this->subject = $subject;
    }

    public function isSatisfiedBy(string $fqcn): bool
    {
        return is_a($fqcn, $this->subject, true);
    }
}
