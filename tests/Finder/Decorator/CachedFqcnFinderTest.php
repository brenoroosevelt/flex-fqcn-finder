<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Finder\Decorator;

use FlexFqcnFinder\Filter\Specifications\Apply;
use FlexFqcnFinder\Finder\Decorator\CachedFqcnFinder;
use FlexFqcnFinder\Finder\Decorator\FilteringFqcnFinder;
use FlexFqcnFinder\FqcnFinderInterface;
use FlexFqcnFinder\Test\Stubs\FixedArrayFqcnFinder;
use FlexFqcnFinder\Test\TestCase;
use InvalidArgumentException;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Psr16Cache;

class CachedFqcnFinderTest extends TestCase
{
    public function testCachedFinder()
    {
        $finder = new class implements FqcnFinderInterface {
            public $count = 0;

            public function find(): array
            {
                $this->count++;

                return [
                    'NamespaceA\ClassA',
                    'NamespaceB\ClassB'
                ];
            }
        };

        $cache = new Psr16Cache(new ArrayAdapter());

        $decorator = new CachedFqcnFinder($finder, $cache, 'cacheKey');
        $result1 = $decorator->find();
        $result2 = $decorator->find();

        $this->assertEquals(1, $finder->count);
        $this->assertEquals($result1, $result2);
        $this->assertEquals($cache->get('cacheKey'), $result2);
    }

    public function testFqcnFilteringDecoratorWithInvalidCacheKey()
    {
        $finder = new FixedArrayFqcnFinder([]);
        $this->expectException(InvalidArgumentException::class);
        new CachedFqcnFinder($finder, $cache = new Psr16Cache(new ArrayAdapter()), '');
    }
}
