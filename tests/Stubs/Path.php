<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Stubs;

class Path
{
    protected $path;

    public function __construct(array $paths)
    {
        $parts = [];
        foreach ($paths as $path) {
            $items = array_filter(explode(DIRECTORY_SEPARATOR, $path));
            foreach ($items as $item) {
                $parts[] = $item;
            }
        }


        $this->path = (implode(DIRECTORY_SEPARATOR, $parts));
    }

    public static function from(string $path): self
    {
        return new self([$path]);
    }

    public function isDir():bool
    {
        return is_dir($this->path);
    }

    public function isFile():bool
    {
        return is_file($this->path);
    }

    public function path(string $path): self
    {
        $current = (string) $this;
        return new self([$current, $path]);
    }

    public function __toString()
    {
        return $this->path;
    }
}
