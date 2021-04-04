<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Finder;

use FlexFqcnFinder\FqcnFinderInterface;

class GetDeclaredInterfaces implements FqcnFinderInterface
{
    /**
     * @inheritDoc
     */
    public function find(): array
    {
        return get_declared_interfaces();
    }
}
