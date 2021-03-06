<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Stubs;

use FlexFqcnFinder\FqcnFinderInterface;

class FixedArrayFqcnFinder implements FqcnFinderInterface
{
    /**
     * @var array
     */
    protected $fqcns;

    public function __construct(array $fqcn)
    {
        $this->fqcns = $fqcn;
    }

    /**
     * @inheritDoc
     */
    public function find(): array
    {
        return $this->fqcns;
    }
}
