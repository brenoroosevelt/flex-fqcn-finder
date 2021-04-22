<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\AlwaysFalse;
use FlexFqcnFinder\Filter\Specifications\AlwaysTrue;
use FlexFqcnFinder\Filter\Specifications\AnyOf;
use FlexFqcnFinder\Test\TestCase;

class AnyOfTest extends TestCase
{
    public function testAnyOfReturnFalse()
    {
        $filter = new AnyOf(new AlwaysFalse(), new AlwaysFalse());
        $result = $filter->isSatisfiedBy('any');
        $this->assertFalse($result);
    }

    public function testAnyOfReturnTrue()
    {
        $filter = new AnyOf(new AlwaysTrue(), new AlwaysFalse());
        $result = $filter->isSatisfiedBy('any');
        $this->assertTrue($result);
    }
}
