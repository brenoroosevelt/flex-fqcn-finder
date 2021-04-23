<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\NamespaceEqualsTo;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\TestCase;

class NamespaceEqualsToTest extends TestCase
{
    public function testNamespaceEqualsTo()
    {
        $filter = new NamespaceEqualsTo('FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111');
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testNamespaceEqualsToReturnFalse()
    {
        $filter = new NamespaceEqualsTo('FlexFqcnFinder\Test\Fixtures\Dir1\Dir11');
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }
}
