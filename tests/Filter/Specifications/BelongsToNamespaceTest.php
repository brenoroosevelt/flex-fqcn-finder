<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\BelongsToNamespace;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\TestCase;

class BelongsToNamespaceTest extends TestCase
{
    public function belongsToNamespaceProvider()
    {
        return [
            ['FlexFqcnFinder\Test\Fixtures\Dir1\Dir11'],
            ['FlexFqcnFinder\Test\Fixtures\Dir1'],
            ['FlexFqcnFinder\Test\Fixtures'],
            ['FlexFqcnFinder\Test'],
            ['FlexFqcnFinder'],
        ];
    }

    /**
     * @dataProvider belongsToNamespaceProvider
     * @param string $namespace
     */
    public function testBelongsToNamespace(string $namespace)
    {
        $filter = new BelongsToNamespace($namespace);
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testBelongsToNamespaceReturnFalse()
    {
        $filter = new BelongsToNamespace('FlexFqcnFinder\Repository');
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }
}
