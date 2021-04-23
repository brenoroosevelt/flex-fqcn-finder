<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\IsTrait;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\TraitA;
use FlexFqcnFinder\Test\TestCase;

class IsTraitTest extends TestCase
{
    public function testClassIsTrait()
    {
        $filter = new IsTrait();
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }

    public function testTraitIsTrait()
    {
        $filter = new IsTrait();
        $result = $filter->isSatisfiedBy(TraitA::class);
        $this->assertTrue($result);
    }
}
