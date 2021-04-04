<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Repository;

use Traversable;

interface FileRepositoryInterface
{
    /**
     * @return Traversable string[] file path
     */
    public function getFiles(): Traversable;
}
