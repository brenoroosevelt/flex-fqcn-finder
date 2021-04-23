<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\AlwaysFalse;
use FlexFqcnFinder\Filter\Specifications\AlwaysTrue;
use FlexFqcnFinder\Filter\Specifications\Not;
use FlexFqcnFinder\Test\TestCase;

class NotTest extends TestCase
{
    public function testNotReturnTrue()
    {
        $filter = new Not(new AlwaysFalse());
        $result = $filter->isSatisfiedBy('any');
        $this->assertTrue($result);
    }

    public function testNotReturnFalse()
    {
        $filter = new Not(new AlwaysTrue());
        $result = $filter->isSatisfiedBy('any');
        $this->assertFalse($result);
    }
}
