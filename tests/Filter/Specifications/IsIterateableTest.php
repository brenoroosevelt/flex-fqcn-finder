<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\IsIterateable;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\TestCase;
use RegexIterator;
use stdClass;

class IsIterateableTest extends TestCase
{
    public function testClassIsIterateable()
    {
        $filter = new IsIterateable();
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }

    public function testIsIterateable()
    {
        $filter = new IsIterateable();
        $result = $filter->isSatisfiedBy(RegexIterator::class);
        $this->assertTrue($result);
    }
}
