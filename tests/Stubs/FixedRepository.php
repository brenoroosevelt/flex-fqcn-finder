<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Stubs;

use FlexFqcnFinder\Repository\FileRepositoryInterface;
use Traversable;

class FixedRepository implements FileRepositoryInterface
{
    /**
     * @var array
     */
    protected $files;

    public function __construct(array $files)
    {
        $this->files = $files;
    }

    public function getFiles(): Traversable
    {
        foreach ($this->files as $file) {
            yield $file;
        }
    }
}
