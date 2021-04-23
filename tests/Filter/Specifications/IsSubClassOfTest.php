<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\IsSubClassOf;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\Class111;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\InterfaceA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\SubClass;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\TraitA;
use FlexFqcnFinder\Test\TestCase;

class IsSubClassOfTest extends TestCase
{
    public function testClassIsSubClassOfSelfClass()
    {
        $filter = new IsSubClassOf(ClassA::class);
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }

    public function testClassIsSubClassOfAClass()
    {
        $filter = new IsSubClassOf(Class111::class);
        $result = $filter->isSatisfiedBy(SubClass::class);
        $this->assertTrue($result);
    }

    public function testClassIsSubClassOfInterface()
    {
        $filter = new IsSubClassOf(InterfaceA::class);
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testClassIsSubClassOfTrait()
    {
        $filter = new IsSubClassOf(TraitA::class);
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }

    public function testClassIsSubClassOfReturnFalse()
    {
        $filter = new IsSubClassOf(Class111::class);
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }
}
