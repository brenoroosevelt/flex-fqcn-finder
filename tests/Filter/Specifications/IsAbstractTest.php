<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\IsAbstract;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\AbstractClass;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\InterfaceA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\PrivateConstructor;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\TraitA;
use FlexFqcnFinder\Test\TestCase;

class IsAbstractTest extends TestCase
{
    public function testClassIsAbstract()
    {
        $filter = new IsAbstract();
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }

    public function testAbstractClassIsAbstract()
    {
        $filter = new IsAbstract();
        $result = $filter->isSatisfiedBy(AbstractClass::class);
        $this->assertTrue($result);
    }

    public function testInterfaceIsAbstract()
    {
        $filter = new IsAbstract();
        $result = $filter->isSatisfiedBy(InterfaceA::class);
        $this->assertTrue($result);
    }

    public function testTraitIsAbstract()
    {
        $filter = new IsAbstract();
        $result = $filter->isSatisfiedBy(TraitA::class);
        $this->assertFalse($result);
    }

    public function testPrivateConstructorIsAbstract()
    {
        $filter = new IsAbstract();
        $result = $filter->isSatisfiedBy(PrivateConstructor::class);
        $this->assertFalse($result);
    }
}
