<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\IsClass;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\AbstractClass;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\InterfaceA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\TraitA;
use FlexFqcnFinder\Test\TestCase;

class IsClassTest extends TestCase
{
    public function testClassIsClass()
    {
        $filter = new IsClass();
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testAbstractClassIsClass()
    {
        $filter = new IsClass();
        $result = $filter->isSatisfiedBy(AbstractClass::class);
        $this->assertTrue($result);
    }

    public function testInterfaceIsClass()
    {
        $filter = new IsClass();
        $result = $filter->isSatisfiedBy(InterfaceA::class);
        $this->assertFalse($result);
    }

    public function testTraitIsClass()
    {
        $filter = new IsClass();
        $result = $filter->isSatisfiedBy(TraitA::class);
        $this->assertFalse($result);
    }
}
