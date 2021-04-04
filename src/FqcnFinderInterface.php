<?php
declare(strict_types=1);

namespace FlexFqcnFinder;

interface FqcnFinderInterface
{
    /**
     * @return string[] The fully qualified class names found
     */
    public function find(): array;
}
