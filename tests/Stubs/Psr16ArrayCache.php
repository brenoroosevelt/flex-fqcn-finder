<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Stubs;

use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

class Psr16ArrayCache implements CacheInterface
{
    protected $cached = [];

    public function get($key, $default = null)
    {
        if (!$this->has($key)) {
            throw new class implements InvalidArgumentException {
            };
        }

        return $this->cached[$key];
    }

    public function set($key, $value, $ttl = null)
    {
        $this->cached[$key] = $value;
    }

    public function delete($key)
    {
        unset($this->cached[$key]);
    }

    public function clear()
    {
        $this->cached = [];
    }

    public function getMultiple($keys, $default = null)
    {
        foreach ($keys as $key) {
            yield $this->get($key);
        }
    }

    public function setMultiple($values, $ttl = null)
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value, $ttl);
        }
    }

    public function deleteMultiple($keys)
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }
    }

    public function has($key)
    {
        return array_key_exists($key, $this->cached);
    }
}
