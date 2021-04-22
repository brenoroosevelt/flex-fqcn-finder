<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\ClassNameStartsWith;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\TestCase;

class ClassNameStartsWithTest extends TestCase
{
    public function testClassNameStartsWith()
    {
        $filter = new ClassNameStartsWith('Class');
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testClassNameStartsWithReturnFalse()
    {
        $filter = new ClassNameStartsWith('class');
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }
}
