<?php
declare(strict_types=1);

namespace FlexFqcnFinder;

class FqcnFinderComposite implements FqcnFinderInterface
{
    /**
     * @var FqcnFinderInterface[]
     */
    protected $fqcnFinders;

    public function __construct(FqcnFinderInterface ...$fqcnFinders)
    {
        $this->fqcnFinders = $fqcnFinders;
    }

    /**
     * @inheritDoc
     */
    public function find(): array
    {
        $fqcns = [];
        foreach ($this->fqcnFinders as $fqcnFinder) {
            $fqcns = array_merge($fqcns, $fqcnFinder->find());
        }

        return array_unique($fqcns);
    }
}
