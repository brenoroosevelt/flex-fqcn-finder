<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Finder;

use FlexFqcnFinder\FqcnFinderInterface;

class GetDeclaredClasses implements FqcnFinderInterface
{
    /**
     * @inheritDoc
     */
    public function find(): array
    {
        return get_declared_classes();
    }
}
