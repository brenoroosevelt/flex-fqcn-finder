<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Finder\Decorator;

use FlexFqcnFinder\FqcnFinderInterface;
use Psr\SimpleCache\CacheInterface;
use InvalidArgumentException;

/**
 * Decorator
 */
class CachedFqcnFinder implements FqcnFinderInterface
{
    /**
     * @var FqcnFinderInterface
     */
    protected $fqcnFinder;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var string
     */
    private $cacheKey;

    public function __construct(FqcnFinderInterface $fqcnFinder, CacheInterface $cache, string $cacheKey)
    {
        if (empty($cacheKey)) {
            throw new InvalidArgumentException('Invalid cache key.');
        }

        $this->fqcnFinder = $fqcnFinder;
        $this->cache = $cache;
        $this->cacheKey = $cacheKey;
    }

    /**
     * @inheritDoc
     */
    public function find(): array
    {
        if ($this->cache->has($this->cacheKey)) {
            return $this->cache->get($this->cacheKey);
        }

        $fqcn = $this->fqcnFinder->find();
        $this->cache->set($this->cacheKey, $fqcn);

        return $fqcn;
    }
}
