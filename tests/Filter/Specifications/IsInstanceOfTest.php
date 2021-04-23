<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\IsInstanceOf;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\Class111;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\InterfaceA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\TraitA;
use FlexFqcnFinder\Test\TestCase;

class IsInstanceOfTest extends TestCase
{
    public function testClassIsInstanceOfSelfClass()
    {
        $filter = new IsInstanceOf(ClassA::class);
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testClassIsInstanceOfInterface()
    {
        $filter = new IsInstanceOf(InterfaceA::class);
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testClassIsInstanceOfTrait()
    {
        $filter = new IsInstanceOf(TraitA::class);
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }

    public function testClassIsInstanceOfReturnFalse()
    {
        $filter = new IsInstanceOf(Class111::class);
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }
}
