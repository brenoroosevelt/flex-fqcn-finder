<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Stubs;

use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;
use function PHPUnit\Framework\exactly;

class Psr16ArrayCache implements CacheInterface
{
    protected $cached = [];

    public function get($key, $default = null): mixed
    {
        if (!$this->has($key)) {
            throw new class extends \Exception implements InvalidArgumentException {
            };
        }

        return $this->cached[$key];
    }

    public function set($key, $value, $ttl = null): bool
    {
        $this->cached[$key] = $value;

        return true;
    }

    public function delete($key): bool
    {
        unset($this->cached[$key]);

        return true;
    }

    public function clear(): bool
    {
        $this->cached = [];

        return true;
    }

    public function getMultiple($keys, $default = null): iterable
    {
        foreach ($keys as $key) {
            yield $this->get($key);
        }
    }

    public function setMultiple($values, $ttl = null): bool
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value, $ttl);
        }

        return true;
    }

    public function deleteMultiple($keys): bool
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }

        return true;
    }

    public function has($key): bool
    {
        return array_key_exists($key, $this->cached);
    }
}
