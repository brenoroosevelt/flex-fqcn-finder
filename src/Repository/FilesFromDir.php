<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Repository;

use DirectoryIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use Traversable;

class FilesFromDir implements FileRepositoryInterface
{
    const PHP_FILES = '/\.php$/';

    /**
     * @var RegexIterator
     */
    protected $iterator;

    public function __construct(string $directory, bool $recursive = true, string $pattern = self::PHP_FILES)
    {
        $directoryIterator =
            $recursive ?
            new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) :
            new DirectoryIterator($directory);

        $this->iterator = new RegexIterator($directoryIterator, $pattern);
    }

    /**
     * @inheritDoc
     */
    public function getFiles(): Traversable
    {
        foreach ($this->iterator as $path) {
            if ($path->isFile()) {
                yield realpath($path->getPathname());
            }
        }
    }
}
