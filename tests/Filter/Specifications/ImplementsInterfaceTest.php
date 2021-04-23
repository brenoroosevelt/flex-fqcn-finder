<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\ImplementsInterface;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\Class111;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\InterfaceA;
use FlexFqcnFinder\Test\TestCase;

class ImplementsInterfaceTest extends TestCase
{
    public function testClassImplementsInterface()
    {
        $filter = new ImplementsInterface(InterfaceA::class);
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testInterfaceImplementsInterface()
    {
        $filter = new ImplementsInterface(InterfaceA::class);
        $result = $filter->isSatisfiedBy(InterfaceA::class);
        $this->assertTrue($result);
    }

    public function testImplementsInterfaceReturnFalse()
    {
        $filter = new ImplementsInterface(InterfaceA::class);
        $result = $filter->isSatisfiedBy(Class111::class);
        $this->assertFalse($result);
    }
}
