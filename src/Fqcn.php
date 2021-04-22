<?php
declare(strict_types=1);

namespace FlexFqcnFinder;

use FlexFqcnFinder\Filter\FqcnSpecification;
use FlexFqcnFinder\Finder\ComposerClassMap;
use FlexFqcnFinder\Finder\Decorator\CachedFqcnFinder;
use FlexFqcnFinder\Finder\Decorator\FilteringFqcnFinder;
use FlexFqcnFinder\Finder\FqcnFinder;
use FlexFqcnFinder\Finder\GetDeclaredClasses;
use FlexFqcnFinder\Finder\GetDeclaredInterfaces;
use FlexFqcnFinder\Finder\GetDeclaredTraits;
use FlexFqcnFinder\Repository\FilesFromDir;
use Psr\SimpleCache\CacheInterface;

class Fqcn implements FqcnFinderInterface
{
    /**
     * @var FqcnSpecification|null
     */
    protected $filter;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var string
     */
    protected $cacheKey;

    /**
     * @var FqcnFinderInterface
     */
    protected $finders = [];

    public static function new(): Fqcn
    {
        return new self();
    }

    public static function fromDir(string $dir, bool $recursive = true): Fqcn
    {
        return (new self())->addDirectory($dir, $recursive);
    }

    public function addDirectory(string $dir, bool $recursive = true): Fqcn
    {
        $this->finders[] = new FqcnFinder(new FilesFromDir($dir, $recursive));
        return $this;
    }

    public function includeDeclaredClasses(): Fqcn
    {
        $this->finders[] = new GetDeclaredClasses();
        return $this;
    }

    public function includeDeclaredTraits(): Fqcn
    {
        $this->finders[] = new GetDeclaredTraits();
        return $this;
    }

    public function includeDeclaredInterfaces(): Fqcn
    {
        $this->finders[] = new GetDeclaredInterfaces();
        return $this;
    }

    public function includeComposerClassMap(): Fqcn
    {
        $this->finders[] = new ComposerClassMap();
        return $this;
    }

    public function withFilter(FqcnSpecification $filter): Fqcn
    {
        $this->filter = $filter;
        return $this;
    }

    public function withCache(CacheInterface $cache, string $cacheKey): Fqcn
    {
        $this->cache = $cache;
        $this->cacheKey = $cacheKey;
        return $this;
    }

    public function compose(FqcnFinderInterface ...$finders): Fqcn
    {
        foreach ($finders as $finder) {
            $this->finders[] = $finder;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function find(): array
    {
        $finder = new FqcnFinderComposite(...$this->finders);

        if ($this->filter instanceof FqcnSpecification) {
            $finder = new FilteringFqcnFinder($finder, $this->filter);
        }

        if ($this->cache instanceof CacheInterface) {
            $finder = new CachedFqcnFinder($finder, $this->cache, $this->cacheKey);
        }

        return $finder->find();
    }
}
