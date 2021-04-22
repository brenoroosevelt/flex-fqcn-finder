<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\AllOf;
use FlexFqcnFinder\Filter\Specifications\AlwaysFalse;
use FlexFqcnFinder\Filter\Specifications\AlwaysTrue;
use FlexFqcnFinder\Test\TestCase;

class AllOfTest extends TestCase
{
    public function testAllOfReturnFalse()
    {
        $filter = new AllOf(new AlwaysTrue(), new AlwaysFalse());
        $result = $filter->isSatisfiedBy('any');
        $this->assertFalse($result);
    }

    public function testAllOfReturnTrue()
    {
        $filter = new AllOf(new AlwaysTrue(), new AlwaysTrue());
        $result = $filter->isSatisfiedBy('any');
        $this->assertTrue($result);
    }
}
