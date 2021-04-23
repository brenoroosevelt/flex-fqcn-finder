<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\IsInterface;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\AbstractClass;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\InterfaceA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\TraitA;
use FlexFqcnFinder\Test\TestCase;

class IsInterfaceTest extends TestCase
{
    public function testClassIsInterface()
    {
        $filter = new IsInterface();
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }

    public function testInterfaceIsInterface()
    {
        $filter = new IsInterface();
        $result = $filter->isSatisfiedBy(InterfaceA::class);
        $this->assertTrue($result);
    }

    public function testTraitIsInterface()
    {
        $filter = new IsInterface();
        $result = $filter->isSatisfiedBy(TraitA::class);
        $this->assertFalse($result);
    }

    public function testAbstractClassIsInstantiable()
    {
        $filter = new IsInterface();
        $result = $filter->isSatisfiedBy(AbstractClass::class);
        $this->assertFalse($result);
    }
}
