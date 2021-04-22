<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\ClassNameEndsWith;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\TestCase;

class ClassNameEndsWithTest extends TestCase
{
    public function testClassNameEndsWith()
    {
        $filter = new ClassNameEndsWith('A');
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testClassNameEndsWithReturnFalse()
    {
        $filter = new ClassNameEndsWith('a');
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }
}
