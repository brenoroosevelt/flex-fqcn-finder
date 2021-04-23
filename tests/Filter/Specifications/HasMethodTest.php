<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\HasMethod;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\Class111;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\InterfaceA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\TraitA;
use FlexFqcnFinder\Test\TestCase;

class HasMethodTest extends TestCase
{
    public function testClassHasMethod()
    {
        $filter = new HasMethod('methodA');
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testInterfaceHasMethod()
    {
        $filter = new HasMethod('methodA');
        $result = $filter->isSatisfiedBy(InterfaceA::class);
        $this->assertTrue($result);
    }

    public function testTraitHasMethod()
    {
        $filter = new HasMethod('methodA');
        $result = $filter->isSatisfiedBy(TraitA::class);
        $this->assertTrue($result);
    }

    public function testHasMethodReturnFalse()
    {
        $filter = new HasMethod('methodA');
        $result = $filter->isSatisfiedBy(Class111::class);
        $this->assertFalse($result);
    }
}
