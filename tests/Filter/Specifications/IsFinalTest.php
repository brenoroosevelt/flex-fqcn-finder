<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\IsCloneable;
use FlexFqcnFinder\Filter\Specifications\IsFinal;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\FinalClass;
use FlexFqcnFinder\Test\TestCase;

class IsFinalTest extends TestCase
{
    public function testClassIsFinal()
    {
        $filter = new IsFinal();
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }

    public function testFinalClassIsFinal()
    {
        $filter = new IsCloneable();
        $result = $filter->isSatisfiedBy(FinalClass::class);
        $this->assertTrue($result);
    }
}
