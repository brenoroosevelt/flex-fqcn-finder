<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\IsInstantiable;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\AbstractClass;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\InterfaceA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\PrivateConstructor;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\TraitA;
use FlexFqcnFinder\Test\TestCase;

class IsInstantiableTest extends TestCase
{
    public function testClassIsInstantiable()
    {
        $filter = new IsInstantiable();
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testInterfaceIsInstantiable()
    {
        $filter = new IsInstantiable();
        $result = $filter->isSatisfiedBy(InterfaceA::class);
        $this->assertFalse($result);
    }

    public function testTraitIsInstantiable()
    {
        $filter = new IsInstantiable();
        $result = $filter->isSatisfiedBy(TraitA::class);
        $this->assertFalse($result);
    }

    public function testAbstractClassIsInstantiable()
    {
        $filter = new IsInstantiable();
        $result = $filter->isSatisfiedBy(AbstractClass::class);
        $this->assertFalse($result);
    }

    public function testPrivateConstructorClassIsInstantiable()
    {
        $filter = new IsInstantiable();
        $result = $filter->isSatisfiedBy(PrivateConstructor::class);
        $this->assertFalse($result);
    }
}
