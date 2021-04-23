<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\IsCloneable;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\AbstractClass;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\InterfaceA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\PrivateCloneMethod;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\TraitA;
use FlexFqcnFinder\Test\TestCase;

class IsCloneableTest extends TestCase
{
    public function testClassIsCloneable()
    {
        $filter = new IsCloneable();
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testAbstractClassIsCloneable()
    {
        $filter = new IsCloneable();
        $result = $filter->isSatisfiedBy(AbstractClass::class);
        $this->assertFalse($result);
    }

    public function testInterfaceIsCloneable()
    {
        $filter = new IsCloneable();
        $result = $filter->isSatisfiedBy(InterfaceA::class);
        $this->assertFalse($result);
    }

    public function testTraitIsCloneable()
    {
        $filter = new IsCloneable();
        $result = $filter->isSatisfiedBy(TraitA::class);
        $this->assertFalse($result);
    }

    public function testPrivateCloneMethodIsCloneable()
    {
        $filter = new IsCloneable();
        $result = $filter->isSatisfiedBy(PrivateCloneMethod::class);
        $this->assertFalse($result);
    }
}
