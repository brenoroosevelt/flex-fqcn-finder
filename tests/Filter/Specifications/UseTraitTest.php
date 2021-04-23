<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\UseTrait;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\Class111;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\TraitA;
use FlexFqcnFinder\Test\TestCase;

class UseTraitTest extends TestCase
{
    public function testUseTrait()
    {
        $filter = new UseTrait(TraitA::class);
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testUseTraitReturnFalse()
    {
        $filter = new UseTrait(TraitA::class);
        $result = $filter->isSatisfiedBy(Class111::class);
        $this->assertFalse($result);
    }
}
