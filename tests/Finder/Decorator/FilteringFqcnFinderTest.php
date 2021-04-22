<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Finder\Decorator;

use FlexFqcnFinder\Filter\Specifications\Apply;
use FlexFqcnFinder\Finder\Decorator\FilteringFqcnFinder;
use FlexFqcnFinder\Test\Stubs\FixedArrayFqcnFinder;
use FlexFqcnFinder\Test\TestCase;

class FilteringFqcnFinderTest extends TestCase
{
    public function testFqcnFilteringDecorator()
    {
        $finder = new FixedArrayFqcnFinder([
            'NamespaceA\Class1',
            'NamespaceB\Class1',
            'NamespaceC\Class1',
        ]);

        $filter = new Apply(function (string $fqcn) {
            return $fqcn === 'NamespaceB\Class1';
        });

        $decorator = new FilteringFqcnFinder($finder, $filter);
        $result = $decorator->find();

        $this->assertArrayEquals(['NamespaceB\Class1'], $result);
    }
}
